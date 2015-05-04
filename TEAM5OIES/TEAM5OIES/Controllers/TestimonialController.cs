using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using TEAM5OIES.Models;

namespace TEAM5OIES.Controllers
{
    public class TestimonialController : Controller
    {
       team5oiesEntities db = new team5oiesEntities();

        //
        // GET: /Testimonial/
        public ActionResult Index(string withtext, string withauthor)
        {
            bool textSearch = !String.IsNullOrEmpty(withtext);
            bool authorSearch = !String.IsNullOrEmpty(withauthor);

            var testimonials = from t in db.Testimonials
                select t;

            List<Testimonial> finalModel = new List<Testimonial>();
            int size = testimonials.Count();

            if (size > 0)
            {
                if (!textSearch && !authorSearch)
                {
                    int rand = new Random().Next(size);
                    Testimonial temp = testimonials.ToList().ElementAt(rand);
                    finalModel.Add(temp);
                }
                else
                {
                    if (authorSearch) // For some reason this stopped working wiht testimonials.Where(lamda) when I switched to MySQL
                    {                 // don't know if it has anything to do with that. Oh well this is working right now
                        foreach (var t in testimonials)
                        {
                            if(t.author.ToLower().Contains(withauthor.ToLower()))
                                finalModel.Add(t);
                        }
                    }
                    if (textSearch)
                    {
                        foreach (var t in testimonials)
                        {
                            if (t.content.ToLower().Contains(withtext.ToLower()))
                                finalModel.Add(t);
                        }
                    }
                }
            }

            return View(finalModel);
        }

        //
        // GET: /Testimonial/Create
        [Authorize(Roles = "Surgeon")]
        public ActionResult Create()
        {
            return View();
        } 

        //
        // POST: /Testimonial/Create
        [HttpPost]
        public ActionResult Create([Bind(Include = "testimonialID,content,author,created_date")] Testimonial newTestimonial)
        {
            newTestimonial.testimonialDate = DateTime.Now;
            if (ModelState.IsValid)
            {
                db.AddToTestimonials(newTestimonial);
                db.SaveChanges();

                return RedirectToAction("Index");
            }
            else
            {
                return View(newTestimonial);
            }
        }
        
    }
}
