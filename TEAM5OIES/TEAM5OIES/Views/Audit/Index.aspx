<%@ Page Title="" Language="C#" MasterPageFile="~/Views/Visualize/Dashboard.Master" Inherits="System.Web.Mvc.ViewPage<IEnumerable<TEAM5OIES.Models.Audit>>" %>

<asp:Content ID="Content1" ContentPlaceHolderID="TitleContent" runat="server">
	Index
</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server">

    <h2>Auditting - Change and Access History</h2>
    <form method="GET" action="/Audit/" class="form-inline">
        <label for="id_search" class="control-label">Search:</label><input type="text" id="id_search" name="searchString" class="form-control"/>
        <label for="id_page" class="control-label">Page Number:</label><input type="number" id="id_page" name="page" class="form-control"/>
        <button type="submit">Go&raquo;</button>
    </form>
    <table class="table table-bordered">
        <tr class="">
            <th>
                auditID
            </th>
            <th>
                userID
            </th>
            <th>
                username
            </th>
            <th>
                change_date
            </th>
            <th>
                changed_table
            </th>
            <th>
                attribute
            </th>
            <th>
                access
            </th>
        </tr>

    <% foreach (var item in Model) { %>
    
        <tr>
            <td>
                <%: item.auditID %>
            </td>
            <td>
                <%: item.userID %>
            </td>
            <td>
                <%: item.username %>
            </td>
            <td>
                <%: String.Format("{0:g}", item.change_date) %>
            </td>
            <td>
                <%: item.changed_table %>
            </td>
            <td>
                <%: item.attribute %>
            </td>
            <td>
                <%: item.access %>
            </td>
        </tr>
    
    <% } %>

    </table>

</asp:Content>

