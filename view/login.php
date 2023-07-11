<?php

require_once("database.php");

$database = new Database();

if (isset($_POST['login'])) {
    $SSN = $_POST['SSN'];
    $password = $_POST['password'];
    $entity = $_POST['entity'];

    if ($entity === 'patient') {
        if ($database->patientLogin($SSN, $password)) {
            // Redirect to patient page
            header('Location: patient.php');
            exit();
        } else {
            $error = "Invalid SSN or password.";
        }
    }

    if ($entity === 'doctor') {
        if ($database->doctorLogin($SSN, $password)) {
            // Redirect to doctor page
            header('Location: doctor.php');
            exit();
        } else {
            $error = "Invalid SSN or password.";
        }
    }

    if ($entity === 'pharmaceuticalcompany') {
        if ($database->pharmaceuticalcompanyLogin($SSN, $password)) {
            // Redirect to patient page
            header('Location: pharmaceuticalcompany.php');
            exit();
        } else {
            $error = "Invalid SSN or password.";
        }
    }

    if ($entity === 'pharmacy') {
        if ($database->pharmacyLogin($SSN, $password)) {
            // Redirect to patient page
            header('Location: pharmacy.php');
            exit();
        } else {
            $error = "Invalid SSN or password.";
        }
    }

    if ($entity === 'staff') {
        if ($database->staffLogin($SSN, $password)) {
            // Redirect to patient page
            header('Location: staff.php');
            exit();
        } else {
            $error = "Invalid SSN or password.";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styled.css">
</head>
<body>
    <h1>Login</h1>
    <p>Enter your username and password, and select the table, to log in</p>
    <br>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label>SSN:</label>
        <input type="text" name="SSN" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Entity:</label>
        <select name="entity" required>
            <option value="patient">Patient</option>
            <option value="doctor">Doctor</option>
            <option value="pharmaceuticalcompany">Pharmaceutical Company</option>
            <option value="pharmacy">Pharmacy</option>
            <option value="staff">Staff</option>
        </select><br>
        <br>
        <input type="submit" name="login">
    </form>
</body>
</html>