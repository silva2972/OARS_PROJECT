-- fn: TEAM?OIES.sql 

-- SQL COMMENTED SQL COMMANDS
-- IF NOT EXISTS (SELECT * FROM sysobjects WHERE id = object_id(N'[dbo].[Audit]')
-- AND OBJECTPROPERTY(id, N'IsUserTable') = 1)
-- CREATE TABLE IF NOT EXISTS Audit
-- (
-- 	auditID uniqueidentifier NOT NULL PRIMARY KEY CONSTRAINT DF_AuditID DEFAULT newsequentialid(),
-- 	userID uniqueidentifier NOT NULL,
-- 	username varchar(50) NOT NULL,
-- 	change_date datetime NOT NULL,
-- 	changed_table varchar(50) NOT NULL,
-- 	attribute varchar(50) NOT NULL,
-- 	access varchar(50) NOT NULL
-- );

DROP TABLE CFD;
DROP TABLE Images;
DROP TABLE Series;
DROP TABLE Study;
DROP TABLE Testimonial;
DROP TABLE Endograft;
DROP TABLE Patient;
DROP TABLE Surgeon;
DROP TABLE Institution;
DROP TABLE Brand;


 CREATE TABLE Institution
 (
	institutionID uniqueidentifier NOT NULL PRIMARY KEY CONSTRAINT DF_instituionID DEFAULT newsequentialid(),
	institutionName varchar(50) NOT NULL,
	institutionLocation varchar(50) NOT NULL
);

CREATE TABLE Surgeon
(
	surgeonID uniqueidentifier NOT NULL PRIMARY KEY CONSTRAINT DF_AuditID DEFAULT newsequentialid(),
	firstName varchar(50) NOT NULL,
	lastName varchar(50) NOT NULL,
	userName varchar(50) NOT NULL,
	email varchar(50) NOT NULL,
        institutionID uniqueidentifier FOREIGN KEY REFERENCES Institution(institutionID)
 );
 
CREATE TABLE Patient
(
	patientID uniqueidentifier NOT NULL PRIMARY KEY CONSTRAINT DF_PatientID DEFAULT newsequentialid(),
	originalID uniqueidentifier NOT NULL,
	sex varchar(1) NOT NULL,
	age int NOT NULL,
	entryDate datetime NOT NULL,
	dateOfSurgery datetime NOT NULL,
        surgeonID uniqueidentifier FOREIGN KEY REFERENCES Surgeon(surgeonID)
);


CREATE TABLE Brand
(
	brandID uniqueidentifier NOT NULL PRIMARY KEY CONSTRAINT DF_BrandID DEFAULT newsequentialid(),
	brandName varchar(50) NOT NULL
);


CREATE TABLE Endograft
(
	endograftID uniqueidentifier NOT NULL PRIMARY KEY CONSTRAINT DF_EndograftID DEFAULT newsequentialid(),
	entry_Point varchar(50) NOT NULL,
	diameter varchar(50) NOT NULL,
	endograft_length varchar(50) NOT NULL,
	unilateralLegDiameter varchar(50) NOT NULL,
	unilateralLegLength varchar(50) NOT NULL,
	controlaterLegDiameter varchar(50) NOT NULL,
	controlaterLegLength varchar(50) NOT NULL,
        brandID uniqueidentifier NOT NULL FOREIGN KEY REFERENCES Brand(brandID)
);


CREATE TABLE Study
(
	studyID uniqueidentifier NOT NULL PRIMARY KEY CONSTRAINT DF_StudyID DEFAULT newsequentialid(),
	originalStudyID varchar(50) NOT NULL,
	studyDescription varchar(MAX) NOT NULL,
	studyDate datetime NOT NULL,
	CT varchar(50) NOT NULL,
        patientID uniqueidentifier NOT NULL FOREIGN KEY REFERENCES Patient(patientID)
);


CREATE TABLE Series
(
	seriesID uniqueidentifier NOT NULL PRIMARY KEY CONSTRAINT DF_SeriesID DEFAULT newsequentialid(),
	originalSeriesID varchar(50) NOT NULL,
	seriesDescription varchar(MAX) NOT NULL,
	seriesDate datetime NOT NULL,
	totalNumberOfSlices int NOT NULL,
	ROIBegin varchar(50) NOT NULL,
	IlliacBif varchar(50) NOT NULL,
        studyID uniqueidentifier NOT NULL FOREIGN KEY REFERENCES Study(studyID)
);


CREATE TABLE Images
(
	imageID uniqueidentifier NOT NULL PRIMARY KEY CONSTRAINT DF_ImagesID DEFAULT newsequentialid(),
	imageOrder varchar(50) NOT NULL,
	imageFileName varchar(50) NOT NULL,
	imageTitle varchar(50) NOT NULL,
	sliceThickness float NOT NULL,
	unilateralLegLength varchar(50) NOT NULL,
	pixelSize float,
        seriesID uniqueidentifier NOT NULL FOREIGN KEY REFERENCES Series(seriesID)
);


CREATE TABLE Testimonial
(
	testimonialID uniqueidentifier NOT NULL PRIMARY KEY CONSTRAINT DF_TestominalID DEFAULT newsequentialid(),
	content varchar(200) NOT NULL,
	author varchar(50) NOT NULL,
	testimonialDate datetime NOT NULL
);	

CREATE TABLE CFD
(
	cfdID uniqueidentifier NOT NULL PRIMARY KEY CONSTRAINT DF_cfdID DEFAULT newsequentialid(),
	currentDate datetime NOT NULL,
	done bit NOT NULL,
        patientID uniqueidentifier NOT NULL FOREIGN KEY REFERENCES Patient(patientID)
);	

CREATE TRIGGER [TEAM5OIES].[send_email_CFD] 
ON [TEAM5OIES].[CFD] 
	AFTER INSERT 
AS 
EXEC msdb..sp_send_dbmail 
@profile_name='smtps',
@recipients='TEAM5OIESSurgeon@gmail.com',
@subject='Test message from TEAM5OIES!',
@body='A DBA inserted something in the CFD table!';
-- 
-- 
-- 
-- 
-- 
-- ALTER TRIGGER [TEAM5OIES].[Audit_Patient_UPDATE]
-- ON [TEAM5OIES].[Patient]
-- 	AFTER Update
-- AS
-- BEGIN
--    INSERT INTO TEAM5OIES.Audit
--    (auditID, userID, username, change_date, changed_table, attribute, access)
--    VALUES(
--    NEWID(),
--    'F3CAEF91-C163-4C8C-8D3B-BC432F707E29',
--    'Surgeon1',
--    CURRENT_TIMESTAMP,
--    'Patient',
--    'All',
--    'UPDATE'
--    )
-- END
-- 
-- 
-- 
-- 
-- 
-- 
-- ALTER TRIGGER [TEAM5OIES].[Audit_Patient_Insert]
-- ON [TEAM5OIES].[Patient]
-- 	AFTER INSERT
-- AS
-- BEGIN
--    INSERT INTO TEAM5OIES.Audit
--    (auditID, userID, username, change_date, changed_table, attribute, access)
--    VALUES(
--    NEWID(),
--    'F3CAEF91-C163-4C8C-8D3B-BC432F707E29',
--    'Surgeon1',
--    CURRENT_TIMESTAMP,
--    'Patient',
--    'All',
--    'INSERT'
--    )
-- END
