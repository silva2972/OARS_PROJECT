using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using TEAM5OIES.Models;

namespace TEAM5OIES.Controllers
{
    public class AuditController : Controller
    {
        Entities db = new Entities();
        //
        // GET: /Audit/
        [Authorize(Roles="Auditor")]
        public ActionResult Index(string searchString, int? page)
        {
            if (!page.HasValue)
            {
                page = 0;
            }
            IEnumerable<Audit> audits;
            if (searchString != null)
            {
                audits = db.Audits.ToList().Where(
                    s => (s.access + " " +
                          s.attribute + " " +
                          s.change_date.ToLongDateString() + " " +
                          s.change_date.ToShortDateString() + " " +
                          s.changed_table).Contains(searchString) ||
                         s.auditID.Equals(searchString) ||
                         s.username.Equals(searchString) ||
                         s.userID.Equals(searchString))
                         .OrderByDescending(s => s.change_date)
                         .Skip(page.Value*25).Take(25);
            }
            else
            {
                audits = db.Audits
                    .OrderByDescending(s => s.change_date)
                    .Skip(page.Value*25).Take(25);
            }
            return View(audits.ToList());
        }
    }
}
