<%@ Page Title="" Language="C#" MasterPageFile="~/Views/Visualize/Dashboard.Master" Inherits="System.Web.Mvc.ViewPage<TEAM5OIES.Models.UploadModel>" %>
 
 
 <asp:Content ID="Content1" ContentPlaceHolderID="TitleContent" runat="server"> 
 	Upload 
 </asp:Content> 
 

 <asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server"> 
 

      
 <h2>Upload Evar Data</h2> 
    <% using (Html.BeginForm("Index", "Upload",FormMethod.Post, new { encType = "multipart/form-data" }))
       {%> 
        <input name="uploadFile" type="file" class=""/>

            <br />
            
            <fieldset>
            <legend>Endograft Information</legend>
            <div style="float:left; margin-right: 4px ">
            
            <div class="editor-label"> 
             <%: Html.Label("Endograft Body Diameter") %> 
             </div> 
             <div class="editor-field"> 
                 <%: Html.TextBoxFor(model => model.bodyDiameter, new {@class="form-control" })%> 
             </div> 
             
             <div class="editor-label"> 
             <%: Html.Label("Unilateral Leg Diameter")%> 
             </div> 
                       <div class="editor-field"> 
                 <%: Html.TextBoxFor(model => model.unilateralDiameter, new { @class = "form-control" })%> 
             </div>
             
             <div class="editor-label"> 
             <%: Html.Label("Contralateral Leg Diameter") %> 
             </div> 
             <div class="editor-field"> 
                 <%: Html.TextBoxFor(model => model.contralateralDiameter, new { @class = "form-control" })%> 
             </div>
             
             <div class="editor-label"> 
             <%: Html.Label("Entry Point - Left or Right") %> 
             </div> 
             <div class="editor-field"> 
                 <%: Html.TextBoxFor(model => model.entryPoint, new { @class = "form-control" })%> 
             </div>
             
             </div>
             <div class="editor-label"> 
             <%: Html.Label("Endograft Body Length")%> 
             </div> 
             <div class="editor-field"> 
                 <%: Html.TextBoxFor(model => model.bodyLength, new { @class = "form-control" })%> 
             </div> 
             <div class="editor-label"> 
             <%: Html.Label("Unilateral Leg Length") %> 
             </div> 
             <div class="editor-field"> 
                 <%: Html.TextBoxFor(model => model.unilateralLength, new { @class = "form-control" })%> 
             </div> 
             
             <div class="editor-label"> 
             <%: Html.Label("Contralateral Leg Length") %> 
             </div> 
             <div class="editor-field"> 
                 <%: Html.TextBoxFor(model => model.contralateralLength, new { @class = "form-control" })%> 
             </div>
                                       
             <div class="editor-label"> 
             <%: Html.Label("Date of Surgery")%> 
             </div> 
             <div class="editor-field"> 
                 <%: Html.TextBox("Date of Surgery",null,new { @class = "form-control" })%> 
             </div>
              
             <div class="editor-label">
                    <label for="id_dropdown">Endograft Brand</label>
                </div>
                <div class="editor-field">
                    <%: Html.DropDownList("dropdown",(SelectList)ViewData["BrandList"],htmlAttributes: new {@id = "id_dropdown", @class="form-control"}) %>
                </div>
      </fieldset>       
      <br />
      <input type="submit" value="Upload File and Store Endograft Data" class="btn btn-danger"/>
               <span style="color:red;font-weight:bold">  
         <%=TempData["UploadValidationMessage_Failure"]%> 
         </span> 
 
 
          <span style="color:Green;font-weight:bold">  
          <%=TempData["UploadValidationMessage_Success"]%> 
        </span><br /><br /><br /> 
 <% 
        } %> 
 
 
    
      
 </asp:Content> 
