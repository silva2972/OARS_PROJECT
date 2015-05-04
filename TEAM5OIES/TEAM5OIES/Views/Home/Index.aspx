<%@ Page Language="C#" MasterPageFile="~/Views/Shared/Site.Master" Inherits="System.Web.Mvc.ViewPage" %>

<asp:Content ID="Content1" ContentPlaceHolderID="TitleContent" runat="server">
    Home Page | Anonymized EVAR
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server">
    <div class="jumbotron" style="background: url(http://medrevgroup.com/wp-content/uploads/2014/09/DNAWeb-1140x400.jpg) no-repeat center center fixed; background-position-y: 50px">
        <h1 style="color: indianred; text-shadow: 2px 2px 3px darkslategrey">
            <%: ViewData["Message"] %>
        </h1>
        <marquee direction="down" width="1000" height="100" behavior="alternate">
            <marquee behavior="alternate">
                <h2 style="color: whitesmoke; text-shadow: 2px 2px 3px darkslategrey">
                WELCOME TO THE ONLINE <b style="color: red">ANONYMIZED</b> EVAR SYSTEM!
                </h2>
            </marquee>
        </marquee>
    </div>
    <br/>
    <p>TEAM5OIES’s Anonymized Online International EVAR System will allow doctors and researchers around the world to share data and analysis about endovascular aneurism repair (EVAR) patients.
        The application provides a variety of medical professionals including surgeons, CFD Scientists, and Computational Scientists the tools needed to upload both 
        preoperative and postoperative data, store this data, and analyze it.    With the use of this information, we hope to provide a system in which better diagnoses and follow ups can be made,
         in turn improving and saving lives.   This website complies with HIPAA regulations through the use of anonymizing data. </p>
</asp:Content>