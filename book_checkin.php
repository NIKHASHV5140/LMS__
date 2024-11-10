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
      <!-- Student Form Container -->
      <div class="book-form">
        <h2>Book CheckIn</h2>
        <form method="POST">
          <label for="student_id">Student Id</label>
          <input type="text" id="student_id" name="student_id" placeholder="Enter your Student Id" required>             
          <button type="submit" value="submit" name="load_student">Load</button>
        </form>
      </div>

      <!-- Display Books Checked Out -->
      <?php
      // Database connection
      $conn = new mysqli("localhost", "root", "", "lms");

      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // Check if student_id is submitted
      if (isset($_POST['load_student']) && !empty($_POST['student_id'])) {
          $student_id = $_POST['student_id'];
          $books_query = "SELECT b.book_id, b.book_name, c.checkout_ts FROM book b JOIN book_trans c ON b.book_id = c.book_id WHERE c.student_id = ? AND c.status != 'closed'";
          $stmt = $conn->prepare($books_query);
          $stmt->bind_param("i", $student_id);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
            echo "<h3>Books Checked Out</h3>";
            echo "<table border='1' cellpadding='5' cellspacing='0'>
                    <tr>
                        <th>Book Name</th>
                        <th>Checkout Date</th>
                        <th>Action</th>
                    </tr>";
            
            while ($book = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($book['book_name']) . "</td>
                        <td>" . htmlspecialchars($book['checkout_ts']) . "</td>
                        <td>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='book_id' value='" . htmlspecialchars($book['book_id']) . "'>
                                <button type='submit' name='checkin'>CheckIn</button>
                            </form>
                        </td>
                      </tr>";
            }
            
            echo "</table>";
            
              }
              
           else {
              echo "<p>No books checked out.</p>";
          }
          echo "</ul>";
        }
      

      // Handle book check-in and update timestamp
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkin'])) {
          $book_id = $_POST['book_id'];
          $query = "UPDATE book_trans SET checkin_ts = CURRENT_TIMESTAMP, status = 'closed' WHERE book_id = ?";

          if ($stmt = $conn->prepare($query)) {
              $stmt->bind_param("i", $book_id);
              if ($stmt->execute()) {
                  echo "<p>Book has been checked in successfully!</p>";
              } else {
                  echo "<p>Error checking in the book.</p>";
              }
              $stmt->close();
          } else {
              echo "<p>Error preparing the statement.</p>";
          }
      }

      $conn->close();
      ?>
    </body>
  </div>
</div>

<?php include 'footer.php'; ?>
