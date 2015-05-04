<%@ Page Title="" Language="C#" MasterPageFile="~/Views/Shared/Site.Master" Inherits="System.Web.Mvc.ViewPage<TEAM5OIES.Models.Patient>" %>

<asp:Content ID="Content1" ContentPlaceHolderID="TitleContent" runat="server">
    Data Analysis
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server">
    <h2>
        Data Analysis</h2><h1 class="text-success">
        <%:ViewData["Success"] %></h1>
    <% using (Html.BeginForm("PatientSelection", "Patient", FormMethod.Post, new { encType = "multipart/form-data" }))
       {%>
    <br />
    
    <fieldset>
        <legend>Patient Information</legend>
        <div style="float: left; margin-right: 4px">
            <div class="editor-label">
                <%: Html.Label("Patient")%>
            </div>
            <div class="editor-field">
                <%: Html.DropDownList("PatientID",(SelectList)ViewData["PatientList"],htmlAttributes: new {@id = "id_patientDropdown", @class="form-control"}) %>
            </div>
            <div class="editor-label">
                <%: Html.Label("Study")%>
            </div>
            <div class="editor-field">
                <%: Html.DropDownList("StudyID",(SelectList)ViewData["StudyList"],htmlAttributes: new {@id = "id_studyDropdown", @class="form-control"}) %>
            </div>
            <div class="editor-label">
                <%: Html.Label("Series")%>
            </div>
            <div class="editor-field">
                <%: Html.DropDownList("SeriesID",(SelectList)ViewData["SeriesList"],htmlAttributes: new {@id = "id_seriesDropdown", @class="form-control"}) %>
            </div>
            <div class="editor-label">
                <%: Html.Label("ROI begin") %>
            </div>
            <div class="editor-field">
                <%: Html.TextBox("hello")%>
            </div>
            <div class="editor-label">
                <%: Html.Label("Illiac Biff")%>
            </div>
            <div class="editor-field">
                <%: Html.TextBox("howdy")%>
            </div>
            <div>
                <%: Html.TextArea("Body", null, 10, 55, null)%>
            </div>
        </div>
    </fieldset>
    <br />
    <input type="submit" value="Analyze Data" class="btn btn-danger" />
    <br />
    <br />
    <br />
    <%         } %>
</asp:Content>
