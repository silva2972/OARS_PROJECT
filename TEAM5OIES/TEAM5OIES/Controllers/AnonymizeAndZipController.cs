using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace TEAM5OIES.Controllers
{
    public class AnonymizeAndZipController : Controller
    {
        //
        // GET: /AnonymizeAndZip/

        [Authorize(Roles = "Surgeon")]
        public ActionResult Index()
        {
            return View();
        }

    }
}
