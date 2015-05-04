--------------------------------------------------------------------------------
------ WARNING: Does not automatically drop previously existing triggers -------
-- delete those manually or add automatic dropping before running this script --
--------------------------------------------------------------------------------

USE TEAM5OIES
GO

CREATE TRIGGER Audit_Brand
ON TEAM5OIES.Brand
	AFTER INSERT, DELETE
AS
BEGIN
   INSERT INTO TEAM5OIES.Audit (auditID, userID, username, change_date, changed_table, attribute, access)
   VALUES(
   NEWID(),
   CURRENT_USER,
   CURRENT_USER,
   CURRENT_TIMESTAMP,
   'Brand',
   'All',
   'Do not know what goes here'
   )
END
GO

CREATE TRIGGER Audit_Endograft
ON TEAM5OIES.Endograft
	AFTER INSERT, DELETE
AS
BEGIN
   INSERT INTO TEAM5OIES.Audit (auditID, userID, username, change_date, changed_table, attribute, access)
   VALUES(
   NEWID(),
   CURRENT_USER,
   CURRENT_USER,
   CURRENT_TIMESTAMP,
   'Endograft',
   'All',
   'Do not know what goes here'
   )
END
GO

CREATE TRIGGER Audit_Images
ON TEAM5OIES.Images
	AFTER INSERT, DELETE
AS
BEGIN
   INSERT INTO TEAM5OIES.Audit (auditID, userID, username, change_date, changed_table, attribute, access)
   VALUES(
   NEWID(),
   CURRENT_USER,
   CURRENT_USER,
   CURRENT_TIMESTAMP,
   'Images',
   'All',
   'Do not know what goes here'
   )
END
GO

CREATE TRIGGER Audit_Institution
ON TEAM5OIES.Institution
	AFTER INSERT, DELETE
AS
BEGIN
   INSERT INTO TEAM5OIES.Audit (auditID, userID, username, change_date, changed_table, attribute, access)
   VALUES(
   NEWID(),
   CURRENT_USER,
   CURRENT_USER,
   CURRENT_TIMESTAMP,
   'Institution',
   'All',
   'Do not know what goes here'
   )
END
GO

CREATE TRIGGER Audit_Patient
ON TEAM5OIES.Patient
	AFTER INSERT, DELETE
AS
BEGIN
   INSERT INTO TEAM5OIES.Audit (auditID, userID, username, change_date, changed_table, attribute, access)
   VALUES(
   NEWID(),
   CURRENT_USER,
   CURRENT_USER,
   CURRENT_TIMESTAMP,
   'Patient',
   'All',
   'Do not know what goes here'
   )
END
GO

CREATE TRIGGER Audit_Series
ON TEAM5OIES.Series
	AFTER INSERT, DELETE
AS
BEGIN
   INSERT INTO TEAM5OIES.Audit (auditID, userID, username, change_date, changed_table, attribute, access)
   VALUES(
   NEWID(),
   CURRENT_USER,
   CURRENT_USER,
   CURRENT_TIMESTAMP,
   'Series',
   'All',
   'Do not know what goes here'
   )
END
GO

CREATE TRIGGER Audit_Study
ON TEAM5OIES.Study
	AFTER INSERT, DELETE
AS
BEGIN
   INSERT INTO TEAM5OIES.Audit (auditID, userID, username, change_date, changed_table, attribute, access)
   VALUES(
   NEWID(),
   CURRENT_USER,
   CURRENT_USER,
   CURRENT_TIMESTAMP,
   'Study',
   'All',
   'Do not know what goes here'
   )
END
GO

CREATE TRIGGER Audit_Surgeon
ON TEAM5OIES.Surgeon
	AFTER INSERT, DELETE
AS
BEGIN
   INSERT INTO TEAM5OIES.Audit (auditID, userID, username, change_date, changed_table, attribute, access)
   VALUES(
   NEWID(),
   CURRENT_USER,
   CURRENT_USER,
   CURRENT_TIMESTAMP,
   'Surgeon',
   'All',
   'Do not know what goes here'
   )
END
GO

CREATE TRIGGER Audit_Testimonial
ON TEAM5OIES.Testimonial
	AFTER INSERT, DELETE
AS
BEGIN
   INSERT INTO TEAM5OIES.Audit (auditID, userID, username, change_date, changed_table, attribute, access)
   VALUES(
   NEWID(),
   CURRENT_USER,
   CURRENT_USER,
   CURRENT_TIMESTAMP,
   'Testimonial',
   'All',
   'Do not know what goes here'
   )
END
GO