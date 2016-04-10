-- fn: TEAM5OARS.sql 

-- SQL COMMENTED SQL COMMANDS

-- Create the database and use it
CREATE DATABASE IF NOT EXISTS TEAM5OARS;
USE TEAM5OARS;

-- Drop tables if the exist and create new ones

-- Creating a new staff table
DROP TABLE IF EXISTS staff;
CREATE TABLE IF NOT EXISTS staff
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

-- Creating a new tenant table
DROP TABLE IF EXISTS tenant;    
CREATE TABLE IF NOT EXISTS tenant
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

-- Creating a new apartment table
DROP TABLE IF EXISTS apartment;	
CREATE TABLE IF NOT EXISTS apartment
	(apt_no INT NOT NULL,
	apt_type INT NOT NULL,
	apt_status ENUM('R', 'V') NOT NULL,
	apt_utility ENUM('Y', 'N') NOT NULL,
	apt_deposit_amt INT NOT NULL,
	apt_rent_amt INT NOT NULL,
	PRIMARY KEY (apt_no));
DESC apartment;

-- Creating a new tenant_auto table
DROP TABLE IF EXISTS tenant_auto;    
CREATE TABLE IF NOT EXISTS tenant_auto
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
CREATE TABLE IF NOT EXISTS tenant_family
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

-- Creating a new rental table
DROP TABLE IF EXISTS rental;
CREATE TABLE IF NOT EXISTS rental
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

-- Creating a new rental_invoice table
DROP TABLE IF EXISTS rental_invoice;    
CREATE TABLE IF NOT EXISTS rental_invoice
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
CREATE TABLE IF NOT EXISTS complaints
	(complaint_no INT NOT NULL,
	complaint_date DATE NOT NULL,
	rental_complaint TEXT,
	apt_complaint TEXT,
	status ENUM('F', 'P') NULL,
	rental_no INT,
	apt_no INT NOT NULL,
	PRIMARY KEY (complaint_no),
	FOREIGN KEY (rental_no) REFERENCES rental(rental_no),
	FOREIGN KEY (apt_no) REFERENCES apartment(apt_no));
DESC complaints;

-- Creating a new testimonials table 
DROP TABLE IF EXISTS testimonials; 
CREATE TABLE IF NOT EXISTS testimonials
	(testimonial_id INT NOT NULL AUTO_INCREMENT,
	testimonial_date DATE NOT NULL,
	testimonial_content TEXT NOT NULL,
	tenant_ss CHAR(9),
	PRIMARY KEY (testimonial_id),
	FOREIGN KEY (tenant_ss) REFERENCES tenant(tenant_ss));
DESC testimonials;
