CREATE TABLE People(
	Aadhar_ID numeric(12,0) primary key,
	Full_Name varchar(50) not null,
	Father_Name varchar(50) not null,
	Occupation varchar(30),
	Physically_Hndicapped boolean not null,
	Gender varchar(10) not null,
	Date_of_Birth date not null,
	Image varbinary(6553)
	-- check (Aadhar_ID >= 0)
);

CREATE TABLE User(
	Password_Hash char(64) not null,
	-- 
	Phone_Number numeric(10,0) primary key
);

CREATE TABLE FIR(
	Police_Station_No integer ,
	FIR_No integer primary key AUTO_INCREMENT,
	Phone_Number numeric(10,0) not null,
	-- here
	FIR_Description varchar(2000) not null,
	Status varchar(100),
	FIR_Date date not null,
	foreign key (Phone_Number) REFERENCES User(Phone_Number)
);

CREATE TABLE Updates(
	Update_No integer not null,
	Description varchar(100) not null,
	FIR_No integer,
	primary key(FIR_No,Update_No),
	foreign key (FIR_No) REFERENCES FIR(FIR_No) 
);

CREATE TABLE Property(
	Property_No integer not null,
	-- here
	Description varchar(100) not null,
	FIR_No integer,
	primary key(Property_No, FIR_No),
	foreign key (FIR_No) REFERENCES FIR(FIR_No)
);

CREATE TABLE Suspect(
	Suspect_No integer not null,
	-- here
	Description varchar(100) not null,
	FIR_No integer,
	primary key(Suspect_No,FIR_No),
	foreign key (FIR_No) REFERENCES FIR(FIR_No)
);

CREATE TABLE Police_Station(
	Police_Station_No integer primary key AUTO_INCREMENT,
	-- here
	Police_Station_Name varchar(50) not null,
	State varchar(50) not null,
	District varchar(50) not null,
	City varchar(50) not null,
	Phone_Number numeric(10,0) not null
);

CREATE TABLE Police_Officer(
	Police_ID integer primary key AUTO_INCREMENT,
	Aadhar_ID numeric(12,0) not null,
	Police_Station_No integer not null,
	foreign key (Aadhar_ID) REFERENCES People(Aadhar_ID),
	foreign key (Police_Station_No) REFERENCES Police_Station(Police_Station_No)
);

CREATE TABLE General_Diary(
	FIR_No integer,
	Police_ID integer not null,
	primary key(FIR_No),
	foreign key (FIR_No) REFERENCES FIR(FIR_No),
	foreign key (Police_ID) REFERENCES Police_Officer(Police_ID) 
);

-- CREATE TABLE Judge(
-- 	Judge_ID integer primary key AUTO_INCREMENT, 
-- 	Aadhar_ID numeric(12,0) not null,
-- 	foreign key (Aadhar_ID) REFERENCES People(Aadhar_ID) 
-- );

-- CREATE TABLE Court(
-- 	Court_No integer primary key AUTO_INCREMENT,
-- 	State varchar(50) not null,
-- 	District varchar(50) not null,
-- 	City varchar(50) not null 
-- );

-- CREATE TABLE Court_Case(
-- 	Case_No integer primary key AUTO_INCREMENT,
-- 	Reg_Date date not null,
-- 	Status varchar(100) not null,
-- 	Judge_ID integer not null,
-- 	Court_No integer not null,
-- 	foreign key (Court_No) REFERENCES Court(Court_No), 
-- 	foreign key (Judge_ID) REFERENCES Judge(Judge_ID)
-- );



CREATE TABLE Incharge(
	Police_ID integer not null,
	Police_Station_No integer not null,
	primary key(Police_ID,Police_Station_No),
	foreign key (Police_ID) REFERENCES Police_Officer(Police_ID),
	foreign key (Police_Station_No) REFERENCES Police_Station(Police_Station_No)
);

-- CREATE TABLE Leads_To(
-- 	FIR_No integer not null,
-- 	Case_No integer not null,
-- 	primary key(FIR_No,Case_No),
-- 	foreign key (FIR_No) REFERENCES FIR(FIR_No),
-- 	foreign key (Case_No) REFERENCES Court_Case(Case_No)
-- );

CREATE TABLE Victims(
	FIR_No integer not null,
	Aadhar_ID numeric(12,0) not null,
	Victim_detail varchar(1000) not null,
	primary key(FIR_No,Aadhar_ID),
	foreign key (FIR_No) REFERENCES FIR(FIR_No),
	foreign key (Aadhar_ID) REFERENCES People(Aadhar_ID)
);

CREATE TABLE Registration(
	Phone_Number numeric(10,0) not null,
	Aadhar_ID numeric(12,0) not null,
	Date_of_Reg date not null,
	primary key(Phone_Number,Aadhar_ID),
	foreign key (Phone_Number) REFERENCES User(Phone_Number),
	foreign key (Aadhar_ID) REFERENCES People(Aadhar_ID)
);

-- CREATE TABLE Accused_For(
-- 	FIR_No integer not null,
-- 	Fingerprint varbinary(3000) not null,
-- 	primary key(FIR_No, Fingerprint),
-- 	foreign key (FIR_No) REFERENCES FIR(FIR_No),
-- 	foreign key (Fingerprint) REFERENCES Criminal(Fingerprint)
-- );

-- CREATE TABLE Matches_description_of(
-- 	FIR_No integer not null,
-- 	Suspect_No integer not null,
-- 	Fingerprint varbinary(3000) not null,
-- 	primary key(FIR_No, Fingerprint, Suspect_No),
-- 	foreign key (FIR_No,Suspect_No) REFERENCES Suspect(FIR_No,Suspect_No),
-- 	foreign key (Fingerprint) REFERENCES Criminal(Fingerprint)
-- 	-- foreign key (Suspect_No) REFERENCES Suspect(Suspect_No)
-- );


