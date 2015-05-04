using System;
using System.Collections.Generic;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using EvilDICOM.Core;
using EvilDICOM.Core.Selection;

namespace TEAM5OIES.Controllers
{
    [Authorize]
    public class VisualizeController : Controller
    {
        //
        // GET: /Visualize/

        public ActionResult Index(string filePath)
        {
            ViewData["Video"] = "/Content/dicom.mp4";
            return View();
        }
    }
}
