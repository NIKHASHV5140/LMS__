
<!-- index.php -->
<?php include 'header.php'; ?>
<div class="container" style="display: flex; flex: 1; padding-top: 1rem;">
  <?php include 'leftpanel.php'; ?>

  <!-- Main Content Area -->
  <div class="main-content" style="flex: 1; padding: 1rem; background-color: #ffffff; margin-left: 1rem; border-radius: 4px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
  <style>
        .student-form {
        background-color: #BBBBCC;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: auto;
        }

        .student-form h2 {
        text-align: center;
        color: #333;
        margin-bottom: 1rem;
        }

        .student-form label {
        display: block;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #555;
        }

        .student-form input[type="text"],        
        .student-form input[type="number"] {
        width: 100%;
        padding: 0.8rem;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
        }

        .student-form select,option {
        width: 100%;
        padding: 0.8rem;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
        }

        .student-form button {
        width: 100%;
        padding: 0.8rem;
        background-color: #345334;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        }

        .student-form button:hover {
        background-color: #45a049;
        }
   </style>
  <body>

  <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Database connection
        $conn = new mysqli("localhost", "root", "", "lms");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve and sanitize form data
        $student_id = $conn->real_escape_string($_POST['student_id']);
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $middle_name = $conn->real_escape_string($_POST['middle_name']);
        $last_name = $conn->real_escape_string($_POST['last_name']);
        $email = $conn->real_escape_string($_POST['email']);
        $dob = $conn->real_escape_string($_POST['dob']);
        $address = $conn->real_escape_string($_POST['address']);
        $city = $conn->real_escape_string($_POST['city']);
        $state = $conn->real_escape_string($_POST['state']);
        $zipcode = $conn->real_escape_string($_POST['zipcode']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $grade = $conn->real_escape_string($_POST['grade']);

        // SQL query to insert student data
        $sql = "INSERT INTO students (student_id, first_name, middle_name, last_name, email, dob, address,city, state, zip_code, phone, grade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssss", $student_id, $first_name,$middle_name, $last_name, $email,$dob, $address, $city, $state, $zipcode, $phone, $grade);

        if ($stmt->execute()) {
            echo "<center><b>Student information added successfully<b></center>";
        } else {
            echo "<center><b>Error adding student information :" . $stmt->error."<b></center>";
        }
        $stmt->close();
        $conn->close();
    }
?>

    <!-- Student Form Container -->
    <div class="student-form">
    <h2>Student Form</h2>
    <form action="student_add.php" method="POST">
        <label for="student_id">Student Id</label>
        <input type="text" id="student_id" name="student_id" placeholder="Enter your Student Id" required>

        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" placeholder="Enter your First Name" required>

        <label for="middle_name">Middle Name</label>
        <input type="text" id="middle_name" name="middle_name" placeholder="Enter your Middle Name">

        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" placeholder="Enter your Last Name" required>
        
        <label for="dob">Date of Brith</label>
        <input type="text" id="dob" name="dob" placeholder="Enter your DOB" required>      

        <label for="grade">Level</label>        
        <select id="grade" name="grade">
            <option value="" disabled selected>Select a Grade </option>
            <option value="0">Level 0</option>
            <option value="1">Level 1</option>
            <option value="2">Level 2</option>
            <option value="3">Level 3</option>
            <option value="4">Level 4</option>
            <option value="5">Level 5</option>
            <option value="6">Level 6</option>
            <option value="7">Level 7</option>
            <option value="8">Level 8</option>
            <option value="9">Level 9</option>            
            <option value="10">Level 10</option>           
        </select>        

        <label for="address">Address</label>
        <input type="text" id="address" name="address" placeholder="Enter your Address" required>

        <label for="city">city</label>
        <input type="text" id="city" name="city" placeholder="Enter your City" required>

        <label for="state">state</label>
        <input type="text" id="state" name="state" placeholder="Enter your State" required>

        <label for="ZipCode">state</label>
        <input type="text" id="zipcode" name="zipcode" placeholder="Enter your ZipCode">

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" placeholder="Enter your Phone" required>

        <label for="email">Email Id</label>
        <input type="text" id="email" name="email" placeholder="Enter your Email" required>

        <button type="submit">Submit</button>
    </form>
    </div>
</body>
 
  </div>
</div>
<?php include 'footer.php'; ?>

