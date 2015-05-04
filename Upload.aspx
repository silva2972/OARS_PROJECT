<%@ Page Title="" Language="C#" MasterPageFile="~/Views/Shared/Site.Master" Inherits="System.Web.Mvc.ViewPage<dynamic>" %>

<asp:Content ID="Content1" ContentPlaceHolderID="TitleContent" runat="server">
	Upload
</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server">

    
<h2>Upload Evar Data</h2>
   <% using (Html.BeginForm("Upload","Upload",
                    FormMethod.Post,new { enctype = "multipart/form-data" }))
        {%>
        <input name="uploadFile" type="file" />
        <input type="submit" value="Upload File"/>
        <span style="color:red;font-weight:bold"> 
        <%=TempData["UploadValidationMessage_Failure"]%>
        </span>

         <span style="color:Green;font-weight:bold"> 
         <%=TempData["UploadValidationMessage_Success"]%>
        </span>
<%} %>

</asp:Content>
