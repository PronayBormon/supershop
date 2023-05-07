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
  

?>
<?php
if(isset($_POST["remove"])){    ?>

    
<div class="content-wrapper"> 
    <?php
     $name =  $_POST["p_name"];
    
    foreach($_SESSION['cart'] as $key => $value){
        
        if($value["productName"] === $_POST["p_name"]){
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values( $_SESSION['cart']);
            header('location:index.php');
        }
    }
    // print_r($_SESSION["cart"]);
    ?>
</div>
<?php
}else{?>
    <div class="content-wrapper">
        
        <?php
            
            

            if(isset($_POST["cart"])){   
                

                // $session = $_SESSION['cart'];
                

                
                $pname    = $_POST["pname"];
                $pprice   = $_POST["pprice"];
                $pqnt     = $_POST["pqnt"];
                $id       = $_POST["pid"];
                $session =array('productName'=>$pname, 'productPrice'=>$pprice,'productQnt'=>$pqnt,'pid'=>$id);

                
                
                if(!empty($_SESSION['cart'])){

                    

                    $pro_name = array_column($_SESSION['cart'],'productName');

                    if(in_array($pname,$pro_name)){
                        echo "
                        <script>
                        alert('Allready Added');
                        window.location.href = 'index.php';
                        </script>";
                        // session_unset();

                    }else{
                        $_SESSION['cart'][]=$session;
                        header("location:index.php");
                        // print_r($_SESSION['cart']);
                        // session_unset();
                    }
                }else{
                    $_SESSION['cart'][]=$session;
                    // print_r($_SESSION['cart']);
                    header("location:index.php");
                }

                //     if(in_array($pname,$pro_name)){

                //         echo "
                //         <script>alert('Allready Added');
                //         window.location.href = 'index.php';

                //         </script>";
                //     } 
                
                // }else{

                    // $session=$items;
                
                // }
                
                                        

                    



            
            }


        ?>
    </div>
<?php

}

?>
<?php
include("footer.php");
}else{
    header("location:login.php");

  }
?>