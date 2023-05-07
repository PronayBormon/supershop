<?php
include("db.php");
include("header.php");
include("sidebar.php");
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
  // $edit_id = $_GET["edit_id"];
    $select = "SELECT * FROM user WHERE user_id = '$u_id' ";
    $sql = mysqli_query($db, $select);
    while( $row = mysqli_fetch_assoc($sql)){

        $user_id = $row["user_id"];
        $user_name = $row["user_name"];
        $user_surname  = $row["user_surname"];
        $user_mobile = $row["user_mobile"];
        $addressOne = $row["user_addressOne"];
        $addressTwo = $row["user_addressTwo"];
        $post_code = $row["user_postcode"];
        $state = $row["user_state"];
        $area = $row["user_area"];
        $email = $row["user_email"];
        $education = $row["user_education"];
        $country = $row["user_country"];
        $d_status = $row["user_status"];
        $role = $row["user_role"];
        $password = $row["user_pass"];
        $profile = $row["user_profile"];
    }

?>
<!-- wrapper part start here  -->
<div class="content-wrapper">   
  <div class="container rounded bg-white mb-5">
      <form action="" method="POST" enctype="multipart/form-data">
          <div class="row">
              <div class="col-md-3 border-right">
                  <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" height="150px" src="images/profile_image/<?php echo $profile;?>"><span class="font-weight-bold"><?php echo $user_name." ".$user_surname;?></span><span class="text-black-50"><?php echo $email;?></span><span> </span></div>
              </div>
              <div class="col-md-5 border-right">
                  <div class="p-3 py-5">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                          <h4 class="text-right">Profile Settings</h4>
                      </div>
                      <div class="row mt-2">
                          <div class="col-md-6">
                              <label class="labels">Name</label>
                              <input type="text" class="form-control" required name="name" placeholder="first name" value="<?php echo $user_name;?>">
                          </div>
                          <div class="col-md-6">
                              <label class="labels">Surname</label>
                              <input type="text" class="form-control" value="<?php echo $user_surname;?>" name="surname" placeholder="surname">
                          </div>
                      </div>
                      <div class="row mt-3">
                          <div class="col-md-12">
                              <label class="labels">Mobile Number</label>
                              <input type="text" class="form-control" name="mobile" placeholder="enter phone number" value="<?php echo $user_mobile;?>">
                          </div>
                          <div class="col-md-12">
                              <label class="labels">Address Line 1</label>
                              <input type="text" class="form-control" name="addressOne" placeholder="enter address line 1" value="<?php echo $addressOne;?>">
                          </div>
                          <div class="col-md-12">
                              <label class="labels">Address Line 2</label>
                              <input type="text" class="form-control" name="addressTwo" placeholder="enter address line 2" value="<?php echo $addressTwo;?>">
                          </div>
                          <div class="col-md-12">
                              <label class="labels">Postcode</label>
                              <input type="text" class="form-control" name="postcode" placeholder="enter address line 2" value="<?php echo $post_code;?>">
                          </div>
                          <div class="col-md-12">
                              <label class="labels">State</label>
                              <input type="text" class="form-control" name="state" placeholder="enter address line 2" value="<?php echo $state;?>">
                          </div>
                          <div class="col-md-12">
                              <label class="labels">Area</label>
                              <input type="text" class="form-control" name="area" placeholder="enter address line 2" value="<?php echo $area;?>">
                          </div>
                          <div class="col-md-12">
                              <label class="labels">Email </label>
                              <input type="text" class="form-control" name="email" required placeholder="enter email id" value="<?php echo $email;?>">
                          </div>
                          <div class="col-md-12">
                              <label class="labels">Education</label>
                              <input type="text" class="form-control" name="education" placeholder="education" value="<?php echo $education;?>">
                          </div>
                      </div>
                      <div class="row mt-3">
                          <div class="col-md-12">
                              <label class="labels">Country</label>
                              <input type="text" class="form-control" name="country" placeholder="country" value="<?php echo $country;?>">
                          </div>
                          
                      </div>
                      
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="row p-3 py-5">               

                      <div class="col-md-12">
                          <label class="labels">Password</label>
                          <input type="text" class="form-control" name="password" autocomplete="off" required placeholder="Enter Your password" value="">
                      </div> 
                      <div class="col-md-12">
                          <label class="labels">Retype Password</label>
                          <input type="text" class="form-control" name="repassword" autocomplete="off" required placeholder="Enter Your password" value="">
                      </div>
                      <div class="col-md-12">
                          <label class="labels">User Status</label>
                          <select name="status" class="form-control" id="">
                              <option value="1" <?php if($d_status==1){echo 'selected';}?> >Active</option>
                              <option value="2" <?php if($d_status==2){echo 'selected';}?>>Inactive</option>
                          </select>
                      </div> 
                      <div class="col-md-12">
                          <label class="labels">User Role</label>
                          <select name="role" class="form-control" id="">
                              <option value="1" <?php if($role==1){echo 'selected';}?>>Admin</option>
                              <option value="2" <?php if($role==2){echo 'selected';}?>>employee</option>
                          </select>
                      </div> 
                      <div class="col-md-12">
                          <img src="images/profile_image/.<?php echo $profil;?>" style="height:60px;" alt="">
                          <label class="labels">Profile Picture</label>
                          <input type="file" class="form-control" name="profile" placeholder="" value="">
                      </div> 
                      <div class="mt-5 text-center">
                          <!-- <button class="btn btn-primary profile-button" name="create" type="button">Create Profile</button> -->
                          <input class="btn btn-primary profile-button" type="submit" name="update" value="Update Profile">
                      </div>
                  </div>
              </div>
          </div>
          <?php
          if(isset($_POST["update"])){

              $user_name = $_POST["name"];
              $surname = $_POST["surname"];
              $mobile = $_POST["mobile"];
              $addressOne = $_POST["addressOne"];
              $addressTwo = $_POST["addressTwo"];
              $postcode = $_POST["postcode"];
              $state = $_POST["state"];
              $area = $_POST["area"];
              $email = $_POST["email"];
              $education = $_POST["education"];
              $country = $_POST["country"];
              $password = $_POST["password"];
              $repassword = $_POST["repassword"];

              $profile = $_FILES["profile"]["name"];
              $tmp_name = $_FILES["profile"]["tmp_name"];

              if(empty($password) && empty($repassword)){
                echo "<script> alert('Please Enter you password')</script>";
              }else{
                if($password==$repassword){

                  if($password==$u_pass){
                    if(empty($profile)){                     
                      $update = "UPDATE `user` SET `user_name`='$user_name',`user_surname`='$surname',`user_mobile`='$mobile',`user_addressOne`='$addressOne',`user_addressTwo`='$addressTwo',`user_postcode`='$post_code',`user_state`='$state',`user_area`='$area',`user_email`='$email',`user_education`='$education',`user_country`='$country' WHERE user_id = $u_id";
                        $sql = mysqli_query($db,$update);
                        if($sql){
                          echo "<script> alert('Successfully change'); 
                          window.location.href='profile.php';
                          </script>";
                        }
                    }else{
                        $rand = rand(0,9999);
                        $final_name = $rand."_".$profile;
                        move_uploaded_file($tmp_name,"images/profile_image/".$final_name);

                        $update = "UPDATE `user` SET `user_name`='$user_name',`user_surname`='$surname',`user_mobile`='$mobile',`user_addressOne`='$addressOne',`user_addressTwo`='$addressTwo',`user_postcode`='$post_code',`user_state`='$state',`user_area`='$area',`user_email`='$email',`user_education`='$education',`user_country`='$country',`user_profile`='$final_name' WHERE user_id = $u_id";
                        $sql = mysqli_query($db,$update);
                        if($sql){
                          echo "<script> alert('Successfully change'); 
                          window.location.href='profile.php';
                          </script>";
                        }
                    }
                  }else{                    
                    echo "<script> alert('Password Worng')</script>";
                  }
                }
              }
          }
          ?>
      </form>
  </div>   
</div>
    
<?php
include("footer.php");
}else{
  header("location:login.php");

}
?>