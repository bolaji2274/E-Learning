<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

if(isset($_POST['submit'])){

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
   $select_user->execute([$user_id]);
   $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

   $prev_pass = $fetch_user['password'];
   $prev_image = $fetch_user['image'];

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

  if(!empty($name)){
   $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
   $update_name->execute([$name, $user_id]);
   $message[] = 'Ìmúdójúìwọ̀n orúkọ ìdánimọ̀ ní àṣeyọrí!';
  }

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   if(!empty($email)){
      $select_email = $conn->prepare("SELECT email FROM `users` WHERE email = ?");
      $select_email->execute([$email]);
      if($select_email->rowCount() > 0){
         $message[] = 'Imeeli ti ya tẹlẹ!';
      }else{
         $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $user_id]);
         $message[] = 'imeeli imudojuiwọn ni ifijišẹ!';
      }
   }

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'iwon aworan ti tobiju';
      }else{
         $update_image = $conn->prepare("UPDATE `users` SET `image` = ? WHERE id = ?");
         $update_image->execute([$rename, $user_id]);
         move_uploaded_file($image_tmp_name, $image_folder);
         if($prev_image != '' AND $prev_image != $rename){
            unlink('uploaded_files/'.$prev_image);
         }
         $message[] = 'Àwòrán ti ṣe àtúnṣe pẹ̀lú ìyẹ̀sí!';
      }
   }

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'Ọ̀rọ̀ ìgbaniwọlé àtijọ́ kò bá a mu!';
      }elseif($new_pass != $cpass){
         $message[] = 'jẹ́rìí sí ọ̀rọ̀-ìfiwọlé kò bá a mu!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass->execute([$cpass, $user_id]);
            $message[] = 'ọrọigbaniwọle imudojuiwọn ni ifijišẹ!';
         }else{
            $message[] = 'Jọwọ tẹ ọrọ igbaniwọle tuntun!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>imudojuiwọn profaili</title>
   <link rel="icon" href="pic-2.jpg">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="form-container" style="min-height: calc(100vh - 19rem);">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>imudojuiwọn profaili</h3>
      <div class="flex">
         <div class="col">
            <p>Orukọ rẹ</p>
            <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" maxlength="100" class="box">
            <p>imeeli rẹ</p>
            <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" maxlength="100" class="box">
            <p>imudojuiwọn aworan</p>
            <input type="file" name="image" accept="image/*" class="box">
         </div>
         <div class="col">
               <p>ọ̀rọ̀-ìfiwọlé àtijọ́</p>
               <input type="password" name="old_pass" placeholder="tẹ ọrọ igbaniwọle atijọ rẹ sii" maxlength="50" class="box">
               <p>ọ̀rọ̀-ìfiwọlé tuntun</p>
               <input type="password" name="new_pass" placeholder="tẹ ọrọ igbaniwọle tuntun rẹ" maxlength="50" class="box">
               <p>jẹ́rìí sí ọ̀rọ̀-ìfiwọ</p>
               <input type="password" name="cpass" placeholder="jẹ́rìí sí ọ̀rọ̀-ìfiwọlé rẹ tuntun" maxlength="50" class="box">
         </div>
      </div>
      <input type="submit" name="submit" value="imudojuiwọn profaili" class="btn">
   </form>

</section>

<!-- update profile section ends -->













<?php include 'components/foot.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>