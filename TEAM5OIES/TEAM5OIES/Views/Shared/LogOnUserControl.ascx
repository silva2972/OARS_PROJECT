<%@ Control Language="C#" Inherits="System.Web.Mvc.ViewUserControl" %>
<%
    if (Request.IsAuthenticated) {
%>
        <li class="navbar-text">Welcome <%: Page.User.Identity.Name %>!</li>
        <li><%: Html.ActionLink("Log Off", "LogOff", "Account") %></li>
<%
    }
    else {
%>
        <li><%: Html.ActionLink("Log On", "LogOn", "Account") %></li>
<%
    }
%>
