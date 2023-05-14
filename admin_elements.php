<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_price'])){
	$date = date('Y-m-d');
	$gold= $_POST['gold'];
	$silver = $_POST['silver'];
	// $date = $_POST['date'];

	// Check if there is already a record for the given date
	$sql = "SELECT * FROM element_price WHERE date = '$date'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// If a record already exists, update it
		$sql = "UPDATE element_price SET gold_price='$gold', silver_price='$silver' WHERE date='$date'";
		if ($conn->query($sql) === TRUE) {
			echo "Price updated successfully.";
		} else {
			echo "Error updating price: " . $conn->error;
		}
	} else {
		// If no record exists, insert a new one
		$sql = "INSERT INTO element_price (gold_price, silver_price, date) VALUES('$gold', '$silver','$date')";
		if ($conn->query($sql) === TRUE) {
			echo "Price added successfully.";
		} else {
			echo "Error adding price: " . $conn->error;
		}
	}
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `element_price` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_elements.php');
}

if(isset($_POST['update_elements'])){

    $id = $_POST['id'];
    $gold_price = $_POST['gold_price'];
    $silver_price = $_POST['silver_price'];

    mysqli_query($conn, "UPDATE `element_price` SET gold_price = '$gold_price', silver_price = '$silver_price' WHERE id = '$
	id'") or die('query failed');
 
    header('location:admin_elements.php');
 
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   <style>
    /* Style for table */
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 30px;
  font-size: 2rem;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #8e44ad;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

/* Style for edit and delete links */
a {
  text-decoration: none;
  color: #4CAF50;
}

a:hover {
  text-decoration: underline;
}

  </style>
</head>
<body>
<?php include 'admin_header.php'; ?>
<section class="add-products">

   <h1 class="title">Elements Prices</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>add prices</h3>
	  <label for="gold" class="label">Price per Gram of Gold</label>
      <input type="number" min="0" name="gold" class="box"  placeholder="enter gold price per gram" required>
	  <label for="silver" class="label">Price per Gram of Silver</label>
      <input type="number" min="0" name="silver" class="box" placeholder="enter silver price per gram" required>
	  <!-- <label for="date" class="label">Enter the Date</label>
      <input type="date" name="date" class="box" placeholder="enter the date" required> -->
      <input type="submit" value="add prices" name="add_price" class="btn">
   </form>

</section>

<section class="show-products">
   <div class="products-container">
      
      <div class="product-card">
        <table >
          <tr>
            <th>Element ID</th>
            <th>Gold price</th>
            <th>Silver price</th>
            <th>Date</th>
			<th>Actions</th>
          </tr>
            <?php
                $select_stock = mysqli_query($conn, "SELECT * FROM `element_price`") or die('query failed');
                if(mysqli_num_rows($select_stock) > 0){
                while($fetch_stock = mysqli_fetch_assoc($select_stock)){
            ?>
          <tr>
            <td><?php echo $fetch_stock['id'];?></td>
            <td><?php echo $fetch_stock['gold_price'];?></td>
            <td><?php echo $fetch_stock['silver_price'];?></td>
            <td><?php echo $fetch_stock['date'];?></td>
            <td>
              <a href="admin_elements.php?update=<?php echo $fetch_stock['id']; ?>" class="option-btn">Update</a>
              <a href="admin_elements.php?delete=<?php echo $fetch_stock['id']; ?>" onclick="return confirm('Delete this stock?');" class="delete-btn">Delete</a>
            </td>
            <?php
                }
            ?>
          </tr>
        </table>
      </div>
      <?php
         
      }else{
         echo '<p class="empty">No stocks added yet!</p>';
      }
      ?>
   </div>
</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `element_price` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="number" min="1" name="gold_price" value="<?php echo $fetch_update['gold_price']; ?>" min="0" class="box" required placeholder="enter gold price">
      <input type="number" min="1" name="silver_price" value="<?php echo $fetch_update['silver_price']; ?>" min="0" class="box" required placeholder="enter silver price">
      <input type="submit" value="update" name="update_elements" class="btn">    
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>

</body>
</html>
