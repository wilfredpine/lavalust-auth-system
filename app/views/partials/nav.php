<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
          <!-- <img src="" alt="O " width="30">  -->
          <strong class="text-success">LavaLust <?php if($_SESSION['user_type']=="admin"){ ?> Administrator <?php }else{ ?> Dashboard <?php } ?></strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL; ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL; ?>profile">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo BASE_URL; ?>logout">Logout</a>
            </li>
          </ul>
          <span class="navbar-text">
            Powered by <a target="_blank" href="https://github.com/ronmarasigan/LavaLust">LavaLust</a>
          </span>
        </div>
      </div>
    </nav>
