using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using TEAM5OIES.Models;

namespace TEAM5OIES.Controllers
{
    public class PatientController : Controller
    {
        team5oiesEntities db = new team5oiesEntities();
        //
        // GET: /Patient/

        public ActionResult Index()
        {
            var patients = db.Patients;
            return View(patients.ToList());
        }
        
        //
        // GET: /Patient/Edit/5
 
        public ActionResult Edit(string id)
        {
            var patient = db.Patients.First(s => s.patientID == id);
            return View(patient);
        }

        //
        // POST: /Patient/Edit/5

        [HttpPost]
        public ActionResult Edit(string id, FormCollection collection)
        {
            var patient = db.Patients.First(s => s.patientID == id);
            try
            {
                return RedirectToAction("Index");
            }
            catch
            {
                return View(patient);
            }
        }
    }
}
