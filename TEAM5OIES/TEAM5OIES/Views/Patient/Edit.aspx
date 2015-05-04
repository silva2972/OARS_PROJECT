<%@ Page Title="" Language="C#" MasterPageFile="~/Views/Visualize/Dashboard.Master" Inherits="System.Web.Mvc.ViewPage<TEAM5OIES.Models.Patient>" %>

<asp:Content ID="Content1" ContentPlaceHolderID="TitleContent" runat="server">
	Edit
</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server">

    <h2>Edit</h2>

    <% using (Html.BeginForm()) {%>
        <%: Html.ValidationSummary(true) %>
        
        <fieldset>
            <legend>Fields</legend>
            
            <div class="editor-label">
                <%: Html.LabelFor(model => model.patientID) %>
            </div>
            <div class="editor-field">
                <%: Html.TextBoxFor(model => model.patientID) %>
                <%: Html.ValidationMessageFor(model => model.patientID) %>
            </div>
            
            <div class="editor-label">
                <%: Html.LabelFor(model => model.originalID) %>
            </div>
            <div class="editor-field">
                <%: Html.TextBoxFor(model => model.originalID) %>
                <%: Html.ValidationMessageFor(model => model.originalID) %>
            </div>
            
            <div class="editor-label">
                <%: Html.LabelFor(model => model.sex) %>
            </div>
            <div class="editor-field">
                <%: Html.TextBoxFor(model => model.sex) %>
                <%: Html.ValidationMessageFor(model => model.sex) %>
            </div>
            
            <div class="editor-label">
                <%: Html.LabelFor(model => model.age) %>
            </div>
            <div class="editor-field">
                <%: Html.TextBoxFor(model => model.age) %>
                <%: Html.ValidationMessageFor(model => model.age) %>
            </div>
            
            <div class="editor-label">
                <%: Html.LabelFor(model => model.entryDate) %>
            </div>
            <div class="editor-field">
                <%: Html.TextBoxFor(model => model.entryDate, String.Format("{0:g}", Model.entryDate)) %>
                <%: Html.ValidationMessageFor(model => model.entryDate) %>
            </div>
            
            <div class="editor-label">
                <%: Html.LabelFor(model => model.dateOfSurgery) %>
            </div>
            <div class="editor-field">
                <%: Html.TextBoxFor(model => model.dateOfSurgery, String.Format("{0:g}", Model.dateOfSurgery)) %>
                <%: Html.ValidationMessageFor(model => model.dateOfSurgery) %>
            </div>
            
            <p>
                <input type="submit" value="Save" />
            </p>
        </fieldset>

    <% } %>

    <div>
        <%: Html.ActionLink("Back to List", "Index") %>
    </div>

</asp:Content>

