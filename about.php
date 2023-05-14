<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p> Jewellery has been an important part of human culture for centuries. It is a form of self-expression and a way to showcase personal style, taste, and personality. Jewellery is often associated with special occasions and has sentimental value attached to it. It can be passed down through generations and serve as a reminder of loved ones and significant events. Jewellery has cultural significance and can represent religious beliefs, cultural traditions, and social status. Some jewellery can also be a valuable investment, particularly high-end pieces made from precious metals and gemstones. Wearing jewellery can boost one's confidence and self-esteem, making them feel more attractive and put-together. Overall, jewellery is an important aspect of our lives that allows us to express ourselves, connect with our heritage, and enhance our appearance.




.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>