<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dásíbọọ̀dù</title>
   <link rel="icon" href="pic-2.jpg">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<!-- quick select section starts  -->

<section class="quick-select">

   <h1 class="heading">awọn aṣayan kiakia</h1>

   <div class="box-container">

      <?php
         if($user_id != ''){
      ?>
      <div class="box">
         <h3 class="title">awọn fẹran ati awọn asọye</h3>
         <p>lapapọ fẹran : <span><?= $total_likes; ?></span></p>
         <a href="likes.php" class="inline-btn">wo fẹran</a>
         <p>lapapọ asọye : <span><?= $total_comments; ?></span></p>
         <a href="comments.php" class="inline-btn">wo awọn asọye</a>
         <p>akojọ orin ti a fipamọ : <span><?= $total_bookmarked; ?></span></p>
         <a href="bookmark.php" class="inline-btn">wo àmì-ìwé</a>
      </div>
      <?php
         }else{ 
      ?>
      <div class="box" style="text-align: center;">
         <h3 class="title">Jọwọ wọle tabi forukọsilẹ</h3>
          <div class="flex-btn" style="padding-top: .5rem;">
            <a href="login.php" class="option-btn">wiwọle</a>
            <a href="register.php" class="option-btn">forukọsilẹ</a>
         </div>
      </div>
      <?php
      }
      ?>

      <div class="box">
         <h3 class="title">awọn ẹka ti o ga julọ</h3>
         <div class="flex">
         <a href="search_course.php?"><i class="fas fa-code"></i><span>ìmúdàgbàsóke</span></a>
         <a href="#"><i class="fas fa-chart-simple"></i><span>iṣẹ́ ọ̀rọ̀ ajé</span></a>
         <a href="#"><i class="fas fa-pen"></i><span>àlàyé</span></a>
         <a href="#"><i class="fas fa-chart-line"></i><span>ìpolongo</span></a>
         <a href="#"><i class="fas fa-music"></i><span>ìta orin</span></a>
         <a href="#"><i class="fas fa-camera"></i><span>àwòrán</span></a>
         <a href="#"><i class="fas fa-cog"></i><span>sọ̀fọ̀wẹ̀ẹrẹ</span></a>
         <a href="#"><i class="fas fa-vial"></i><span>ìmọ̀ ẹ̀rọ</span></a>

         </div>
      </div>

      <div class="box">
         <h3 class="title">Awọn akọle olokiki</h3>
         <div class="flex">
            <a href="#"><i class="fab fa-html5"></i><span>HTML</span></a>
            <a href="#"><i class="fab fa-css3"></i><span>CSS</span></a>
            <a href="#"><i class="fab fa-js"></i><span>javascript</span></a>
            <a href="#"><i class="fab fa-react"></i><span>react</span></a>
            <a href="#"><i class="fab fa-php"></i><span>PHP</span></a>
            <a href="#"><i class="fab fa-bootstrap"></i><span>bootstrap</span></a>
         </div>
      </div>

      <div class="box tutor">
         <h3 class="title">Di olukọni</h3>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, laudantium.</p>
         <a href="admin/register.php" class="inline-btn">bẹ̀rẹ̀</a>
      </div>

   </div>

</section>

<!-- quick select section ends -->

<!-- courses section starts  -->

<section class="courses">

   <h1 class="heading">awọn ẹkọ tuntun</h1>

   <div class="box-container">

      <?php
         $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE status = ? ORDER BY date DESC LIMIT 6");
         $select_courses->execute(['active']);
         if($select_courses->rowCount() > 0){
            while($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)){
               $course_id = $fetch_course['id'];

               $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
               $select_tutor->execute([$fetch_course['tutor_id']]);
               $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="box">
         <div class="tutor">
            <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_tutor['name']; ?></h3>
               <span><?= $fetch_course['date']; ?></span>
            </div>
         </div>
         <img src="uploaded_files/<?= $fetch_course['thumb']; ?>" class="thumb" alt="">
         <h3 class="title"><?= $fetch_course['title']; ?></h3>
         <a href="playlist.php?get_id=<?= $course_id; ?>" class="inline-btn">view playlist</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">Kò sí ìkẹ́kọ̀ọ́ tí a fi kún un síbẹ̀!</p>';
      }
      ?>

   </div>

   <div class="more-btn">
      <a href="courses.php" class="inline-option-btn">wo diẹ ẹ sii</a>
   </div>

</section>

<!-- courses section ends -->












<!-- footer section starts  -->
<?php include 'components/foot.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>