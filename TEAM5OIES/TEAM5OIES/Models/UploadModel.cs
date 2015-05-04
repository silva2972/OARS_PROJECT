using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace TEAM5OIES.Models
{
    
     public class UploadModel 
     {
         public string bodyLength { get; set; } 
         public string bodyDiameter { get; set; } 
         public string unilateralLength { get; set; } 
         public string unilateralDiameter { get; set; } 
         public string contralateralLength { get; set; } 
         public string contralateralDiameter { get; set; } 
         public string entryPoint { get; set; }
         public DateTime DateOfSurgery { get; set; }
         public Guid BrandId { get; set; }
     } 
 } 

    