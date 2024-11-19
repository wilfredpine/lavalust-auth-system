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

                        <h6 class="card-title">Password Recover</h6>
                        <small>Not yet register? click <a href="<?php echo BASE_URL; ?>register">here</a>.</small>
                        <hr>
                        <!-- Email -->
                        <div class="mb-3 input-group-sm">
                            <input type="email" class="form-control form-control-sm" name="email" placeholder="Enter email" required>
                        </div>
                        <!-- Button -->
                        <div class="d-grid"><button type="submit" class="btn btn-lg btn-primary btn-sm">Send Verification</button></div>
                        
                        
                    </form>

                </div>
            </div>
        </div>

    </div>

  </div>


<?php require_once(APP_DIR . "views/partials/foot.php"); ?>


