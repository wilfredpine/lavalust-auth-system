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

                    <form action="" method="post">

                        <?php flash_alert(); ?>

                        <h6 class="card-title">Register Form</h6>
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
                        <b>Confirm Password</b>
                        <br>
                        <input type="password" class="form-control form-control-sm" name="confirm_password" id="confirm_password" required>
                        </p>

                        <hr>

                        <code>
                            Note: This setup is for demonstration purposes only. In a real application, administrators should be added through the admin panel. Registration forms should not display the user type selection; the user type should default to "user" automatically.
                        </code>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="user_type" value="admin" id="user_type1">
                            <label class="form-check-label" for="user_type1">
                                admin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="user_type" value="user" id="user_type2" checked>
                            <label class="form-check-label" for="user_type2">
                                user
                            </label>
                        </div>

                        <hr>

                        
                        <input type="submit" class="btn btn-primary btn-sm" value="Register">
                        <br>
                        <small>already have an account? login <a href="<?php echo BASE_URL; ?>login">here</a>.</small>
                        
                    </form>
                    
                </div>
            </div>
        </div>

    </div>

  </div>


<?php require_once(APP_DIR . "views/partials/foot.php"); ?>
