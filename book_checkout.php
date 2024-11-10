
<!-- index.php -->
<?php include 'header.php'; ?>
<div class="container" style="display: flex; flex: 1; padding-top: 1rem;">
  <?php include 'leftpanel.php'; ?>

  <!-- Main Content Area -->
  <div class="main-content" style="flex: 1; padding: 1rem; background-color: #ffffff; margin-left: 1rem; border-radius: 4px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
  <style>
        .book-form {
        background-color: #BBBBCC;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: auto;
        }

        .book-form h2 {
        text-align: center;
        color: #333;
        margin-bottom: 1rem;
        }

        .book-form label {
        display: block;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #555;
        }

        .book-form input[type="text"],        
        .book-form input[type="number"] {
        width: 100%;
        padding: 0.8rem;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
        }

        .book-form select,option {
        width: 100%;
        padding: 0.8rem;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
        }

        .book-form button {
        width: 100%;
        padding: 0.8rem;
        background-color: #345334;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        }

        .book-form button:hover {
        background-color: #45a049;
        }
   </style>

<script>
    // JavaScript function to handle Tab key press
    function checkout(name){      
      document.getElementById("studentForm").submit_hidden.value="submit";
      document.getElementById("studentForm").submit();
    }

    function handleTabKey(event,name) {
      // Check if the pressed key is "Tab"           
      if (event.key === "Tab") {
        if (name == 'student' ){
            event.preventDefault(); // Prevent default Tab behavior (optional)
            // Perform the desired action, e.g., submit the form or alert
            
            // You can also submit the form here if needed
            document.getElementById("studentForm").submit();
        }   
        
        if (name == 'book' ){
            event.preventDefault(); // Prevent default Tab behavior (optional)
            // Perform the desired action, e.g., submit the form or alert            
            // You can also submit the form here if needed
            document.getElementById("studentForm").submit();
        }    

      }
    }
  </script>
  <body>

<?php
  if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST['submit_hidden']!=null)) {

           //Database connection
           $conn = new mysqli("localhost", "root", "", "lms");

           // Check connection
           if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
           }
   
           // Retrieve and sanitize form data
           $student_id = $conn->real_escape_string($_POST['student_id']);
           $book_id = $conn->real_escape_string($_POST['book_id']);
           $status = "Open";


           // Fetch data
          $sql = "SELECT * FROM book_trans WHERE status='Open' and book_id = ? ";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s", $book_id); // Bind the $student_id as an integer parameter
          $stmt->execute();
          $result = $stmt->get_result();
        
        // Check if a record was found
          if ($result->num_rows > 0) {
            echo "<center><b>Book not available :</b>".$book_id."</center>";            
          } else {
            // SQL query to insert student data
            $sql = "INSERT INTO book_trans (student_id, book_id, status) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $student_id, $book_id, $status);
    
            if ($stmt->execute()) {
                echo "<center><b>Book has been checked out Successfully!!<b></center>";
            } else {
                echo "<center><b>Error while checkout :" . $stmt->error."<b></center>";
            }
          }
          $stmt->close();
          $conn->close();
          
  }
?>    

  <?php  
    $student_id = "";
    $first_name = "";
    $middle_name = "";
    $last_name = "";
    $grade = "";

    // Check if the form is submitted    
    if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST['student_id']!=null)) {      

        //Database connection
        $conn = new mysqli("localhost", "root", "", "lms");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve and sanitize form data
        $student_id = $conn->real_escape_string($_POST['student_id']);
        
        // Fetch data
        $sql = "SELECT * FROM students WHERE student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $student_id); // Bind the $student_id as an integer parameter
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if a record was found
        if ($result->num_rows > 0) {          
            // Fetch associative array
            $student = $result->fetch_assoc();
            $student_id= $student['student_id'];
            $first_name= $student['first_name'];            
            $middle_name= $student['middle_name'];            
            $last_name= $student['last_name'];            
            $grade= $student['grade'];            

        } else {
            echo "<center><b>No student found with ID </b>".$student_id."</center>";            
        }

        $stmt->close();
        $conn->close();
    }
?>

<?php  
    $book_id = "";
    $book_name = "";
    $language = "";
    $genre = "";    

    // Check if the form is submitted
    if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST['book_id']!=null)) {

        //Database connection
        $conn = new mysqli("localhost", "root", "", "lms");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve and sanitize form data
        $book_id = $conn->real_escape_string($_POST['book_id']);
            
        // Fetch data
        $sql = "SELECT * FROM book WHERE book_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $book_id); // Bind the $book_id as an integer parameter
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if a record was found
        if ($result->num_rows > 0) {          
            // Fetch associative array
            $book = $result->fetch_assoc();
            $book_id= $book['book_id'];
            $book_name= $book['book_name'];            
            $language= $book['language'];            
            $genre= $book['genre'];                        

        } else {
            echo "<center><b>No Book found with ID </b>".$book_id."</center>";            
        }

        $stmt->close();
        $conn->close();
    }
?>


    <!-- Student Form Container -->
    <div class="book-form">
    <h2>Book CheckOut</h2>
    <form id="studentForm" action="book_checkout.php" method="POST" >
        <label for="student_id">Student Id</label>
        <input type="text" id="student_id" name="student_id" placeholder="Enter your Student Id" value="<?=$student_id?>" onkeydown="handleTabKey(event,'student')">
        <label for="upperline">-------------------------------------------------------------------</label>
        <?php
        echo "First Name:".$first_name."<br>";
        echo "Middle Name:".$middle_name."<br>";
        echo "Last Name:".$last_name."<br>";
        echo "Grade:".$grade."<br>";
        ?>        
        <label for="lowerline">-------------------------------------------------------------------<br></label>      
        

        <label for="book_id">Book Id</label>
        <input type="text" id="book_id" name="book_id" placeholder="Enter Book Id" value="<?=$book_id?>" onkeydown="handleTabKey(event,'book')" >    

        <label for="upperline">-------------------------------------------------------------------</label>
        <?php
        echo "Book Title:".$book_name."<br>";
        echo "Language:".$language."<br>";
        echo "Genre:".$genre."<br>";        
        ?>               
        <label for="lowerline">-------------------------------------------------------------------<br></label>              
        <input type="hidden" id="submit_hidden" name="submit_hidden"> 
        <button type="button" value="submit" onclick="javascript:checkout('submit')" >CheckOut</button>        
    </form>
    </div>
</body>
 
  </div>
</div>
<?php include 'footer.php'; ?>

