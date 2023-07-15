CREATE TABLE patients (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  patientFirstName VARCHAR(50),
  patientSecondName VARCHAR(50),
  patientEmail VARCHAR(100),
  patientPassword VARCHAR(100),
  patientPhoneNumber VARCHAR(20),
  patientAddress VARCHAR(200),
  patientGender VARCHAR(10),
  patientDOB DATE
);



CREATE TABLE doctors (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  doctorFirstName VARCHAR(50),
  doctorSecondName VARCHAR(50),
  doctorEmail VARCHAR(100),
  doctorPassword VARCHAR(100),
  doctorPhoneNumber VARCHAR(20),
  doctorAddress VARCHAR(200),
  doctorGender VARCHAR(10),
  doctorDOB DATE
);



CREATE TABLE pharmacies (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  pharmacyName VARCHAR(100),
  pharmacyEmail VARCHAR(100),
  pharmacyPassword VARCHAR(100),
  pharmacyPhoneNumber VARCHAR(20),
  pharmacyAddress VARCHAR(200)
);


CREATE TABLE prescriptions (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  patientID INT,
  doctorID INT,
  prescriptionDate DATE,
  prescriptionDuration INT,
  prescriptionNotes VARCHAR(200),
  FOREIGN KEY (patientID) REFERENCES patients(ID),
  FOREIGN KEY (doctorID) REFERENCES doctors(ID)
);


CREATE TABLE companies (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  companyName VARCHAR(100),
  companyEmail VARCHAR(100),
  companyPassword VARCHAR(100),
  companyPhoneNumber VARCHAR(20),
  companyAddress VARCHAR(200)
);

CREATE TABLE 