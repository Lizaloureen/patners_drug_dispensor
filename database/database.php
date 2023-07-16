<?php
class Database {
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $connection;

    public function __construct(){
        $this->hostname = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "my-medicine";

        try{
            $this->connection = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Patient signup
    public function patientSignup($patientssn, $patientName, $patientPhoneNumber, $Ppassword, $patientAddress, $patientGender){
        try {
            $stmt = $this->connection->prepare("INSERT INTO patient (patientssn, Name, phoneNumber, password, address, Gender) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$patientssn, $patientName, $patientPhoneNumber, $Ppassword, $patientAddress, $patientGender]);
            return true; // Return true if the signup was successful
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }        
    }

    // Doctor signup
    public function doctorSignup($docSSN, $doctorName, $doctorPhoneNumber, $Dpassword, $doctorAddress, $doctorGender){
        try {
            $stmt = $this->connection->prepare("INSERT INTO doctor (docssn, Name, phoneNumber, password, address, Gender) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$docSSN, $doctorName, $doctorPhoneNumber, $Dpassword, $doctorAddress, $doctorGender]);
            return true; // Return true if the signup was successful
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }        
    }

    // Pharmaceutical Company signup
    public function PharmaceuticalCompanySignup($pcSSN, $pcName, $address, $PhoneNo, $pharmaceuticalPassword){
        try {
            $stmt = $this->connection->prepare("INSERT INTO pharmaceuticalcompany(pcSSN, pcName, address, PhoneNo, Password) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$pcSSN, $pcName, $address, $PhoneNo, $pharmaceuticalPassword]);
            return true; // Return true if the signup was successful
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }        
    }

    // Pharmacy signup
    public function PharmacySignup($pharmacyName, $phSSN, $phoneNo, $profitPercentage, $drugTradeName, $address, $pharmacyPassword){
        try {
            $stmt = $this->connection->prepare("INSERT INTO pharmacy (Name, phSSN, phoneNo, profitPercentage, drugTradeName, address, Password) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$pharmacyName, $phSSN, $phoneNo, $profitPercentage, $drugTradeName, $address, $pharmacyPassword]);
            return true; // Return true if the signup was successful
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }        
    }

    // Staff signup
    public function StaffSignup($staffno, $name, $prescriptionno, $salary, $bonus, $staffPassword){
        try {
            $stmt = $this->connection->prepare("INSERT INTO staff (staffno, name, prescriptionno, salary, bonus, Password) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$staffno, $name, $prescriptionno, $salary, $bonus, $staffPassword]);
            return true; // Return true if the signup was successful
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }        
    }

    //Login using SSN and password for patients
    public function patientLogin($ID, $password)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM patient WHERE patientssn = ?");
            $stmt->execute([$SSN]);
            $result = $stmt->fetch();

            // Verify if a patient was found with the provided SSN
            if ($result) {
                // Verify the password using password_verify() function
                if (password_verify($password, $result['password'])) {
                    return true; // Return true if login is successful
                }
            }

            return false; // Return false if login failed
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }        
    }

    // Login using SSN and password for doctors
    public function doctorLogin($SSN, $password)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM doctor WHERE docssn = ?");
            $stmt->execute([$SSN]);
            $result = $stmt->fetch();

            // Verify if a doctor was found with the provided SSN
            if ($result) {
                // Verify the password using password_verify() function
                if (password_verify($password, $result['password'])) {
                    return true; // Return true if login is successful
                }
            }

            return false; // Return false if login failed
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }        
    }

    //Login using SSN and password for pharmaceutical companies
    public function pharmaceuticalcompanyLogin($SSN, $password)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM pharmaceuticalcompany WHERE pcSSN = ?");
            $stmt->execute([$SSN]);
            $result = $stmt->fetch();

            // Verify if a pharmaceutical company was found with the provided SSN
            if ($result) {
                // Verify the password using password_verify() function
                if (password_verify($password, $result['password'])) {
                    return true; // Return true if login is successful
                }
            }

            return false; // Return false if login failed
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }        
    }

    //Login using SSN and password for pharmacies
    public function pharmacyLogin($SSN, $password)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM pharmacy WHERE phSSN = ?");
            $stmt->execute([$SSN]);
            $result = $stmt->fetch();

            // Verify if a pharmacy was found with the provided SSN
            if ($result) {
                // Verify the password using password_verify() function
                if (password_verify($password, $result['password'])) {
                    return true; // Return true if login is successful
                }
            }

            return false; // Return false if login failed
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }        
    }

    //Login using SSN and password for staff
    public function staffLogin($staffno, $password)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM staff WHERE staffno = ?");
            $stmt->execute([$staffno]);
            $result = $stmt->fetch();

            // Verify if a staff member was found with the provided SSN
            if ($result) {
                // Verify the password using password_verify() function
                if (password_verify($password, $result['password'])) {
                    return true; // Return true if login is successful
                }
            }

            return false; // Return false if login failed
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }        
    }




    /*
    *   These are the added functions for the project
    */

    // get total number of enities in a table
    function getTotalUsersByEntity($entity){
        try {
            $stmt = $this->connection->prepare("SELECT COUNT(*) FROM $entity");
            $stmt->execute();
            $result = $stmt->fetch();
            return $result[0];
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }        
    }

    // get all drugs
    function getAllDrugs($start_index, $results_per_page){
        try {
            $stmt = $this->connection->prepare("SELECT * FROM drugs LIMIT $start_index, $results_per_page");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }        
    }

    // Dispense drug
    function dispense($ID){
        $stmt = $this->connection->prepare("DELETE FROM drugs where ID = :ID");
        $stmt->bindParam(':ID', $ID);

        // Execute statement
        $stmt->execute();

        // If it works return true
        if($stmt){
            return true;
        } else {
            return false;
        }
    }

    function getPatientBySSN($SSN){
        $stmt = $this->connection->prepare("SELECT * FROM patients WHERE SSN = :SSN");
        $stmt->bindParam(':SSN', $SSN);
    
        // Execute statement
        $stmt->execute();
    
        // Fetch data
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function addPrescription($patientID, $doctorSSN, $prescriptionDate, $prescriptionDuration, $prescriptionNotes){
        //Prepare statement
        $stmt = $this->connection->prepare("INSERT INTO prescriptions (patientID, doctorID, prescriptionDate, prescriptionDuration, prescriptionNotes) VALUES (:patientID, :doctorID, :prescriptionDate, :prescriptionDuration, :prescriptionNotes)");
        $stmt->bindParam(':patientID', $patientID);
        $stmt->bindParam(':doctorID', $doctorID);
        $stmt->bindParam(':prescriptionDate', $prescriptionDate);
        $stmt->bindParam(':prescriptionDuration', $prescriptionDuration);
        $stmt->bindParam(':prescriptionNotes', $prescriptionNotes);

        //Execute statement
        $stmt->execute();

        // If it works return true
        if($stmt){
            return true;
        } else {
            return false;
        }
    }

    function getUsersByEntityAndIDForDoctor($entity, $doctorSSN, $start_index, $results_per_page){
        // Prepare statement
        $stmt = $this->connection->prepare("SELECT * FROM prescriptions WHERE doctorSSN = :doctorSSN LIMIT :start_index, :results_per_page");
        $stmt->bindParam(':doctorSSN', $doctorSSN);
        $stmt->bindParam(':start_index', $start_index, PDO::PARAM_INT);
        $stmt->bindParam(':results_per_page', $results_per_page, PDO::PARAM_INT);
    
        // Execute statement
        $stmt->execute();
    
        // Fetch data
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getUsersByEntityAndIDForPatient($entity, $SSN, $start_index, $results_per_page){
        // Prepare statement
        $stmt = $this->connection->prepare("SELECT * FROM prescriptions WHERE patientID = :ID LIMIT :start_index, :results_per_page");
        $stmt->bindParam(':ID', $ID);
        $stmt->bindParam(':start_index', $start_index, PDO::PARAM_INT);
        $stmt->bindParam(':results_per_page', $results_per_page, PDO::PARAM_INT);
    
        // Execute statement
        $stmt->execute();
    
        // Fetch data
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
?>