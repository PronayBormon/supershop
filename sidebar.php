<body class="hold-transition sidebar-mini layout-fixed" style="font-family: 'Instrument Serif', serif;">
    <div class="wrapper">
      <!-- sidebar start here  -->
      <aside class="main-sidebar sidebar-light-primary elevation-4">
        <ul>
            <li>
                <a href="index.php"><i class="fa-solid fa-shop"></i>Sell</a>
            </li>
            <li>
                <a href="profile.php"><i class="fa-regular fa-address-card"></i>Profile </a>
            </li>
            <?php
            if(isset($_SESSION["user"])){
                foreach($_SESSION["user"] as $key => $value){
              
                  $u_id = $value["user_id"];
                  $u_name = $value["user_name"];
                  $u_email = $value["user_email"];
                  $u_pass = $value["password"];
                  $u_profile = $value["profile"];
                  $u_role = $value["role"];
                  $u_status = $value["status"];
                }
                if($u_role==1 && $u_status==1){                   



                    ?>
                    <li>
                    <a href="profile.php" class="dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i>User </a>            
                        <ul class="dropdown-menu"  aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="user.php" title="user.php"><i class="fa-solid fa-users"></i> All User</a></li>
                        <li><a class="dropdown-item" href="user.php?add" title="user.php?add"> <i class="fa-solid fa-user-plus"></i>Add User</a></li>   
                        </ul>
                    </li>
                    <li>
                        <a href="product.php"><i class="fa-regular fa-address-card"></i>Products  </a>
                    </li>
                    <li>
                        <a href="order.php"><i class="fa-regular fa-address-card"></i>Order </a>
                    </li>

            <?php 
                }
            }
            ?>
        </ul>

        <!-- sidebar footer part start here  -->
        <div class="aside_footer text-center text-light mt-2" >
            <a href="logout.php" style="color:#fff;"><i class="fa-solid fa-right-from-bracket border  p-2 mt-2 rounded" data-toggle="tooltip" data-placement="top" title="Logout"></i></a>
        </div>
        <!-- sidebar footer part end here  -->
      </aside>
      <!-- sidebar end here  -->