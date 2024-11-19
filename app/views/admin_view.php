<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<?php require_once("partials/head.php"); ?>
<?php require_once("partials/nav.php"); ?>
    
  <div class="container">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">index</li>
      </ol>
    </nav>

   
    <!-- <h5>Course list</h5> -->
    
    <div class="row mt-3">

    <?php flash_alert(); ?>

    <hr>
    Welcome <?php echo $_SESSION['user_type']; ?>




    </div>
  </div>

<?php require_once("partials/foot.php"); ?>
