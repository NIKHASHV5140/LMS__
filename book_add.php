
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

  <body>
    <!-- Book Form Container -->

 <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection
            $conn = new mysqli("localhost", "root", "", "lms");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);      
            }    
            // Retrieve and sanitize form data
            $book_id = $conn->real_escape_string($_POST['book_id']);
            $book_title = $conn->real_escape_string($_POST['book_title']);
            $language = $conn->real_escape_string($_POST['language']);    
            $publication = $conn->real_escape_string($_POST['publication']);
            $book_type = $conn->real_escape_string($_POST['genre']);
            $price = $conn->real_escape_string($_POST['price']);    

            // SQL query to insert student data
            $sql = "INSERT INTO book (book_id, book_name, price, genre, publication, language) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $book_id, $book_title, $price, $book_type, $publication, $language);

            if ($stmt->execute()) {
                echo "<center><b>Book information added successfully<b></center>";
            } else {
                echo "<center><b>Error adding Book information :" . $stmt->error."<b></center>";
            }
            $stmt->close();
            $conn->close();
}
?>
    <div class="book-form">
    <h2>Book Form</h2>
    <form action="book_add.php" method="POST">
        <label for="book_id">Book Id</label>
        <input type="text" id="book_id" name="book_id" placeholder="Enter your Book Id" required>

        <label for="book_title">Book Title</label>
        <input type="text" id="book_title" name="book_title" placeholder="Enter Book Title" required>

        <label for="language">Language</label>        
        <select id="language" name="language">
            <option value="" disabled selected>Select a Language</option>
            <option value="tamil">Tamil</option>
            <option value="telugu">Telugu</option>
            <option value="hindi">Hindi</option>
            <option value="others">Others</option>            
        </select>

        <label for="genre">Genre </label>
        <input type="text" id="genre" name="genre" placeholder="Enter Genre" required>

        <label for="publication">Publication</label>
        <input type="text" id="publication" name="publication" placeholder="Enter Publication">        

        <label for="Price">Price</label>
        <input type="text" id="price" name="price" placeholder="Enter Price">        

        <button type="submit">Submit</button>
    </form>
    </div>
</body>
 
  </div>
</div>
<?php include 'footer.php'; ?>
