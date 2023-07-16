
<!DOCTYPE html>
<html>
<head>
    <title>Patient Portal</title>
    <link rel="stylesheet" href="../Static/nav.scss">
    <style>
    /* CSS for the navbar */
    .navbar {
      background-color: #333;
      color: #fff;
      padding: 10px;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: #000;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }
  </style>
</head>
<body>
<!--The Navigation Bar-->
<div>
  <nav class="navbar">
      <!-- LOGO -->
      <div class="logo">Me-Dawa</div>

      <!-- NAVIGATION MENU -->
      <ul class="nav-links">
          <div class="menu">
            <li>
              <?php
              session_start();
              $username = $_SESSION['username'];
              echo "Welcome, $username";
              ?>
            </li>
            <li><a href="#">Home</a></li>
            <li><a href="#">Sign Out</a></li>
          </div>
      </ul>
    </div>
  </div>
  </nav>

</div>

<div>
      <?php
        require_once '../database/database.php';

        // Create an instance of the database class
        $database = new Database();
        // $patientID = $_SESSION['username'];
        // $entity = $_SESSION['entity'];
        $results_per_page = 5; // Number of results per page
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page from URL
        $start_index = ($current_page - 1) * $results_per_page; // Calculate the starting index for results

        // Query to fetch users from the database based on the entity and pagination
        $users = $database->getUsersByEntityAndIDForPatient('patients', $patientID, $start_index, $results_per_page);

        // Display users in a table
        echo '
        <table style="width: 100%; border-collapse: collapse;">
        <!-- Table Heading -->
        <caption style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Prescription History</caption>
          <tr>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Prescription ID</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Doctor ID</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Prescription Date</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Prescription Valid Until</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Prescription Notes from Doctor</th>
          </tr>';
          foreach ($users as $user) {
              echo ' <tr>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $user['ID'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $user['doctorID'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $user['prescriptionDate'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $user['prescriptionDuration'] . '</td>
                        <td style="padding: 8px; text-align: center ; border-bottom: 1px solid #ddd; color: #333;">' . $user['prescriptionNotes'] . '</td>
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
  </tbody>
</table> 
</div>

</body>
</html>