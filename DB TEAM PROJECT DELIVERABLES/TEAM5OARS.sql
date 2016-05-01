-- fn: TEAM5OARS.sql 

-- SQL COMMENTED SQL COMMANDS

-- Create the database and use it
CREATE DATABASE IF NOT EXISTS TEAM5OARS;
USE TEAM5OARS;

-- Drop tables if the exist and create new ones
SET FOREIGN_KEY_CHECKS = 0;

-- Creating a new staff table
DROP TABLE IF EXISTS staff;
CREATE TABLE staff
	(staff_no CHAR(5) NOT NULL,
	fname VARCHAR(25) NOT NULL,
    lname VARCHAR(25) NOT NULL,
    position VARCHAR(30) NOT NULL,
    gender ENUM('M', 'F') NOT NULL,
    dob DATE NOT NULL,
    salary INT NOT NULL,
    username VARCHAR(25) NOT NULL,
    password VARCHAR(64) NOT NULL,
	PRIMARY KEY (staff_no));
DESC staff;

-- Creating a new apartment table
DROP TABLE IF EXISTS apartment;	
CREATE TABLE apartment
	(apt_no INT NOT NULL,
	apt_type INT NOT NULL,
	apt_status ENUM('R', 'V') NOT NULL,
	apt_utility ENUM('Y', 'N') NOT NULL,
	apt_deposit_amt INT NOT NULL,
	apt_rent_amt INT NOT NULL,
	PRIMARY KEY (apt_no));
DESC apartment;

-- Creating a new rental table
DROP TABLE IF EXISTS rental;
CREATE TABLE rental
	(rental_no INT NOT NULL,
	rental_date DATE NOT NULL,
	rental_status ENUM('O', 'S') NOT NULL,
	cancel_date DATE,
	lease_type ENUM('One', 'Six') NOT NULL,
	lease_start DATE NOT NULL,
	lease_end DATE NOT NULL,
	renewal_date DATE,
	staff_no CHAR(5) NOT NULL,
	apt_no INT NOT NULL,
	FOREIGN KEY(apt_no) REFERENCES apartment(apt_no),
	FOREIGN KEY(staff_no) REFERENCES staff(staff_no),
	PRIMARY KEY (rental_no));
DESC rental;

-- Creating a new tenant table
DROP TABLE IF EXISTS tenant;    
CREATE TABLE tenant
	(tenant_ss CHAR(9) NOT NULL,
	tenant_name VARCHAR(50) NOT NULL,
	tenant_dob DATE NOT NULL,
	marital ENUM('M', 'S') NOT NULL,
	work_phone CHAR(10),
	home_phone CHAR(10),	
	employer_name VARCHAR(50),
	gender ENUM('M', 'F') NOT NULL,	
	username VARCHAR(25) NOT NULL,
	password VARCHAR(64) NOT NULL,
	rental_no INTEGER NOT NULL,
	PRIMARY KEY (tenant_ss),
	FOREIGN KEY (rental_no) REFERENCES rental(rental_no));
DESC tenant;

-- Creating a new tenant_auto table
DROP TABLE IF EXISTS tenant_auto;    
CREATE TABLE tenant_auto
	(license_no CHAR(7) NOT NULL,
	auto_make VARCHAR(25) NOT NULL,
	auto_model VARCHAR(25) NOT NULL,
	auto_year YEAR NOT NULL,
	auto_color VARCHAR(15),
	tenant_ss CHAR(9) NOT NULL,
	PRIMARY KEY (license_no),
	FOREIGN KEY (tenant_ss) REFERENCES tenant(tenant_ss));
DESC tenant_auto;

-- Creating a new tenant_family
DROP TABLE IF EXISTS tenant_family;    
CREATE TABLE tenant_family
	(family_ss CHAR(9) NOT NULL,
	full_name VARCHAR(50) NOT NULL,
	spouse ENUM('Y', 'N') NOT NULL,
	child ENUM('Y', 'N') NOT NULL,
	divorced ENUM('Y', 'N') NOT NULL,
	single ENUM('Y', 'N') NOT NULL,
	gender ENUM('M', 'F') NOT NULL,
	dob DATE NOT NULL,
	tenant_ss CHAR(9) NOT NULL,
	PRIMARY KEY (family_ss),
	FOREIGN KEY (tenant_ss) REFERENCES tenant(tenant_ss));
DESC tenant_family;

-- Creating a new rental_invoice table
DROP TABLE IF EXISTS rental_invoice;    
CREATE TABLE rental_invoice
	(invoice_no INT NOT NULL,
	invoice_date DATE NOT NULL,
	invoice_due INT NOT NULL,
	cc_no CHAR(16) NOT NULL,
	cc_type VARCHAR(16) NOT NULL,
	cc_exp_date DATE NOT NULL,
	cc_amt INT NOT NULL,
	rental_no INT NOT NULL,
	PRIMARY KEY (invoice_no),
	FOREIGN KEY (rental_no) REFERENCES rental(rental_no));
DESC rental_invoice;

-- Creating a new complaints table
DROP TABLE IF EXISTS complaints;
CREATE TABLE complaints
	(complaint_no INT NOT NULL,
	complaint_date DATE NOT NULL,
	rental_complaint TEXT,
	apt_complaint TEXT,
	status ENUM('F', 'P') NULL,
	rental_no INT,
	apt_no INT NULL,
	PRIMARY KEY (complaint_no),
	FOREIGN KEY (rental_no) REFERENCES rental(rental_no),
	FOREIGN KEY (apt_no) REFERENCES apartment(apt_no));
DESC complaints;

-- Creating a new testimonials table 
DROP TABLE IF EXISTS testimonials; 
CREATE TABLE testimonials
	(testimonial_id INT NOT NULL AUTO_INCREMENT,
	testimonial_date DATE NOT NULL,
	testimonial_content TEXT NOT NULL,
	tenant_ss CHAR(9),
	PRIMARY KEY (testimonial_id),
	FOREIGN KEY (tenant_ss) REFERENCES tenant(tenant_ss));
DESC testimonials;

SET FOREIGN_KEY_CHECKS = 1;


-- Populate tables
INSERT INTO staff VALUES
('SA200', 'Joe', 'White', 'Assistant', 'M', '1982-07-08', '24000', 'ASSISTANT1', 'ASSISTANT1#'),
('SA210', 'Ann', 'Tremble', 'Assistant', 'F', '1981-06-12', '26000', 'ASSISTANT2', 'ASSISTANT2#'),
('SA220', 'Terry', 'Ford', 'Manager', 'M', '1967-10-20', '53000', 'MANAGER', 'MANAGER#'),
('SA230', 'Susan', 'Brandon', 'Supervisor', 'F', '1977-03-10', '46000', 'SUPERVISOR', 'SUPERVISOR#'),
('SA240', 'Julia', 'Roberts', 'Assistant', 'F', '1982-09-12', '28000', 'ASSISTANT3', 'ASSISTANT3#')
;
    
    
INSERT INTO apartment VALUES
(100, 0, 'R', 'Y', 200, 300),
(101, 0, 'R', 'N', 200, 300),
(102, 0, 'R', 'Y', 200, 300),
(103, 1, 'V', 'N', 300, 400),
(104, 1, 'R', 'Y', 300, 400),
(200, 2, 'V', 'Y', 400, 500),
(201, 2, 'R', 'Y', 400, 500),
(202, 3, 'V', 'Y', 500, 700),
(203, 3, 'R', 'Y', 500, 700)
;

INSERT INTO rental VALUES
(100101, '2001-05-12', 'O', '2001-06-30', 'One', '2001-06-01', '2003-05-31', '2003-03-31', 'SA200', 201),
(100102, '2001-05-21', 'O', '2001-06-30', 'Six', '2001-06-01', '2003-05-31', '2003-03-31', 'SA220', 102),
(100103, '2001-10-12', 'O', '2001-11-30', 'Six', '2001-11-01', '2003-11-30', '2003-09-30', 'SA240', 203),
(100104, '2002-03-06', 'O', '2002-04-30', 'One', '2002-04-02', '2003-03-31', '2003-01-31', 'SA210', 101),
(100105, '2002-04-15', 'O', '2002-05-30', 'One', '2002-05-02', '2003-04-30', '2003-02-28', 'SA220', 104),
(100106, '2002-06-15', 'S', '2002-08-30', 'One', '2002-08-02', '2003-06-30', '2003-06-30', 'SA200', 100)
;

INSERT INTO tenant VALUES
('123456789', 'Jack Robin', '1960-06-21', 'M', '4173452323', '4175556565', 'Kraft Inc', 'M', 'TENANT1', 'TENANT1#', 100101),
('723556089', 'Mary Stackles', '1980-08-02', 'S', '4175453320', '417667565', 'Kraft Inc', 'F', 'TENANT2', 'TENANT2#', 100102),
('450452267', 'Ramu Reddy', '1962-04-11', 'M', '4178362323', '4172220565', 'SMSU', 'M', 'TENANT3', 'TENANT3#', 100103),
('223056180', 'Marion Black', '1981-05-25', 'S', '4174257766', '4176772364', 'SMSU', 'M', 'TENANT4', 'TENANT4#', 100104),
('173662690', 'Venessa Williams', '1970-03-12', 'M', '4175557878', '4173362565', 'Kraft Inc', 'F', 'TENANT5', 'TENANT5#', 100105)
;

INSERT INTO tenant_auto VALUES
('SYK332', 'Ford', 'Taurus', '1999', 'Red', '123456789'),
('TTS430', 'Volvo', 'GL 740', '1990', 'Green', '123456789'),
('ABC260', 'Toyota', 'Lexus', '2000', 'Maroon', '723556089'),
('LLT332', 'Honda', 'Accord', '2011', 'Blue', '450452267'),
('KYK100', 'Toyota', 'Camry', '1999', 'Black', '450452267'),
('FLT232', 'Honda', 'Civic', '1999', 'Red', '223056180'),
('LLT668', 'Volvo', 'GL 980', '2000', 'Velvet', '173662690')
;
    
INSERT INTO tenant_family VALUES
('444663434', 'Kay Robin', 'Y', 'N', 'N', 'N', 'F', '1965-06-21', '123456789'),
('222664343', 'Sarla Reddy', 'Y', 'N', 'N', 'N', 'F', '1965-06-11', '450452267'),
('222663434', 'Anjali Reddy', 'N', 'Y', 'N', 'N', 'F', '1990-08-10', '450452267'),
('111444663', 'Terry Williams', 'Y', 'N', 'N', 'N', 'F', '1968-03-21', '173662690'),
('242446634', 'Tom Williams', 'N', 'Y', 'N', 'N', 'M', '1991-56-20', '173662690')
;
    
INSERT INTO rental_invoice VALUES
(1000, '2001-03-12', 500, '1234567890123456', 'visa'		, '2002-12-01', 500, 100101),
(1001, '2001-04-30', 500, '1234567890123456', 'visa'		, '2002-12-01', 500, 100101),
(1002, '2001-05-30', 500, '1234567890123456', 'visa'		, '2002-12-01', 500, 100101),
(1003, '2001-06-30', 500, '1234567890123456', 'visa'		, '2002-12-01', 500, 100101),
(1004, '2001-07-30', 500, '1234567890123456', 'mastercard'	, '2002-12-01', 500, 100101),
(1005, '2001-08-30', 500, '1234567890123456', 'mastercard'	, '2002-12-01', 500, 100101),
(1006, '2001-09-30', 500, '1234567890123456', 'visa'		, '2002-12-01', 500, 100101),
(1007, '2001-10-30', 500, '1234567890123456', 'visa'		, '2002-12-01', 500, 100101),
(1008, '2001-11-30', 500, '1234567890123456', 'visa'		, '2002-12-01', 500, 100101),
(1009, '2001-05-21', 300, '3343567890123456', 'mastercard'	, '2003-10-01', 300, 100102),
(1010, '2001-06-30', 300, '3343567890123456', 'mastercard'	, '2003-10-01', 300, 100102),
(1011, '2001-07-30', 300, '3343567890123456', 'mastercard'	, '2003-10-01', 300, 100102),
(1012, '2001-08-30', 300, '3343567890123456', 'mastercard'	, '2003-10-01', 300, 100102),
(1013, '2001-09-30', 300, '3343567890123456', 'mastercard'	, '2003-10-01', 300, 100102),
(1014, '2001-10-30', 300, '3343567890123456', 'mastercard'	, '2003-10-01', 300, 100102),
(1015, '2001-11-30', 300, '3343567890123456', 'mastercard'	, '2003-10-01', 300, 100102),
(1016, '2001-10-12', 700, '8654567890123456', 'discover'	, '2003-11-01', 700, 100103),
(1017, '2001-11-30', 700, '8654567890123456', 'discover'	, '2003-11-01', 700, 100103),
(1018, '2002-03-02', 500, '7766567890123203', 'visa'		, '2003-09-01', 500, 100104),
(1019, '2002-04-02', 300, '7766567890123203', 'visa'		, '2003-09-01', 300, 100104),
(1020, '2002-05-02', 300, '7766567890123203', 'visa'		, '2003-09-01', 300, 100104),
(1021, '2002-06-02', 300, '7766567890123203', 'visa'		, '2003-09-01', 300, 100104),
(1022, '2002-07-02', 300, '7766567890123203', 'visa'		, '2003-09-01', 300, 100104),
(1023, '2002-04-02', 700, '6599567890126211', 'visa'		, '2003-12-01', 700, 100105),
(1024, '2002-05-02', 400, '6599567890126211', 'visa'		, '2003-12-01', 400, 100105),
(1025, '2002-06-02', 400, '6599567890126211', 'discover'	, '2003-12-01', 400, 100105),
(1026, '2002-07-02', 400, '6599567890126211', 'discover'	, '2003-12-01', 400, 100105)
;
    
INSERT INTO complaints VALUES
(10010, '2001-06-12', null						, 'kitchen sink clogged'		, 'F'	, 100103, 203),
(10011, '2001-08-17', null						, 'water heater not working'	, 'F'	, 100105, 104),
(10012, '2002-09-17', null						, 'room heater problem'			, 'F'	, 100105, 104),
(10013, '2002-09-17', null						, 'air conditioning not working', null	, null	, 103),
(10014, '2002-10-10', 'car parking not proper'	, null							, null	, 100103, null),
(10015, '2002-11-08', 'delay in payment'		, null							, 'F'	, 100102, null),
(10016, '2002-11-16', null						,'utility not working'			, null	, null	, 202)
;
    
INSERT INTO testimonials VALUES
(1, '2002-03-31', 'I really like TEAM5OARS Online Apartment Rental System!', '123456789'),
(2, '2002-04-09', 'I think that this TEAM5OARS website can be improved!', '450452267'),
(3, '2002-04-25', 'I believe that the Tenants and Visitors will like TEAM5OARS since they can rent and manage apartments online.', '173662690')
;