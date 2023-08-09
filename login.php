<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   if($select_user->rowCount() > 0){
     setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
     header('location:dashboard.php');
   }else{
      $message[] = 'imeeli ti ko tọ tabi ọrọ igbaniwọle!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ile</title>
   <link rel="icon" href="pic-2.jpg">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data" class="login">
      <h3>Káàbọ̀!</h3>
      <p>imeeli rẹ <span>*</span></p>
      <input type="email" name="email" placeholder="Tẹ imeeli rẹ" maxlength="50" required class="box">
      <p>ọrọ igbaniwọle rẹ <span>*</span></p>
      <input type="password" name="pass" placeholder="tẹ ọrọ igbaniwọle rẹ " maxlength="20" required class="box">
      <p class="link">Ko ni akọọlẹ kan? <a href="register.php">forukọsilẹ bayi</a></p>
      <input type="submit" name="submit" value="wiwọle bayi" class="btn">
   </form>

</section>












<?php include 'components/foot.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>