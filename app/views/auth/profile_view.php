<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<?php require_once(APP_DIR . "views/partials/head.php"); ?>
<?php require_once(APP_DIR . "views/partials/nav.php"); ?>
    
  <div class="container">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
      </ol>
    </nav>

    <!-- <h5>Course list</h5> -->
    
    <div class="row mt-3">

      <div class="col-sm-6 mb-2">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">My Profile</h6>
            <hr>
            <form class="mt-4" method="post" action="">

              <div class="row mb-2">
                <label for="email" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control form-control-sm" name="email" id="email">
                </div>
              </div>
              <div class="row mb-2">
                <label for="id_number" class="col-sm-3 col-form-label col-form-label-sm">Id Number</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" name="id_number" id="id_number">
                </div>
              </div>
              <div class="row mb-2">
                <label for="given_name" class="col-sm-3 col-form-label col-form-label-sm">First Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" name="given_name" id="given_name">
                </div>
              </div>
              <div class="row mb-2">
                <label for="middle_name" class="col-sm-3 col-form-label col-form-label-sm">Middle Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" name="middle_name" id="middle_name">
                </div>
              </div>
              <div class="row mb-2">
                <label for="last_name" class="col-sm-3 col-form-label col-form-label-sm">Last Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" name="last_name" id="last_name">
                </div>
              </div>
              
              <button type="submit" class="btn btn-success btn-sm">Save changes</button>
            </form>
          
          </div>
        </div>
      </div>
      <!-- Trigger modal -->
      <a href="#" data-bs-toggle="modal" data-bs-target="#changepass">Change Password?</a>
      <!-- Modal -->
      <div class="modal fade" id="changepass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changepassLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <form action="" method="post">
              <div class="modal-header">
                <h5 class="modal-title" id="changepassLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="mb-2">
                  <label for="old_password" class="form-label col-form-label-sm">Old Password</label>
                  <input type="password" class="form-control form-control-sm" name="old_password" id="old_password" placeholder="********">
                </div>
                <hr>
                <div class="mb-2">
                  <label for="password" class="form-label col-form-label-sm">New Password</label>
                  <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="********">
                </div>
                <div class="mb-2">
                  <label for="confirm_password" class="form-label col-form-label-sm">Confirm Password</label>
                  <input type="password" class="form-control form-control-sm" name="confirm_password" id="confirm_password" placeholder="********">
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success btn-sm" value="Update">
              </div>
            </form>

          </div>
        </div>
      </div>



    </div>
  </div>

<?php require_once(APP_DIR . "views/partials/foot.php"); ?>
