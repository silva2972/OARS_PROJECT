<%@ Page Title="" Language="C#" MasterPageFile="~/Views/Visualize/Dashboard.Master" Inherits="System.Web.Mvc.ViewPage<dynamic>" %>

<asp:Content ID="Content1" ContentPlaceHolderID="TitleContent" runat="server">
    Visualize
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server">
    <h2>Visualize</h2>
    <form method="GET">
    <select name="filePath" class="target">
        <option>Select a Patient</option>
        <option>Patient 18</option>
        <option>Patient 19</option>
    </select>
    </form>
    <div class="row">
        <video class="col-md-10 hidden" width="936" height="570" autoplay loop><source src="<%:ViewData["Video"] %>"/></video>
        <a href="http://www.microdicom.com/downloads.html" class="col-md-2">Click Here To View
            This on your Local Machine</a>
    </div>
    <script>
        $(".target").change(function () { $("video").removeClass("hidden") });
            
    </script>
</asp:Content>
