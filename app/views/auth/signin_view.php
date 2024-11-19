<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<?php require_once(APP_DIR . "views/partials/head.php"); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
    <div class="container-fluid">

        <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
            <!-- <img src="" alt="O " width="30">  -->
            <strong class="text-primary">LavaLust</strong>
        </a>

    </div>
</nav>


  <div class="container mt-5">

    <div class="row justify-content-center pt-5">

        <div class="col-sm-3 mb-2">
            <div class="card">
                <div class="card-body">

                    <?php flash_alert(); ?>


                    <form action="" method="post">

                        <h6 class="card-title">Login Form</h6>
                        <small>Not yet register? click <a href="<?php echo BASE_URL; ?>register">here</a>.</small>
                        <hr>
                        <p class="card-text">
                        <b>Email</b>
                        <br>
                        <input type="email" class="form-control form-control-sm" name="email" id="email" required>
                        </p>
                        <p class="card-text">
                        <b>Password</b>
                        <br>
                        <input type="password" class="form-control form-control-sm" name="password" id="password" required>
                        </p>
                        
                        <input type="submit" class="btn btn-primary btn-sm" value="Login">
                        <br>
                        <a href="<?php echo BASE_URL; ?>recover">forgot password?</a>
                        
                    </form>

                </div>
            </div>
        </div>

    </div>

  </div>


<?php require_once(APP_DIR . "views/partials/foot.php"); ?>
