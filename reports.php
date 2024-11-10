<?php include 'header.php'; ?>
<div class="container" style="display: flex; flex: 1; padding-top: 1rem;">
  <?php include 'leftpanel.php'; ?>

  <!-- Main Content Area -->
  <div class="main-content" style="flex: 1; padding: 1rem; background-color: #ffffff; margin-left: 1rem; border-radius: 4px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
    <h2>Open Book Transactions</h2>

    <?php  
    // Database connection
    $conn = new mysqli("localhost", "root", "", "lms");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch details from book_trans, books, and students tables
    $sql = "SELECT 
                s.first_name, 
                s.last_name, 
                s.grade,
                s.email, 
                b.book_name, 
                bt.checkout_ts, 
                bt.status,
                bt.student_id
            FROM 
                book_trans bt
            JOIN 
                book b ON bt.book_id = b.book_id
            JOIN 
                students s ON bt.student_id = s.student_id and s.grade
            WHERE 
                bt.status = 'Open'";

    $result = $conn->query($sql);

    // Check if any open transactions are found
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>
                <tr>
                    <th>  Student Id  </th>
                    <th>  Student First Name  </th>
                    <th>  Student Last Name  </th>
                    <th>  Grade  </th>
                    <th>  Email Address  </th>
                    <th>  Book Name  </th>
                    <th>  Checkout Date  </th>
                    <th>  Status  </th>
                </tr>";
        
        // Loop through and display each record
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td><center>" . htmlspecialchars($row['student_id']) . "</center></td>
                    <td><center>" . htmlspecialchars($row['first_name']) . "</center></td>
                    <td><center>" . htmlspecialchars($row['last_name']) . "</center></td>
                    <td><center>" . htmlspecialchars($row['grade']) . "</center></td>
                    <td><center>" . htmlspecialchars($row['email']) . "</center></td>
                    <td><center>" . htmlspecialchars($row['book_name']) . "</center></td>
                    <td><center>" . htmlspecialchars($row['checkout_ts']) . "</center></td>
                    <td><center>" . htmlspecialchars($row['status']) . "</center></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<center><b>No open transactions found.</b></center>";
    }

    // Close the database connection
    $conn->close();
    ?>
  </div>
</div>
<?php include 'footer.php'; ?>
