<%@ Page Title="" Language="C#" MasterPageFile="~/Views/Visualize/Dashboard.Master" Inherits="System.Web.Mvc.ViewPage<dynamic>" %>

<asp:Content ID="Content1" ContentPlaceHolderID="TitleContent" runat="server">
	Index
</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="server">
    <h2>Anonymize Your Patient's Data</h2>
    <br />
    <br />
    <br />
    <p>To anonymize data, please click the link below. If you are prompted to install Java, please first proceed with the install. <br />
    <br />
    Once you have proceeded to the Dicom Cleaner tool, please follow the below instructions: </p>
    <ul style = "list-style-type: disc">
        <li>
            Select Import
        </li>
        <li>
            Select patient's data from local files
        </li>
        <li>
            Select Clean
        </li>
        <li>
            Once cleaning is complete, be sure to check the box next to 'Zip Exported Files'
        </li>
        <li>
            Select Export
        </li>
        <li>
            Select the destination where you would like the anonymized zip file to be saved on your computer
        </li>
    </ul>
    <p>Once files are zipped, they are anonymized and ready to be uploaded.</p>
    <br />
    <asp:Hyperlink ID = "link1" 
        runat = "server" 
        Text = "Click to Anonymize and Zip" 
        Font-Size = "18pt" 
        Target = "_blank" 
        NavigateUrl="http://www.dclunie.com/pixelmed/software/webstart/DicomCleaner.jnlp" />
    <br />
    <br />
    <p> Due to HIPAA regulations, in order to upload your patient data, it must first be anonymized. 
    By proceeding with uploading, you certify that you have complied with the regulations by anonymizing the data. </p>
</asp:Content>
