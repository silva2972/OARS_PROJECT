<%@ Page Language="C#" MasterPageFile="~/Views/Shared/Site.Master" Inherits="System.Web.Mvc.ViewPage" %>

<asp:Content ID="aboutTitle" ContentPlaceHolderID="TitleContent" runat="server">
    About Us
</asp:Content>
<asp:Content ID="aboutContent" ContentPlaceHolderID="MainContent" runat="server">
    
    <div class="row jumbotron" style="background-color: azure">
        <h2 style="padding-bottom: 18px; font-size: 30px">
        TEAM5OIES Members:</h2>
        <div class="col-md-4">
            
            <dl>
                <dt><u>Team Leader</u></dt>
                <dd>   Obinna Ugwuzor</dd>
                <br />
                <dt><u>Software Quality Assurance</u></dt>
                <dd>   Edison Guevara</dd>
                <dd>   Shah Zaib</dd>
                <br />
                <dt><u>Database Administrators</u></dt>
                <dd>   Jessica Balanag</dd>
                <dd>   Kenny Loveall</dd>
                <br />
                <dt><u>Team Members</u></dt>
                <dd>   Michelle George</dd>
                <dd>   Ryan Hornick</dd>
                <dd>   Joe Lu</dd>
                <dd>   Hector Reyna</dd>
            </dl>
         </div>
        <div class="pull-right">
            <img src="http://thumb101.shutterstock.com/display_pic_with_logo/1198163/131746163/stock-photo-medicine-doctor-hand-working-with-modern-computer-interface-as-concept-131746163.jpg"/>
        </div>
    </div>
</asp:Content>
