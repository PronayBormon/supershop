<?php
include("db.php");
include("header.php");
include("sidebar.php");
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
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div> 
                    <div class="col-md-12">
                        <label class="labels">User Role</label>
                        <select name="role" class="form-control" id="">
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
                    $rand = rand(0,9999);
                    $final_name = $rand."_".$profile;
                    move_uploaded_file($tmp_name,"images/profile_image".$final_name);


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
</div>
    
<?php
include("footer.php");
?>