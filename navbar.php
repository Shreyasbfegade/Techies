<nav class="navbar navbar-expand-lg navbar-light bg-light ">

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item" style="margin-left: 225px;">
        <a class="nav-link size " href="Home.php"><i class="fa-solid fa-arrow-left"></i></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link size " href="Home.php"><span><i class="fas fa-home"></i></span></a>
    </li>
        <li class="nav-item active">
        
        <a class="nav-link size " href="#" style="margin-left: 50px;"><?php echo $welcome; ?></a>

        </li>
        <?php if (!($userData[4])): ?>
        <li class="nav-item">
          <div class="dropdown pb-4 pt-2 ">
              <a href="#" class="d-flex align-items-center text-Black text-decoration-none dropdown-toggle size Wel"
                  id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="d-sm-inline mx-1 ">Applications <i class="far fa-edit "></i></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-dark text-small shadow Wel">
                  <li><a class="dropdown-item" href="files.php">View Application</a></li>
                  <li>
                      <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="addfile.php">Write Application</a></li>
              </ul>
          </div>
      </li>
      <?php endif ?>
      <?php if ($userData[4]): ?>
      <li class="nav-item">
          <div class="dropdown pb-4 pt-2 ">
              <a href="#" class="d-flex align-items-center text-Black text-decoration-none dropdown-toggle size "style="margin-left : 95px;"
                  id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="d-sm-inline mx-1 "> Users <i class="far fa-edit "></i></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-dark text-small shadow "  >
                  <li><a class="dropdown-item" href="show.php">Show Users</a></li>
                  <li>
                      <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="register.php">Add Users</a></li>
              </ul>
          </div>
      </li>
      <?php endif ?>
        <li class="nav-item">
            <div class="dropdown pb-4 pt-2" style="margin-left: 370px;">
                <a href="#" class="d-flex align-items-center text-Black text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">
                    
                    <span class="d-sm-inline mx-1 size">User Profile</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                </ul>
            </div>
        </li>
    </ul>

</div>
</nav>
