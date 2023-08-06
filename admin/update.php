<?php

   include '../components/connect.php';

   if(isset($_COOKIE['tutor_id'])){
      $tutor_id = $_COOKIE['tutor_id'];
   }else{
      $tutor_id = '';
      header('location:login.php');
   }

if(isset($_POST['submit'])){

   $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ? LIMIT 1");
   $select_tutor->execute([$tutor_id]);
   $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);

   $prev_pass = $fetch_tutor['password'];
   $prev_image = $fetch_tutor['image'];

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $profession = $_POST['profession'];
   $profession = filter_var($profession, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `tutors` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $tutor_id]);
      $message[] = 'Ìmúdójúìwọ̀n orúkọ ìdánimọ̀ ní àṣeyọrí!';
   }

   if(!empty($profession)){
      $update_profession = $conn->prepare("UPDATE `tutors` SET profession = ? WHERE id = ?");
      $update_profession->execute([$profession, $tutor_id]);
      $message[] = 'Iṣẹ́ ìmúdójúìwọ̀n iṣẹ́ náà ṣe àṣeyọrí!';
   }

   if(!empty($email)){
      $select_email = $conn->prepare("SELECT email FROM `tutors` WHERE id = ? AND email = ?");
      $select_email->execute([$tutor_id, $email]);
      if($select_email->rowCount() > 0){
         $message[] = 'Imeeli ti ya tẹlẹ!';
      }else{
         $update_email = $conn->prepare("UPDATE `tutors` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $tutor_id]);
         $message[] = 'imeeli imudojuiwọn ni ifijišẹ!';
      }
   }

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_files/'.$rename;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'Iwọn aworan ti tobi ju!';
      }else{
         $update_image = $conn->prepare("UPDATE `tutors` SET `image` = ? WHERE id = ?");
         $update_image->execute([$rename, $tutor_id]);
         move_uploaded_file($image_tmp_name, $image_folder);
         if($prev_image != '' AND $prev_image != $rename){
            unlink('../uploaded_files/'.$prev_image);
         }
         $message[] = 'Àwòrán ti ṣe àtúnṣe pẹ̀lú ìyẹ̀sí!.';
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
            $update_pass = $conn->prepare("UPDATE `tutors` SET password = ? WHERE id = ?");
            $update_pass->execute([$cpass, $tutor_id]);
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
   <title>Ìmúdójúìwọ̀n Púró</title>
   <link rel="icon" href="pic-2.jpg">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<!-- register section starts  -->

<section class="form-container" style="min-height: calc(100vh - 19rem);">

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>imudojuiwọn profaili</h3>
      <div class="flex">
         <div class="col">
            <p>Orukọ rẹ </p>
            <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" maxlength="50"  class="box">
            <p>iṣẹ́ rẹ </p>
            <select name="profession" class="box" required>
               <option value="" disabled selected>-- yan iṣẹ rẹ</option>
               <option value="" selected><?= $fetch_profile['profession']; ?></option>
               <option value="Olùgbéejáde">Olùgbéejáde</option>
               <option value="onise">onise</option>
               <option value="olórin">olórin</option>
               <option value="onímọ̀ nípa ìṣẹ̀dá">onímọ̀ nípa ìṣẹ̀dá</option>
               <option value="olùkọ́ Yoruba">olùkọ́ Yoruba</option>
               <option value="onímọ̀-ẹ̀rọ">onímọ̀-ẹ̀rọ</option>
               <option value="agbẹjọro">agbẹjọro</option>
               <option value="Oniṣiro owo">Oniṣiro owo</option>
               <option value="dókítà">dókítà</option>
               <option value="akọ̀ròyìn">akọ̀ròyìn</option>
               <option value="oluyaworan">oluyaworan</option>
            </select>
            <p>imeeli rẹ </p>
            <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" maxlength="50"  class="box">
         </div>
         <div class="col">
            <p>ọ̀rọ̀-ìfiwọlé àtijọ́ :</p>
            <input type="password" name="old_pass" placeholder="tẹ ọrọ igbaniwọle atijọ rẹ sii" maxlength="20"  class="box">
            <p>ọ̀rọ̀-ìfiwọlé tuntun :</p>
            <input type="password" name="new_pass" placeholder="tẹ ọrọ igbaniwọle tuntun rẹ" maxlength="20"  class="box">
            <p>jẹ́rìí sí ọ̀rọ̀-ìfiwọ :</p>
            <input type="password" name="cpass" placeholder="jẹ́rìí sí ọ̀rọ̀-ìfiwọlé rẹ tuntun" maxlength="20"  class="box">
         </div>
      </div>
      <p>imudojuiwọn aworan :</p>
      <input type="file" name="image" accept="image/*"  class="box">
      <input type="submit" name="submit" value="ìmúdójúìwọ̀n" class="btn">
   </form>

</section>

<!-- registe section ends -->










<?php include '../components/foot.php'; ?>

<script src="../js/admin_script.js"></script>
   
</body>
</html>