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
    if($u_role==1 && $u_status==1){
  
?>
<!-- wrapper part start here  -->
<div class="content-wrapper"> 

    <!-- alert  -->
    <?php
    if(isset($_GET["repassalert"])){
        echo '<script>alert("Password dose not match")</script>';
    }
    if(isset($_GET["succesfull"])){
        echo '<script>alert("Succesfuly Created")</script>';

    }
    ?>
    <!-- alert end  -->
  
  <?php 
  if(isset($_GET["add"])){?>
    <div class="container rounded bg-white mb-5">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="images/user.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Name</label>
                                <input type="text" class="form-control" required name="name" placeholder="first name" value="">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Surname</label>
                                <input type="text" class="form-control" value="" name="surname" placeholder="surname">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Mobile Number</label>
                                <input type="text" class="form-control" name="mobile" placeholder="enter phone number" value="">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Address Line 1</label>
                                <input type="text" class="form-control" name="addressOne" placeholder="enter address line 1" value="">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Address Line 2</label>
                                <input type="text" class="form-control" name="addressTwo" placeholder="enter address line 2" value="">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Postcode</label>
                                <input type="text" class="form-control" name="postcode" placeholder="enter address line 2" value="">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">State</label>
                                <input type="text" class="form-control" name="state" placeholder="enter address line 2" value="">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Area</label>
                                <input type="text" class="form-control" name="area" placeholder="enter address line 2" value="">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email </label>
                                <input type="text" class="form-control" name="email" required placeholder="enter email id" value="">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Education</label>
                                <input type="text" class="form-control" name="education" placeholder="education" value="">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Country</label>
                                <input type="text" class="form-control" name="country" placeholder="country" value="">
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row p-3 py-5">               

                        <div class="col-md-12">
                            <label class="labels">Password</label>
                            <input type="text" class="form-control" name="password" required placeholder="Password" value="">
                        </div> 
                        <div class="col-md-12">
                            <label class="labels">Retype Password</label>
                            <input type="text" class="form-control" name="repassword" required placeholder="Retype Your password" value="">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">User Status</label>
                            <select name="status" class="form-control" id="">
                                <option value="" disabled selected>Select One</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div> 
                        <div class="col-md-12">
                            <label class="labels">User Role</label>
                            <select name="role" class="form-control" id="">
                                <option value="" disabled selected>Select One</option>
                                <option value="1">Admin</option>
                                <option value="2">employee</option>
                            </select>
                        </div> 
                        <div class="col-md-12">
                            <label class="labels">Profile Picture</label>
                            <input type="file" class="form-control" name="profile" placeholder="" value="">
                        </div> 
                        <div class="mt-5 text-center">
                            <!-- <button class="btn btn-primary profile-button" name="create" type="button">Create Profile</button> -->
                            <input class="btn btn-primary profile-button" type="submit" name="create" value="Create Profile">
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if(isset($_POST["create"])){

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
                $status = $_POST["status"];
                $role = $_POST["role"];
                $password = $_POST["password"];
                $repassword = $_POST["repassword"];

                $profile = $_FILES["profile"]["name"];
                $tmp_name = $_FILES["profile"]["tmp_name"];

                $user_id = rand(0,9999999);

            if($password==$repassword){

                $select = "SELECT * FROM `user`";
                $ssql = mysqli_query($db,$select);
                while($row = mysqli_fetch_assoc($ssql)){
                    $d_name = $row["user_name"];
                    $s_name = $row["user_surname"];
                    $d_mail = $row["user_email"];
                }
                if($user_name==$d_name && $surname==$s_name){
                    echo "<script> alert('User name already used!')</script>";
                }else if($d_mail==$email){                
                    echo "<script> alert('Email Address already used!')</script>";
                }else{
                    if(empty($profile)){
                        


                        $insert = "INSERT INTO `user`(`user_id`, `user_name`, `user_surname`, `user_mobile`, `user_addressOne`, `user_addressTwo`, `user_postcode`, `user_state`, `user_area`, `user_email`, `user_education`, `user_country`, `user_status`, `user_role`, `user_pass`) VALUES ('$user_id','$user_name','$surname','$mobile','$addressOne','$addressTwo','$postcode','$state','$area','$email','$education','$country','$status','$role','$password') ";
                        $sql= mysqli_query($db,$insert);
                        if($sql){
                            
                        header("location:user.php?succesfull");
                        }
                    }else{
                        $rand = rand(0,9999);
                        $final_name = $rand."_".$profile;
                        move_uploaded_file($tmp_name,"images/profile_image".$final_name);


                        $insert = "INSERT INTO `user`(`user_id`, `user_name`, `user_surname`, `user_mobile`, `user_addressOne`, `user_addressTwo`, `user_postcode`, `user_state`, `user_area`, `user_email`, `user_education`, `user_country`, `user_status`, `user_role`, `user_pass`, `user_profile`) VALUES ('$user_id','$user_name','$surname','$mobile','$addressOne','$addressTwo','$postcode','$state','$area','$email','$education','$country','$status','$role','$password','$final_name') ";
                        $sql= mysqli_query($db,$insert);
                        if($sql){
                            
                        header("location:user.php?succesfull");
                        }
                    }
                }

            }else{
                header("location:user.php?repassalert");
            }
            }
            ?>
        </form>
    </div>  
  <?php   
  }else if(isset($_GET["edit_id"])){

    $edit_id = $_GET["edit_id"];
    $select = "SELECT * FROM user WHERE user_id = '$edit_id' ";
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
                            <input type="text" class="form-control" name="password" required placeholder="Password" value="<?php echo $password;?>">
                        </div> 
                        <div class="col-md-12">
                            <label class="labels">Retype Password</label>
                            <input type="text" class="form-control" name="repassword" required placeholder="Retype Your password" value="<?php echo $password;?>">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">User Status</label>
                            <select name="status" class="form-control" id="">
                                <option value="" disabled selected>Select One</option>
                                <option value="1" <?php if($d_status==1){echo 'selected';}?> >Active</option>
                                <option value="2" <?php if($d_status==2){echo 'selected';}?>>Inactive</option>
                            </select>
                        </div> 
                        <div class="col-md-12">
                            <label class="labels">User Role</label>
                            <select name="role" class="form-control" id="">
                                <option value="" disabled selected>Select One</option>
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
                $status = $_POST["status"];
                $role = $_POST["role"];
                $password = $_POST["password"];
                $repassword = $_POST["repassword"];

                $profile = $_FILES["profile"]["name"];
                $tmp_name = $_FILES["profile"]["tmp_name"];

                if($password==$repassword){

                    if(empty($profile)){                       

                        $update = "UPDATE `user` SET `user_name`='$user_name',`user_surname`='$surname',`user_mobile`='$mobile',`user_addressOne`='$addressOne',`user_addressTwo`='$addressTwo',`user_postcode`='$post_code',`user_state`='$state',`user_area`='$area',`user_email`='$email',`user_education`='$education',`user_country`='$country',`user_status`='$status',`user_role`='$role',`user_pass`='$password' WHERE user_id = $edit_id";
                        $sql = mysqli_query($db,$update);
                        if($sql){
                            header("location:user.php");
                        }
                    }else{
                        $rand = rand(0,9999);
                        $final_name = $rand."_".$profile;
                        move_uploaded_file($tmp_name,"images/profile_image/".$final_name);

                        $update = "UPDATE `user` SET `user_name`='$user_name',`user_surname`='$surname',`user_mobile`='$mobile',`user_addressOne`='$addressOne',`user_addressTwo`='$addressTwo',`user_postcode`='$post_code',`user_state`='$state',`user_area`='$area',`user_email`='$email',`user_education`='$education',`user_country`='$country',`user_status`='$state',`user_role`='$role',`user_pass`='$password',`user_profile`='$final_name' WHERE user_id = $edit_id";
                        $sql = mysqli_query($db,$update);
                        if($sql){
                            header("location:user.php");
                        }
                    }

                }
            }
            ?>
        </form>
    </div>  


<?php

  }else if(isset($_GET["delete_id"])){
        $d_id = $_GET["delete_id"];

        $dsql = "DELETE FROM `user` WHERE `user_id`='$d_id'";
        $sql = mysqli_query($db,$dsql);
        if($sql){
            echo "<script> 
            alert('Successfully Delete ');
            window.location.href='user.php';            
            </script>";
        }

  }else{
    ?>
    <div class="card">
        <div class="card-header d-flex "> 
            <div>
                <h2><i class="fa-solid fa-cart-shopping"></i> All user page </h2>
            </div>
            <div class="profile ms-auto">
                <div class="dropdown ">
                    <button class="bg-transparent border border-0 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="images/profile_image/<?php echo $u_profile;?>" class="img-fluid border rounded-circle me-2" style="height: 40px; width:40px;" alt=""> <?php echo $u_name;?>
                    </button>
                    <ul class="dropdown-menu" style="right:0px; width:100%;" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="logout.php" title="logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="User_table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>User Id </th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Address</th>
                        <th>Email Address</th>
                        <th>Country </th>
                        <th>Education</th>
                        <th>Status</th>
                        <th>Role </th>
                        <th>Profile  </th>                        
                        <th> Edit/Delete </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select = "SELECT * FROM user ";
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
                        $status = $row["user_status"];
                        $role = $row["user_role"];
                        $password = $row["user_pass"];
                        $profile = $row["user_profile"];

                    
                    ?>
                    <tr>
                        <td><?php echo $user_id; ?> </td>
                        <td><?php echo $user_name." ".$user_surname; ?> </td>
                        <td><?php echo $user_mobile; ?></td>
                        <td><?php echo $addressOne.",".$addressTwo.",".$post_code.",".$area.",".$state; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $country; ?> </td>
                        <td><?php echo $education; ?> </td>
                        <td><?php if($status==1){echo '<p class="badge badge-success">Active</p>';}else{echo '<p class="badge badge-danger">Inactive</p>';} ?> </td>
                        <td><?php if($role==1){echo '<p class="badge badge-success">Admin</p>';}else{echo '<p class="badge badge-danger">Employee</p>';} ?></td>
                        <td><?php if(empty($profile)){echo '<img src="images/user_pro" class="img-fluid" style="height:40px;"> ';}else{echo "<img src='images/profile_image/$profile' class='img-fluid' style='height:40px;'>";}  ?></td>
                        <td class="btn-group btn-small">
                            <a href="user.php?edit_id=<?php echo $user_id;?>" class="btn btn-secondary">Edit </a>
                            <a href="user.php?delete_id=<?php echo $user_id;?>" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#id=<?php echo $user_id ?>"> Delete </a>
                            
                        </td>
                            <!-- Modal -->
                            <div class="modal fade" id="id=<?php echo $user_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $user_id ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <?php echo $user_name." ".$user_surname; ?> And Id : <?php echo $user_id ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a href="user.php?delete_id=<?php echo $user_id;?>" class="btn btn-primary">Confirm</a>
                                        </div>
                                </div>
                            </div>
                            </div>
                            <!-- modal end  -->
                    </tr>
                    <?php
                    }
                    ?>
                    
                    
                </tbody>
            </table>
        </div>
    </div>


<?php
  }
  
  ?>  
</div>
    
<?php
include("footer.php");
    }else{
        echo "<script> alert('You need permission to visit this page');
        window.location.href='index.php';</script>";
    }
}else{
    header("location:login.php");

  }
?>