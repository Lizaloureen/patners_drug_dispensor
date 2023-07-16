<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Static/nav.scss">
    <title>Pharmacy Portal</title>
</head>
<body>
      <!-- the navigation bar -->
<div>
  <nav class="navbar">
      <!-- LOGO -->
      <div class="logo">Pharmacy Portal</div>

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
              <li><a href="../Templates/homepage.html">Home</a></li>
              <li><a href="../config/signout.php">Sign Out</a></li>
          </div>
      </ul>
  </nav>
</div>
    <?php
        require_once '../database/database.php';

        // Create an instance of the database class
        $database = new Database();
        // $patientID = $_SESSION['username'];
        $results_per_page = 5; // Number of results per page
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page from URL
        $start_index = ($current_page - 1) * $results_per_page; // Calculate the starting index for results

        // Get users from the database
        $drugs = $database->getAllDrugs($start_index, $results_per_page);

        // Display users in a table
        echo '
        <table style="width: 100%; border-collapse: collapse;">
        <!-- Table Heading -->
        <caption style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Approved Drugs Ready for Dispensation</caption>
          <tr>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Drug ID</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Drug Name</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Drug Description</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Drug Price</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Drug Quantity</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Drug Expiry Date</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Drug Manufacturing Date</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Drug Company</th>
              <th style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">Action</th>
          </tr>';
          foreach ($drugs as $drug) {
              echo ' <tr>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $drug['ID'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $drug['drugName'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $drug['drugDescription'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $drug['drugPrice'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $drug['drugQuantity'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $drug['drugExpirationDate'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $drug['drugManufacturingDate'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">' . $drug['drugCompany'] . '</td>
                        <td style="padding: 8px; text-align: center; border-bottom: 1px solid #ddd; color: #333;">
                            <form method="POST" action="../config/pharmacy.php">
                              <input type="hidden" name="drugID" value="' . $drug['ID'] . '">
                              <input type="submit" name="dispense" value="dispense" style="background-color: red; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">
                            </form>
                        </td>
                      </tr>';
          }
  
        echo '</table>';

        // $total_results = $database->getTotalUsersByEntity($entity); // Get total number of users for the entity
        // $total_pages = ceil($total_results / $results_per_page); // Calculate total number of pages

        // echo '<div style="margin-top: 20px;">';

        // if ($current_page > 1) {
        //   echo '<a href="../view/pharmacy.php?entity=' . $entity . '&page=' . ($current_page - 1) . '" style="display: inline-block; padding: 8px 16px; text-decoration: none; color: #333; border: 1px solid #ddd; margin-right: 5px;">Previous</a>';
        // }

        // for ($i = 1; $i <= $total_pages; $i++) {
        //   echo '<a href="../view/pharmacy.php?entity=' . $entity . '&page=' . $i . '" style="display: inline-block; padding: 8px 16px; text-decoration: none; color: #333; border: 1px solid #ddd; margin-right: 5px;">' . $i . '</a>';
        // }

        // if ($current_page < $total_pages) {
        //   echo '<a href="../view/pharmacy.php?entity=' . $entity . '&page=' . ($current_page + 1) . '" style="display: inline-block; padding: 8px 16px; text-decoration: none; color: #333; border: 1px solid #ddd; margin-right: 5px;">Next</a>';
        // }

        echo '</div>';

        
        ?>
    
    
</body>
</html>