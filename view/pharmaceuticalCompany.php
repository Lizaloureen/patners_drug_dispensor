<!DOCTYPE html>
<html>
<head>
    <title>Pharmaceutical Company Portal</title>
    <link rel="stylesheet" href="../Static/form.scss">
    <link rel="stylesheet" href="../Static/homepage.css">
</head>
<body>

<body>
<!--The Navigation Bar-->
<div>
<nav class="navbar">
    <!-- LOGO -->
    <div class="logo">Add Drugs</div>
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
            <li><a href="../view/homepage.php">Home</a></li>
            <li><a href="../config/signout.php">Sign Out</a></li>
        </div>
    </ul>
</nav>
</div>

<!--A form for the company to add drugs-->
<div>
	<!-- code here -->
	<div class="card">
		<form class="card-form" method="post" action="../config/pharmaceuticalCompany.php">
			<div class="input">
				<input type="text" class="input-field" name="drugName"  required/>
				<label class="input-label">Drug Name</label>
			</div>
      <div class="input">
        <input type="text" class="input-field" name="drugDescription" required/>
        <label class="input-label">Drug Description</label>
      </div>
      <div class="input">
        <input type="number" step="0.01" min="0" class="input-field" name="drugPrice" required/>
        <label class="input-label">Drug Price</label>
      </div>
      <div class="input">
        <input type="number" class="input-field" name="drugQuantity" required/>
        <label class="input-label">Drug Quantity</label>
      </div>
      <div class="input">
        <input type="date" class="input-field" name="drugExpirationDate" required/>
        <label class="input-label">Drug Exp Date</label>
      </div>
      <div class="input">
        <input type="date" class="input-field" name="drugManufacturingDate" required/>
        <label class="input-label">Drug Manufacturing Date</label>
      </div>
      <div class="input">
        <input type="text" class="input-field" name="drugCompany" required/>
        <label class="input-label">Drug Company</label>
      </div>
      <div class="action">
        <input type="submit" class="action-button" value="Add drug" />
      </div>
    </form>
	</div>
</div>

</body>
</html>