<%@ Page Language="C#" MasterPageFile="~/Views/Shared/Site.Master" Inherits="System.Web.Mvc.ViewPage" %>

<asp:Content ID="aboutTitle" ContentPlaceHolderID="TitleContent" runat="server">
    About Us
</asp:Content>

<asp:Content ID="aboutContent" ContentPlaceHolderID="MainContent" runat="server">
    <h1 style="padding-bottom: 18px;font-size: 30px">Contact Us</h1>
        <address  style="padding-left: 24px">
        If you would like to reach us, please feel free to chat with us below! <br />
        If there is not an available operator, please send us an email or <br />
        reach out to us using the following information:<br />
        </address>
        
        <address  style="padding-left: 24px">
        4800 Calhoun Road<br />
        Houston, TX 77004<br />
        <abbr title="Phone">P:</abbr>
        555.123.4568
        </address>

        <address  style="padding-left: 24px">
        <strong>Support:</strong>   <a href="mailto:Support@team5oies.org">Support@team5oies.org</a>
        </address>
</asp:Content>
