<?php
include("db.php");
include("header.php");
if(isset($_GET["success"])){
    echo "
        <script>
        alert('Succefully Login');
        window.location.href = 'index.php';
        </script>";

}else if(isset($_GET["perror"])){
    echo '<script>alert("Password wrong")</script>';

}else if(isset($_GET["eerror"])){
    echo '<script>alert("No account in this email")</script>';

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <div class="container">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 m-auto">
                    <div class="login-form m-auto">
                        <div class="text-center">
                            <img src="images/logo.png" height="100px" alt="">
                        </div>
                        <div class="headings">
                            <h3>Welcome Back</h3>
                        </div>
                        
                        
                        <div class="inputs">
                            <label for="" style="margin-left: 5px;">Eamil Or Number</label>
                            <input autocomplete='chrome-off' class="input-group" name="email" type="text" placeholder="Email address">
                        </div>
                        <div class="inputs password-input"> 
                            <label for="" style="margin-left: 5px;"> Password </label>
                            <input autocomplete='chrome-off' class="input-group" name="password" id="password_input" type="password" placeholder="Password">
                            <i id="password_eye" class="fa fa-eye"></i>
                        </div>                         
                        <button class="login-button" name="login">Login Now</button>
                        
                        
                    </div>
                </div>
            </div>
            <?php
            if(isset($_POST["login"])){

                echo $l_email = $_POST["email"];
                echo $l_password = $_POST['password'];

                $select = "SELECT * FROM `user` WHERE `user_email` = '$l_email'";
                $sql = mysqli_query($db,$select);
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
                }
                if($l_email==$email){
                    if($l_password==$password){
                        $_SESSION['user'][]= array( 'user_id'=>$user_id, 'user_name'=>$user_name, 'user_email'=>$email, 'password'=> $password, 'profile'=> $profile,'role'=>$role, 'status'=>$status );
                        header("location:login.php?success");
                    }else{
                        
                    header("location:login.php?perror");
                    }
                }else{
                    header("location:login.php?eerror");
                }
            }
            ?>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
  </body>
</html>


