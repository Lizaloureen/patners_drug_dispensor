<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheets  " href="Static\doctor.scss"> -->
    <link rel="stylesheet" href="../Static/doctor.scss">
    <link rel="stylesheet" href="../Static/nav.scss">
    <title>Document</title>
</head>
<body>


  <!-- the navigation bar -->
<div>
  <nav class="navbar">
      <!-- LOGO -->
      <div class="logo">Doctor Portal</div>

      <!-- NAVIGATION MENU -->
      <ul class="nav-links">
          <div class="menu">
            <li>
              <?php 
              // session_start();
              // $username = $_SESSION['username'];
              // echo "Welcome, $username";
              ?>
              </li>
              <li><a href="#">Home</a></li>
              <li><a href="#">Sign Out</a></li>
          </div>
      </ul>
  </nav>
</div>

<!-- view prescription history here -->

<?php
        require_once '../database/database.php';

        // Create an instance of the database class
        $database = new Database();
        $doctorID = $_SESSION['username'];
        $entity = $_SESSION['entity'];
        $results_per_page = 5; // Number of results per page
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page from URL
        $start_index = ($current_page - 1) * $results_per_page; // Calculate the starting index for results

        // Query to fetch users from the database based on the entity and pagination
        $users = $database->getUsersByEntityAndIDForDoctor($entity, $doctorSSN, $start_index, $results_per_page);

        // Display users in a table
        echo '
        <table style="width: 100%; border-collapse: collapse;">
        <!-- Table Heading -->
        <caption style="padding:8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Prescription History</caption>
          <tr>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Prescription ID</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Patient ID</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Prescription Date</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Prescription Valid Until</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Prescription Notes from Doctor</th>
          </tr>';
          foreach ($users as $user) {
              echo ' <tr>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $user['ID'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $user['patientID'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $user['prescriptionDate'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $user['prescriptionDuration'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $user['prescriptionNotes'] . '</td>
                        <!-- Additional columns here -->
                      </tr>';
          }
  
        echo '</table>';

        $total_results = $database->getTotalUsersByEntity($entity); // Get total number of users for the entity
        $total_pages = ceil($total_results / $results_per_page); // Calculate total number of pages

        echo '<div style="margin-top: 20px;">';

        if($current_page > 1) {
          echo '<a href="patient.php?entity=' . $entity . '&page=' . ($current_page - 1) . '" style="display: inline-block; padding: 8px 16px; text-decoration: none; color: #333; border: 1px solid #ddd; margin-right: 5px;">Previous</a>';
        }

        for ($i = 1; $i <= $total_pages; $i++) {
          echo '<a href="patient.php?entity=' . $entity . '&page=' . $i . '" style="display: inline-block; padding: 8px 16px; text-decoration: none; color: #333; border: 1px solid #ddd; margin-right: 5px;">' . $i . '</a>';
        }

        if ($current_page < $total_pages) {
          echo '<a href="patient.php?entity=' . $entity . '&page=' . ($current_page + 1) . '" style="display: inline-block; padding: 8px 16px; text-decoration: none; color: #333; border: 1px solid #ddd; margin-right: 5px;">Next</a>';
        }

        echo '</div>';
        
        ?>

<!-- Add prescription in this form -->
<div class="login-box">
  <h2>Add Prescription</h2>
  <form>
    <div class="user-box">
      <input type="number" name="patientSSN" required>
      <label>Patient SSN</label>
    </div>

    <div class="input">
				  <select name="  drugID" id="drugID" class="input-field" value="">
            <option value="" class="input" disabled selected>Drug Name</option>
            <?php
              include_once '../database/database.php';
              $database = new database();
              $items = $database->getAllDrugs();
              foreach ($items as $item):
            ?>
            <option class="input" value="<?php $item['ID'] ?>" <?php echo $item['drugName'] ?> "><?php echo $item['drugName'] ?></option> 
            <label class="input-label">Drug Name</label>
            <?php endforeach; ?>
          </select>
			  </div>

    <div class="user-box">
      <input type="text" name="prescriptionDescription" required="">
      <label>Prescription Description</label>
    </div>
    <div class="user-box">
      <input type="text" name="prescriptionDescription" required="">
      <label>Prescription Notes</label>
    </div>
    <a href="../config/doctor.php">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Add Prescription
    </a>
  </form>
</div>
</body>
</html>