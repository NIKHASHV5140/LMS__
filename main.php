<?php include 'header.php'; ?>
<div class="container" style="display: flex; flex: 1; padding-top: 1rem;">
  <?php include 'leftpanel.php'; ?>

  <!-- Main Content Area -->
  <div class="main-content" style="flex: 1; padding: 2rem; background-color: #f4f6fc; margin-left: 1rem; border-radius: 8px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);">
    
    <!-- Welcome Section -->
    <div style="text-align: center; margin-bottom: 2rem;">
      <h2 style="font-family: 'Arial', sans-serif; font-size: 2rem; color: #3a3a3a;">Welcome to Bala Datta Library!!</h2>
      <p style="font-family: 'Verdana', sans-serif; font-size: 1rem; color: #555; line-height: 1.6;">We’re excited to have you here as we embark on this journey of learning and growth. Explore and manage your library seamlessly.</p>
    </div>

    <!-- Action Buttons -->
    <div style="display: flex; justify-content: center; gap: 2rem;">
      <a href="book_checkout.php" style="text-decoration: none; width: 180px;">
        <button style="width: 100%; padding: 15px; font-size: 1.2rem; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease-in-out;">
          <strong>Checkout</strong>
        </button>
      </a>
      <a href="book_checkin.php" style="text-decoration: none; width: 180px;">
        <button style="width: 100%; padding: 15px; font-size: 1.2rem; background-color: #008CBA; color: white; border: none; border-radius: 5px; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease-in-out;">
          <strong>Checkin</strong>
        </button>
      </a>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
