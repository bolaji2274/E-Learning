<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<style>
   .icons{
      display: flex ;
   }
</style>
<header class="header">

   <section class="flex">

      <a href="dashboard.php" class="logo">Pánẹ́ẹ̀lì<span style="color: #7a6ad8;">Alábòójútó.</span></a>

      <form action="search_page.php" method="post" class="search-form">
         <input type="text" name="search" placeholder="Wa..." required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
            $select_profile->execute([$tutor_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span><?= $fetch_profile['profession']; ?></span>
         <a href="profile.php" class="btn">Wo Profaili</a>
         <a href="../components/admin_logout.php" onclick="return confirm('logout lati oju opo wẹẹbu yii?');" class="delete-btn">logout</a>
         <?php
            }else{
         ?>
         <h3>Jọwọ wọle tabi forukọsilẹ</h3>
            <div class="flex-btn">
            <a href="login.php" class="option-btn">Wọle</a>
            <a href="register.php" class="option-btn">Forukọsilẹ</a>
            </div>
         </div>
         <?php
            }
         ?>
      </div>

   </section>

</header>

<!-- header section ends -->

<!-- side bar section starts  -->

<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
            $select_profile->execute([$tutor_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span><?= $fetch_profile['profession']; ?></span>
         <a href="profile.php" class="btn">Wo Profaili</a>
         <?php
            }else{
         ?>
         <h3>Jọwọ wọle tabi forukọsilẹ</h3>
            <div class="flex-btn">
            <a href="login.php" class="option-btn">Wọle</a>
            <a href="register.php" class="option-btn">Forukọsilẹ</a>
            </div>
         <?php
            }
         ?>
      </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i><span>Ile</span></a>
      <a href="playlists.php"><i class="fa-solid fa-bars-staggered"></i><span>Awọn akojọ fidio</span></a>
      <a href="contents.php"><i class="fas fa-graduation-cap"></i><span>Àwọn àkóónú</span></a>
      <a href="comments.php"><i class="fas fa-comment"></i><span>Awọn asọye</span></a>
      <a href="../components/admin_logout.php" onclick="return confirm('logout lati oju opo wẹẹbu yii?');"><i class="fas fa-right-from-bracket"></i><span>Logout</span></a>
   </nav>

</div>

<!-- side bar section ends -->