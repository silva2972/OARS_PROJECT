<%@ Page Title="" Language="C#" MasterPageFile="~/Views/Visualize/Dashboard.Master"
    Inherits="System.Web.Mvc.ViewPage<IEnumerable<TEAM5OIES.Models.Patient>>" %>

<asp:Content ID="Content1" ContentPlaceHolderID="TitleContent" runat="server">
    Index
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server">
    <h2 style="text-align: center">
        Patients</h2>
    <table style="width: 1000px">
        <div>
            <th style="text-align: center; width: 260px">
                patientID
            </th>
        </div>
        <div>
            <th style="text-align: center; width: 140px">
                originalID
            </th>
        </div>
        <div>
            <th style="text-align: center; width: 70px">
                sex
            </th>
        </div>
        <div>
            <th style="text-align: center; width: 70px">
                age
            </th>
        </div>
        <div>
            <th style="text-align: center; width: 140px">
                entryDate
            </th>
        </div>
        <div>
            <th style="text-align: center; width: 190px">
                dateOfSurgery
            </th>
        </div>
        <% foreach (var item in Model)
           { %>
        <tr>
            <td style="width: 260px">
                <%: item.patientID %>
            </td>
            <td style="text-align: center; width: 140px">
                <%: item.originalID %>
            </td>
            <td style="text-align: center; width: 70px">
                <%: item.sex %>
            </td>
            <td style="text-align: center; width: 70px">
                <%: item.age %>
            </td>
            <td style="text-align: center; width: 140px">
                <%: String.Format("{0:g}", item.entryDate) %>
            </td>
            <td style="text-align: center; width: 190px">
                <%: String.Format("{0:g}", item.dateOfSurgery) %>
            </td>
            <td style="text-align: left">
                <%: Html.ActionLink("Edit", "Edit") %>
            </td>
        </tr>
        <% } %>
    </table>
</asp:Content>
