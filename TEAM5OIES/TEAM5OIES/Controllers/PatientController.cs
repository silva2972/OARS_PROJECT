using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Web.Security;
using TEAM5OIES.Models;


namespace TEAM5OIES.Controllers
{
    public class PatientController : Controller
    {
        Entities db = new Entities();
        //
        // GET: /Patient/

        public ActionResult Index()
        {
            return View(db.Patients.ToList());
        }

        //
        // GET: /Patient/Edit/5

        public ActionResult Edit(string id)
        {
            var patient = db.Patients.First(s => s.patientID.ToString(id) == id);
            return View(patient);
        }

        //
        // POST: /Patient/Edit/5

        [HttpPost]
        public ActionResult Edit(string id, FormCollection collection)
        {
            var patient = db.Patients.First(s => s.patientID.ToString() == id);
            try
            {
                return RedirectToAction("Index");
            }
            catch
            {
                return View(patient);
            }
        }
        [HttpGet]
        public ActionResult PatientSelection()
        {
            ViewData["PatientList"] = new SelectList(db.Patients, "patientID", "originalID");
            ViewData["StudyList"] = new SelectList(db.Studies, "studyID", "studyDescription");
            ViewData["SeriesList"] = new SelectList(db.Series, "seriesID", "originalSeriesID");
            ViewData["Success"] = "";
            return View();
        }

        [HttpPost]
        public ActionResult PatientSelection(Guid PatientID, Guid StudyID, Guid SeriesID, String hello, String howdy)
        {
            var updatedSeries = db.Series.First(s => s.seriesID == SeriesID);
            updatedSeries.ROIBegin = hello;
            updatedSeries.IlliacBif = howdy;
            //db.Series.Attach(updatedSeries);
            db.ObjectStateManager.ChangeObjectState(updatedSeries, System.Data.EntityState.Modified);
            db.SaveChanges();
            ViewData["PatientList"] = new SelectList(db.Patients, "patientID", "originalID");
            ViewData["StudyList"] = new SelectList(db.Studies, "studyID", "studyDescription");
            ViewData["SeriesList"] = new SelectList(db.Series, "seriesID", "originalSeriesID");
            ViewData["Success"] = "Success!";
            return View();
        }
    }
}
