<%@ Page Title="" Language="C#" MasterPageFile="~/Views/Shared/Site.Master" Inherits="System.Web.Mvc.ViewPage<TEAM5OIES.Models.Testimonial>" %>
<%@ Import Namespace="System.Activities.Expressions" %>

<asp:Content ID="Content1" ContentPlaceHolderID="TitleContent" runat="server">
    Create
</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server">

    <h2 style="padding-bottom: 3%">Enter your testimonial</h2>

    <% using (Html.BeginForm())
       { %>
        <% Dictionary<string, object> textBoxAttributes = new Dictionary<string, object>();
           textBoxAttributes.Add("class", "input-sm");

           Dictionary<string, object> textAreaAttributes = new Dictionary<string, object>();
           textAreaAttributes.Add("class", "input-lg");
           textAreaAttributes.Add("cols", "45");
           textAreaAttributes.Add("rows", "4");
        %>
        <%: Html.ValidationSummary(true) %>

        <div class="row">

            <div class="container-fluid col-lg-12">
                <div class="editor-label text-center">
                    <%: Html.LabelFor(model => model.content) %>
                </div>
                <div class="editor-field text-center">
                    <%: Html.TextAreaFor(model => model.content, textAreaAttributes) %>
                    <%: Html.ValidationMessageFor(model => model.content) %>
                </div>
                
                <br/>

                <div class="editor-label text-center">
                    <%: Html.LabelFor(model => model.author) %>
                </div>
                <div class="editor-field text-center">
                    <%: Html.TextBoxFor(model => model.author, textBoxAttributes) %>
                    <%: Html.ValidationMessageFor(model => model.author) %>
                </div>

                <p><br/>
                    <input type="submit" value="Create" class="btn btn-success form-control center-block"/>
                </p>
            </div>
        </div>

    <% } %>

    <div>
        <%: Html.ActionLink("Back to testimonials", "Index") %>
    </div>

</asp:Content>