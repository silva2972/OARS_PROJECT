using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.IO.Compression;
using System.Net.Mail;
using System.Text;
using System.Threading;
using System.Web.Security;
using EvilDICOM.Core;
using EvilDICOM.Core.Element;
using gdcm;
using Ionic.Zip;
using TEAM5OIES.Models;
using Directory = System.IO.Directory;
using File = System.IO.File;
using Image = TEAM5OIES.Models.Image;
using Patient = TEAM5OIES.Models.Patient;
using Series = TEAM5OIES.Models.Series;
using Study = TEAM5OIES.Models.Study;

namespace TEAM5OIES.Controllers
{
    public class UploadController : Controller
    {
        Entities db = new Entities();

        [Authorize(Roles = "Surgeon")]
        public ActionResult Index()
        {
            ViewData["BrandList"] = new SelectList(db.Brands, "brandID", "brandName");
            return View();
        }

        [AcceptVerbs(HttpVerbs.Post)]
        public ActionResult Index(HttpPostedFileBase uploadFile, UploadModel model)
        {
            ViewData["BrandList"] = new SelectList(db.Brands, "brandID", "brandName");
            if (uploadFile != null)
            {

                if (uploadFile.ContentLength > 0)
                {
                    Unzip(uploadFile, model);
                    TempData["UploadValidationMessage_Success"] = "Data Upload Succeeded";

                    return View("Index");

                }

                return View("Index");
            }

            else
            {
                TempData["UploadValidationMessage_Failure"] = "Please provide the filename to be uploaded";
                return View("Index");
            }
        }


        /* Method Created by Johnathan Hornik *
        * Team5_7                             */
        private void ProcessMetadata(string extractPath, Guid patientID, UploadModel model)
        {
            extractPath += @"\DICOM";

            //Patient Data
            const string originalIdPatient = "0010" + "0020";
            const string age = "0010" + "1010";
            const string sex = "0010" + "0040";

            //Study Data
            const string originalIdStudy = "0020" + "0010";
            const string descriptionStudy = "0008" + "1030";
            const string modality = "0008" + "0060";
            const string date = "0008" + "0020";
            const string time = "0008" + "0030";
            const string referringPhysician = "0008" + "0090";
            const string institution = "0008" + "0080";
            const string addtlPatientHistory = "0010" + "21B0";

            //Series Data
            const string originalIdSeries = "0020" + "0011";
            const string descriptionSeries = "0008" + "103E";

            var files = Directory.GetFiles(extractPath).ToList();
            var dicomFirst = DICOMObject.Read(files.ElementAt(0));

            var originIdPatientActual = dicomFirst.FindFirst(originalIdPatient) as AbstractElement<string>;
            var patientSexActual = dicomFirst.FindFirst(sex) as AbstractElement<string>;
            var ageActual = dicomFirst.FindFirst(age) as AbstractElement<string>;

            var currentPatient = new Patient()
            {
                originalID = originIdPatientActual.Data,
                dateOfSurgery = model.DateOfSurgery,
                entryDate = System.DateTime.Today,
                sex = patientSexActual.Data,
                age = Convert.ToInt32(ageActual.Data.Substring(0, 3)),
                patientID = patientID,
                surgeonID = (Guid)Membership.GetUser().ProviderUserKey
            };
            db.AddToPatients(currentPatient);
            db.SaveChanges();

            db.AddToEndografts(new Endograft()
            {
                endograft_length = model.bodyLength,
                diameter = model.bodyDiameter,
                controlaterLegLength = model.contralateralLength,
                controlaterLegDiameter = model.contralateralDiameter,
                unilateralLegDiameter = model.unilateralDiameter,
                unilateralLegLength = model.unilateralLength,
                entry_Point = model.entryPoint,
                brandID = model.BrandId,
                endograftID = Guid.NewGuid()
            });
            db.SaveChanges();

            List<Study> studies = new List<Study>();
            List<Series> series = new List<Series>();

            var count = 0;
            foreach (var f in files)
            {
                count++;
                var dicom = DICOMObject.Read(f);
                var originIdStudyActual = dicom.FindFirst(originalIdStudy) as AbstractElement<string>;
                var studyDescActual = dicom.FindFirst(descriptionStudy) as AbstractElement<string>;
                var studyDate = dicom.FindFirst(date) as Date;
                var studyId = Guid.NewGuid();
                Study currentStudy;
                if (!studies.Any(s => s.originalStudyID == originIdStudyActual.Data) &&
                    !db.Studies.Any(s => s.originalStudyID == originIdStudyActual.Data))
                {
                    currentStudy = new Study()
                    {
                        originalStudyID = originIdStudyActual.Data,
                        studyDate = studyDate.Data.Value,
                        studyDescription = studyDescActual.Data,
                        CT = f,
                        patientID = patientID,
                        studyID = Guid.NewGuid()
                    };
                    db.AddToStudies(currentStudy);
                    db.SaveChanges();
                }
                else
                {
                    if (studies.Any(s => s.originalStudyID == originIdStudyActual.Data))
                    {
                        currentStudy = studies.First(s => s.originalStudyID == originIdStudyActual.Data);
                    }
                    else
                    {
                        currentStudy = db.Studies.First(s => s.originalStudyID == originIdStudyActual.Data);
                    }
                    
                }

                var originSeriesActual = (dicom.FindFirst(originalIdSeries) as IntegerString).Data.ToString();
                var seriesDescActual = dicom.FindFirst(descriptionSeries) as AbstractElement<string>;

                if (!series.Any(s => s.originalSeriesID == originSeriesActual) &&
                    !db.Series.Any(s => s.originalSeriesID == originSeriesActual))
                {
                    db.AddToSeries(new Series()
                    {
                        IlliacBif = "",
                        originalSeriesID = originSeriesActual,
                        ROIBegin = "",
                        seriesDate = System.DateTime.Today,
                        seriesDescription = seriesDescActual.Data,
                        totalNumberOfSlices = 1,
                        Study = currentStudy,
                        seriesID = Guid.NewGuid()
                    });
                    db.SaveChanges();
                }

                var sliceThickness = dicom.FindFirst("00180050") as AbstractElement<string>;
                db.AddToImages(new Image()
                {
                    imageFileName = f,
                    imageOrder = count.ToString(),
                    imageTitle = "Evar Image Title",
                    seriesID = db.Series.First(s => s.originalSeriesID.Equals(originSeriesActual)).seriesID,
                    sliceThickness = Convert.ToDouble(sliceThickness),
                    imageID = Guid.NewGuid()
                });
                db.SaveChanges();
            }
        }

        private void Unzip(HttpPostedFileBase uploadFile, UploadModel model)
        {
            Guid patientId = Guid.NewGuid();
            String extractPath = @"D:\COSC4351_Spring2015\TEAM5OIES\" + patientId;
            //TODO send success or failure email to logged in physician

            try
            {
                var options = new ReadOptions { StatusMessageWriter = System.Console.Out };
                using (ZipFile zip = ZipFile.Read(uploadFile.InputStream))
                {
                    var thread = new Thread(() =>
                    {
                        zip.ExtractAll(extractPath, ExtractExistingFileAction.OverwriteSilently);
                        ProcessMetadata(extractPath, patientId, model);
                    });
                    thread.Start();
                }
            }

            catch (System.Exception ex1)
            {
                // System.Console.Error.WriteLine("exception: " + ex1);
            }
        }
    }
}
