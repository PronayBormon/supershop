<?php
include("db.php");
include("header.php");
include("sidebar.php");

if(isset($_GET["add"])){ ?><!-- ========================== Add part start here ==================-->
    <!-- content wrapper  -->
        <div class="content-wrapper">
            <!-- card start  -->
            <div class="card m-2">
                <!-- card header  -->
                <div class="card-header d-flex ">
                    <div><h2><i class="fa-solid fa-cart-shopping"></i> All User</h2></div>
                    <div class="profile ms-auto">
                    <div class="dropdown ">
                        <button class="bg-transparent border border-0 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="images/logo.png" class="img-fluid border rounded-circle me-2" style="height: 40px; width:40px;" alt=""> Pronay Kumar Bormon
                        </button>
                        <ul class="dropdown-menu" style="right:0px; width:100%;" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="logout.php" title="logout">Logout</a></li>
                        </ul>
                    </div>
                    </div>
                </div>
                <!-- card herader  -->

                <!-- card body  -->
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">                
                            <div class="col-md-6">
                                <div>
                                    <label for="name" >Name</label>
                                    <input type="text" name="name" placeholder="Name" class="form-control" required>
                                </div>
                                <div>
                                    <label for="name" >Email</label>
                                    <input type="text" name="email" placeholder="Email address" class="form-control"  autocomplete="off" required>
                                </div>
                                <div>
                                    <label for="name" >Password</label>
                                    <input type="text" name="pass" placeholder="Password" class="form-control" autocomplete="off" required>
                                </div>
                                <div>
                                    <label for="name" >Role</label>
                                    <select name="role" id="" class="form-control" required>
                                        <option value="" selected >Select One</option>
                                        <option value="1">Admin</option>
                                        <option value="2" >Employee </option>
                                        
                                    </select>
                                </div>
                                <div>
                                    <label for="name" >Status</label>
                                    <select name="status" id="" class="form-control" required>
                                        <option value="" selected >Select One</option>
                                        <option value="1">Active</option>
                                        <option value="2" >Inactive </option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="name" >Address</label>
                                    <input type="text" name="address" placeholder="Address" class="form-control"  autocomplete="off">
                                </div>
                                <div>
                                    <label for="name" >Phone</label>
                                    <input type="text" name="phone" placeholder="Phone" class="form-control" autocomplete="off">
                                </div>
                                <div class="">
                                    <label for=""> Featured image</label>
                                    <input type="file" class="form-control" name="profile_img">
                                </div>
                                <div>
                                    <input type="submit" name="submit" value="Submit" class="btn btn-secondary mt-2">
                                </div>
                            </div>                
                        </div>
                        <?php
                        if(isset($_POST["submit"])){
                            $rand_id = rand(0,999);
                            $name = $_POST["name"];
                            $email = $_POST["email"];
                            $pass = $_POST["pass"];
                            $role = $_POST["role"];
                            $status = $_POST["status"];
                            $adress = $_POST["address"];
                            $phone = $_POST["phone"];

                            $profile = $_FILES["profile_img"]["name"];
                            $img_tmp = $_FILES["profile_img"]["tmp_name"];

                            $rand = rand(0,9999);
                            $final_name = $rand."_".$profile;
                            move_uploaded_file($img_tmp,"images/profile_image/".$final_name);

                            $insert = "INSERT INTO `user`(`user_id`, `user_name`, `user_email`, `user_pass`, `user_role`, `user_status`, `user_address`, `user_phone`, `user_profile`) VALUES ('$rand_id','$name','$email','$pass','$role','$status','$adress','$phone','$final_name')";
                            $sql = mysqli_query($db,$insert);
                            if($sql){
                                echo '<script type ="text/JavaScript">';  
                                echo 'alert(" New User Add Successfull ")';  
                                echo '</script>'; 
                                header("location:user.php");
                            }
                            
                        }
                        
                        ?>
                    </form>
                </div>
                <!-- card body  -->
            </div><!-- card end  -->            
        </div><!-- content wrapper end  --><?php
}else if(isset($_GET["edit_id"])){
    $edit_id = $_GET["edit_id"];?> <!-- ========================== Edit/Update part start here ==================-->
    <!-- content wrapper  -->
    <div class="content-wrapper">
        <!-- card start  -->
        <div class="card m-2">
            <!-- card header  -->
            <div class="card-header d-flex ">
                <div><h2><i class="fa-solid fa-cart-shopping"></i> All User</h2></div>
                <div class="profile ms-auto">
                <div class="dropdown ">
                    <button class="bg-transparent border border-0 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="images/logo.png" class="img-fluid border rounded-circle me-2" style="height: 40px; width:40px;" alt=""> Pronay Kumar Bormon
                    </button>
                    <ul class="dropdown-menu" style="right:0px; width:100%;" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="logout.php" title="logout">Logout</a></li>
                    </ul>
                </div>
                </div>
            </div>
            <!-- card herader  -->
                <?php
                
            //  ======================================= read query part start here =========================
                $select = "SELECT * FROM user WHERE user_id = $edit_id";
                $sql = mysqli_query($db,$select);
                while($row = mysqli_fetch_assoc($sql)){
                    $edit_id = $row["user_id"];
                    $edit_name = $row["user_name"];
                    $edit_email = $row["user_email"];
                    $edit_pass = $row["user_pass"];
                    $edit_role = $row["user_role"];
                    $edit_status = $row["user_status"];
                    $edit_address = $row["user_address"];
                    $edit_phone = $row["user_phone"];
                    $edit_profile = $row["user_profile"];

                }
            //  ======================================= read query part end here ===========================                
                ?>
            <!-- card body  -->
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">                
                        <div class="col-md-6">
                            <div>
                                <label for="name" >Name</label>
                                <input type="text" name="name" placeholder="Name" value="<?php echo $edit_name;?>" class="form-control" required>
                            </div>
                            <div>
                                <label for="name" >Email</label>
                                <input type="text" name="email" placeholder="Email address"  value="<?php echo $edit_email;?>" class="form-control"  autocomplete="off" required>
                            </div>
                            <div>
                                <label for="name" >Password</label>
                                <input type="text" name="pass" placeholder="Password"  value="<?php echo $edit_pass;?>" class="form-control" autocomplete="off" required>
                            </div>
                            <div>
                                <label for="name" >Password</label>
                                <input type="text" name="repass" placeholder="Password"  value="<?php echo $edit_pass;?>" class="form-control" autocomplete="off" required>
                            </div>
                            <div>
                                <label for="name" >Role</label>
                                <select name="role" id="" class="form-control" required>
                                    <option value="" selected >Select One</option>
                                    <option value="1"  <?php if($edit_role==1){echo 'selected';}?>>Admin</option>
                                    <option value="2" <?php if($edit_role==2){echo 'selected';}?> >Employee </option>
                                    
                                </select>
                            </div>
                            <div>
                                <label for="name" >Status</label>
                                <select name="status" id="" class="form-control" required>
                                    <option value="" selected >Select One</option>
                                    <option value="1" <?php if($edit_status==1){echo 'selected';}?>>Active</option>
                                    <option value="2" <?php if($edit_status==2){echo 'selected';}?>>Inactive </option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label for="name" >Address</label>
                                <input type="text" name="address" placeholder="Address" class="form-control" value="<?php echo $edit_address;?>" autocomplete="off">
                            </div>
                            <div>
                                <label for="name" >Phone</label>
                                <input type="text" name="phone" placeholder="Phone" class="form-control" value="<?php echo $edit_phone;?>"  autocomplete="off">
                            </div>
                            <div class="">
                                <label for=""> Featured image</label> <br>
                                <img src="images/profile_image/<?php echo $edit_profile;?>" class="mb-1" style="height: 40px;" alt="">
                                <input type="file" class="form-control" value="<?php echo $edit_profile;?>"  name="profile_img">
                            </div>
                            <div>
                                <input type="submit" name="submit" value="Submit" class="btn btn-secondary mt-2">
                            </div>
                        </div>                
                    </div>
                    <?php
                    if(isset($_POST["submit"])){
                        $name = $_POST["name"];
                        $email = $_POST["email"];
                        $pass = $_POST["pass"];
                        $repass = $_POST["repass"];                        
                        $role = $_POST["role"];
                        $status = $_POST["status"];
                        $address = $_POST["address"];
                        $phone = $_POST["phone"];

                        $profile = $_FILES["profile_img"]["name"];
                        $img_tmp = $_FILES["profile_img"]["tmp_name"];

                        if($pass==$repass){
                            if(!empty($profile)){

                                $rand = rand(0,9999);
                                $final_name = $rand."_".$profile;
                                move_uploaded_file($img_tmp,"images/profile_image/".$final_name);
    
                                $update = "UPDATE `user` SET `user_name`='$name',`user_email`='$email',`user_pass`='$pass',`user_role`='$role',`user_status`='$status',`user_address`='$address',`user_phone`='$phone',`user_profile`='$final_name' WHERE `user_id`='$edit_id'";
                                $sql = mysqli_query($db,$update);
                                if($sql){
                                    
                                    header("location:user.php");
                                }else{
                                    echo "Dose not change";
                                }
                            }else if(empty($profile)){                           
                                
    
                                $update = "UPDATE `user` SET `user_name`='$name',`user_email`='$email',`user_pass`='$pass',`user_role`='$role',`user_status`='$status',`user_address`='$address',`user_phone`='$phone' WHERE user_id = $edit_id";
                                $sql = mysqli_query($db,$update);
                                if($sql){
                                    header("location:user.php");
                                }else{
                                    echo "Dose not change";
                                }
                            
                                
    
                                
                            }else{
                                echo '<script type ="text/JavaScript">';  
                                echo 'alert(" Profile can not Update")';  
                                echo '</script>'; 
                            }
                        }
                        
                    }
                    
                    ?>
                </form>
            </div>
            <!-- card body  -->
        </div><!-- card end  -->            
    </div><!-- content wrapper end  -->

<?php


}else if(isset($_GET["delete_id"])){
    
    $delete_id = $_GET["delete_id"];
    $delete = "DELETE FROM `user` WHERE user_id='$delete_id'";
    $sql = mysqli_query($db,$delete);
    if($sql){
        header("location:user.php?successfull");
    }else{
        echo "Somthing Wrong";
    }






}else if(isset($_GET["successfull"])){


    echo '<script type ="text/JavaScript">';  
    echo 'alert(" Succesfull")';  
    echo '</script>'; 


}else{?> <!----============================table part start here ===========================------>
    <div class="content-wrapper"> <!-- content wrapper part start here ---------> 
        <div class="card m-2"> <!--- card start here  --->
            <div class="card-header"><!--- card header--->
                <h4>All user details </h4>
            </div>
            <div class="card-body"> <!---card body --->
                <table id="User_table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>User Id </th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Role</th>
                            <th>Status </th>
                            <th>Address</th>
                            <th>phone</th>
                            <th>Profile</th>
                            <th>Edit/Delete</th>
                        </tr>
                    </thead>
                    <tbody><?php
                        $select = "SELECT * FROM user";
                        $sql = mysqli_query($db, $select);
                        while($row = mysqli_fetch_assoc($sql)){
                            $user_id = $row["user_id"];
                            $user_name = $row["user_name"];
                            $user_email = $row["user_email"];
                            $user_pass = $row["user_pass"];
                            $user_role = $row["user_role"];
                            $user_status = $row["user_status"];
                            $user_address = $row["user_address"];
                            $user_phone = $row["user_phone"];
                            $user_profile = $row["user_profile"];?>

                            <!-- print table data here  -->
                        <tr>
                            <td><?php echo $user_id;?></td>
                            <td><?php echo $user_name;?></td>
                            <td><?php echo $user_email;?></td>
                            <td><?php if($user_role==1){echo "<p class=' badge  bg-success'>Admin</p>";}else{echo "<p class='badge  bg-warning'>Employee</p>";}?></td>
                            <td><?php if($user_status==1){echo "<p class='badge  bg-info'>Active</p>";}else{echo "<p class='badge  bg-danger'>Inactive</p>";} ?> </td>
                            <td><?php echo $user_address;?></td>
                            <td><?php echo $user_phone;?></td>
                            <td>
                                <img src="images/profile_image/<?php echo $user_profile;?>" style="height:40px;" alt="">
                                
                            </td>
                            <td class="btn-group btn-sm">
                                <a href="user.php?edit_id=<?php echo $user_id;?>" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i></a>
                                <a href="" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#id<?php echo $user_id;?>"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                            <!-- modal here  -->
                            <!-- Button trigger modal -->                            

                            <!-- Modal -->
                            <div class="modal fade" id="id<?php echo $user_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            
                                            <h5 class="modal-title" id="exampleModalLabel"> <strong class=" ">Are You Sure?</strong>  </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body"> <strong class=" color-danger">Delete <?php echo $user_name;?></strong>  
                                        <?php
                                            echo "id = ".$user_id;
                                            
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a href="user.php?delete_id=<?php echo $user_id;?>" class="btn btn-info">Delete</a>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </tr><?php


                        }
                        ?>

                            
                        
                    </tbody>
                </table>
                
            </div>
        </div>
        
    </div>
<!--- wrapper end here --->
<?php
}
include("footer.php");
?>