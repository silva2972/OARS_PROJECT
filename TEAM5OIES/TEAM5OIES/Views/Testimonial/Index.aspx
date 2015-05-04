<%@ Page Title="" Language="C#" MasterPageFile="~/Views/Shared/Site.Master" Inherits="System.Web.Mvc.ViewPage<dynamic>" %>

<asp:Content ID="Content1" ContentPlaceHolderID="TitleContent" runat="server">
    Testimonials
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server">
    <h2>Testimonials</h2>
    <div class="pull-right">
        <% using (Html.BeginForm())
           { %>
            <div class="form-inline">
                <input name="withtext" placeholder="Text" class="form-group input-sm"/>
                <input name="withauthor" placeholder="Author" class="form-group input-sm"/>
                <input type="submit" value="search" class="form-group btn-sm"/>
             </div>
        <% } %>
    </div>
    <% foreach (TEAM5OIES.Models.Testimonial item in Model)
       {%>
    <blockquote>
        <%: item.content %><br />
        <footer><%: item.author %></footer>
    </blockquote>
    <% } %>
    <%: Html.ActionLink("Add your testimonial", "Create", "Testimonial",
        new { @class="btn btn-primary btn-lg" }
        ) %>
</asp:Content>
