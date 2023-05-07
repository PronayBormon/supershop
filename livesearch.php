<?php
include("db.php");
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

  if($u_status==1 && $u_role==1 && $u_role==2){
    if(isset($_POST['input'])){

        $input = $_POST['input'];
    
        $select = "SELECT * FROM `product` WHERE product_name LIKE '{$input}%' or product_price LIKE '{$input}%' ";
        $sql = mysqli_query($db,$select);
    
        if(mysqli_num_rows($sql)>0){
    
            while($row = mysqli_fetch_assoc($sql)){
                $id = $row["product_id"];
                $name = $row["product_name"];
                $price = $row["product_price"];
                $qnt = $row["product_qnt"];
                $supply = $row["product_supplier"];
            }
            
            
            ?>
    
    <div class="row">
                      <div class="col-md-6 m-auto">
                      <form action="" method="post">
                        <div class="card">
                          <div class="card-header bg bg-secondary bg-gradient"><label for="" class=" "><?php echo $name;?></label></div>
                          <div class="card-body"><h6>Price : <?php echo $price;?> TK</h6><input type="number" class="form-control" placeholder="Add Quantity" value="1"></div>
                          <div class="card-footer bg bg-secondary bg-gradient"><button class=" ">Add</button></div>
                        </div>
                      </form> 
                      </div>
                    </div>
    
    
    <?php    }else{
    
        echo "<p class='text-danger text-center ms-3'>No Data found</p>";
    }
    }
    
    
    }else{
      header("location:login.php");
    }
  
  }else{
    echo "<script> alert('You need permission to visit this page');
    window.location.href='index.php';</script>";

  }
?>