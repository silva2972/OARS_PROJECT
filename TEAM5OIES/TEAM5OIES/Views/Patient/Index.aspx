<%@ Page Title="" Language="C#" MasterPageFile="~/Views/Visualize/Dashboard.Master" Inherits="System.Web.Mvc.ViewPage<IEnumerable<TEAM5OIES.Models.Patient>>" %>

<asp:Content ID="Content1" ContentPlaceHolderID="TitleContent" runat="server">
	Index
</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server">

    <h2>Index</h2>

    <table>
        <tr>
            <th></th>
            <th>
                patientID
            </th>
            <th>
                originalID
            </th>
            <th>
                sex
            </th>
            <th>
                age
            </th>
            <th>
                entryDate
            </th>
            <th>
                dateOfSurgery
            </th>
            <th></th>
        </tr>

    <% foreach (var item in Model) { %>
    
        <tr>
            <td>
                <%: Html.ActionLink("Edit", "Edit", new { id=item.patientID }) %>
            </td>
            <td>
                <%: item.patientID %>
            </td>
            <td>
                <%: item.originalID %>
            </td>
            <td>
                <%: item.sex %>
            </td>
            <td>
                <%: item.age %>
            </td>
            <td>
                <%: String.Format("{0:g}", item.entryDate) %>
            </td>
            <td>
                <%: String.Format("{0:g}", item.dateOfSurgery) %>
            </td>
        </tr>
    
    <% } %>

    </table>

</asp:Content>

