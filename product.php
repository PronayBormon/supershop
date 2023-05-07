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
  

if(isset($_GET["edit_id"])){

    $edit_id = $_GET["edit_id"];?>

    <div class="content-wrapper">
        <div class="card m-2">
            <div class="card-header">
                <h2>Products</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Update Product Details</h3>
                            </div>
                            <div class="card-body">
                                <!-- Product details read query start here  -->
                                <?php
                                $select = "SELECT * FROM product where product_id = $edit_id";
                                $sql = mysqli_query($db,$select);
                                while( $row = mysqli_fetch_assoc($sql)){

                                    $id         = $row["product_id"];
                                    $name       = $row["product_name"];
                                    $price      = $row["product_price"];
                                    $qnt        = $row["product_qnt"];
                                    $supply     = $row["product_supplier"];
                                }
                                ?>
                                <!-- Product details read query end here  -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div>
                                        <label for="name">Product Name</label>
                                        <input type="text" name="p_name" value="<?php echo $name;?>" placeholder="Product Name....." required class="form-control">
                                    </div>
                                    <div>
                                        <label for="name">Product Price</label>
                                        <input type="text" name="p_price" value="<?php echo $price;?>" placeholder="00.00"  class="form-control">
                                    </div>
                                    <div>
                                        <label for="name">Product Quantity</label>
                                        <input type="number" name="p_qnt" value="<?php echo $qnt;?>" placeholder="Product quantity....." value="1"  class="form-control">
                                    </div>
                                    <div>
                                        <label for="name">Product Suppiler</label>
                                        <input type="text" name="p_supply" value="<?php echo $supply;?>" placeholder="Product Supplier....."  class="form-control">
                                    </div>
                                    <div class="btn-sm text-end mt-4">
                                        <input type="submit" class="btn btn-warning" class="mt-4" value="Update" name="add_p">
                                    </div>
                                    <?php
                                    if(isset($_POST["add_p"])){
                                        $p_name = $_POST["p_name"];
                                        $p_price = $_POST["p_price"];
                                        $p_qnt = $_POST["p_qnt"];
                                        $p_supply = $_POST["p_supply"];

                                        
                                        if(!empty($p_name) && !empty($p_price) && !empty($p_qnt) && !empty($p_supply)){

                                            $update = "UPDATE `product` SET `product_name` = '$p_name', `product_price` = '$p_price', `product_qnt` = '$p_qnt', `product_supplier` = '$p_supply' WHERE `product_id`=$edit_id ";
                                            $sql = mysqli_query($db,$update);
                                            if($sql){
                                                echo "<script>
                                                alert('Successfully Product Update!');
                                                window.location.href = 'product.php';
                                                </script>";
                                            }else{
                                                echo "<script>
                                                alert('Something Wrong');
                                                window.location.href = 'product.php';
                                                </script>";
                                            }
                                        }else{
                                       
                                            echo "<script>
                                                alert('Please fill in blunks');
                                                window.location.href = 'product.php';
                                                </script>";
                                            
                                        }
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <table id="User_table" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Product Id</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Supplier</th>
                                            <th>Edit/delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php 
                                            $select = "SELECT * FROM `product` ";
                                            $sql = mysqli_query($db,$select);            
                                            while($row = mysqli_fetch_assoc($sql)){
                                                $id = $row["product_id"];
                                                $name = $row["product_name"];
                                                $price = $row["product_price"];
                                                $qnt = $row["product_qnt"];
                                                $supply = $row["product_supplier"];
                                            
                                            ?>
                                        <tr>
                                            <td><?php echo $id;?></td>
                                            <td><?php echo $name;?></td>
                                            <td><?php echo $price;?></td>
                                            <td><?php echo $qnt;?></td>
                                            <td><?php echo $supply;?></td>
                                            <td class="btn-group btn-sm">
                                                <a href="product.php?edit_id=<?php echo $id;?>" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i></a>
                                                <a href="" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#id<?php echo $id;?>"><i class="fa-solid fa-trash-can"></i></a>
                                            </td>
                                            <!-- modal here  -->                                       

                                            <!-- Modal -->
                                            <div class="modal fade" id="id<?php echo $id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            
                                                            <h5 class="modal-title" id="exampleModalLabel"> <strong class=" ">Are You Sure?</strong>  </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body"> 
                                                            <!-- modal body print  -->
                                                            <div class="row">
                                                                <div class="col-md-6 p-0">
                                                                    <ul style="list-style: none; border: 1px 1px solid; border-bottom: 1px solid #9999">
                                                                        <li style="border: 1px 1px solid; border-bottom: 1px solid #9999"> <strong>Product Id :</strong> </li>
                                                                        <li style="border: 1px 1px solid; border-bottom: 1px solid #9999"> <strong>Product Name : </strong> </li>
                                                                        <li style="border: 1px 1px solid; border-bottom: 1px solid #9999"> <strong>Product Quantity : </strong> </li>
                                                                        <li style="border: 1px 1px solid; border-bottom: 1px solid #9999"> <strong>Product Supplier : </strong> </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-6 p-0">
                                                                    <ul style="list-style: none; border: 1px 1px solid; border-left: 1px solid #9999; border-bottom: 1px solid #9999;" class="ps-0">
                                                                        <li class="ps-2" style="border: 1px 1px solid; border-left: 1px solid #9999; border-bottom: 1px solid #9999;"><?php echo $id;?></li>
                                                                        <li class="ps-2" style="border: 1px 1px solid; border-left: 1px solid #9999; border-bottom: 1px solid #9999;" ><?php echo $name;?></li>
                                                                        <li class="ps-2" style="border: 1px 1px solid; border-left: 1px solid #9999; border-bottom: 1px solid #9999;"><?php echo $qnt;?></li>
                                                                        <li class="ps-2" style="border: 1px 1px solid; border-left: 1px solid #9999; border-bottom: 1px solid #9999;"><?php echo $supply?></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- modal body print end  -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <a href="product.php?delete_id=<?php echo $user_id;?>" class="btn btn-info">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>                                
                                            </div>
                                            
                                        </tr>
                                        <?php }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><?php 

}else if(isset($_GET["delete_id"])){

}else{
    ?>
    <div class="content-wrapper">
        <div class="card m-2">
            <div class="card-header">
                <h2>Products</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add Product</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div>
                                        <label for="name">Product Name</label>
                                        <input type="text" name="p_name" placeholder="Product Name....." required class="form-control">
                                    </div>
                                    <div>
                                        <label for="name">Product Price</label>
                                        <input type="text" name="p_price" placeholder="00.00"  class="form-control">
                                    </div>
                                    <div>
                                        <label for="name">Product Quantity</label>
                                        <input type="number" name="p_qnt" placeholder="Product quantity....." value="1"  class="form-control">
                                    </div>
                                    <div>
                                        <label for="name">Product Suppiler</label>
                                        <input type="text" name="p_supply" placeholder="Product Supplier....."  class="form-control">
                                    </div>
                                    <div class="btn-sm text-end mt-4">
                                        <input type="submit" class="btn btn-secondary" class="mt-4" value="Add Product" name="add_p">
                                    </div>
                                    <?php
                                    if(isset($_POST["add_p"])){
                                        $p_name = $_POST["p_name"];
                                        $p_price = $_POST["p_price"];
                                        $p_qnt = $_POST["p_qnt"];
                                        $p_supply = $_POST["p_supply"];

                                        
                                        $addsql = "INSERT INTO product(`product_name`,`product_price`,`product_qnt`,`product_supplier`) VALUES('$p_name','$p_price','$p_qnt','$p_supply') ";
                                        $sql= mysqli_query($db,$addsql);
                                        if($sql){
                                            echo "<script>
                                            alert('New Product add!');
                                            window.location.href = 'product.php';
                                            </script>";
                                        }
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <table id="User_table" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Product Id</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Supplier</th>
                                            <th>Edit/delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php 
                                            $select = "SELECT * FROM `product` ";
                                            $sql = mysqli_query($db,$select);            
                                            while($row = mysqli_fetch_assoc($sql)){
                                                $id = $row["product_id"];
                                                $name = $row["product_name"];
                                                $price = $row["product_price"];
                                                $qnt = $row["product_qnt"];
                                                $supply = $row["product_supplier"];
                                            
                                            ?>
                                        <tr>
                                            <td><?php echo $id;?></td>
                                            <td><?php echo $name;?></td>
                                            <td><?php echo $price;?></td>
                                            <td><?php echo $qnt;?></td>
                                            <td><?php echo $supply;?></td>
                                            <td class="btn-group btn-sm">
                                                <a href="product.php?edit_id=<?php echo $id;?>" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i></a>
                                                <a href="" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#id<?php echo $id;?>"><i class="fa-solid fa-trash-can"></i></a>
                                            </td>
                                            <!-- modal here  -->                                       

                                            <!-- Modal -->
                                            <div class="modal fade" id="id<?php echo $id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            
                                                            <h5 class="modal-title" id="exampleModalLabel"> <strong class=" ">Are You Sure?</strong>  </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body"> 
                                                            <!-- modal body print  -->
                                                            <div class="row">
                                                                <div class="col-md-6 p-0">
                                                                    <ul style="list-style: none; border: 1px 1px solid; border-bottom: 1px solid #9999">
                                                                        <li style="border: 1px 1px solid; border-bottom: 1px solid #9999"> <strong>Product Id :</strong> </li>
                                                                        <li style="border: 1px 1px solid; border-bottom: 1px solid #9999"> <strong>Product Name : </strong> </li>
                                                                        <li style="border: 1px 1px solid; border-bottom: 1px solid #9999"> <strong>Product Quantity : </strong> </li>
                                                                        <li style="border: 1px 1px solid; border-bottom: 1px solid #9999"> <strong>Product Supplier : </strong> </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-6 p-0">
                                                                    <ul style="list-style: none; border: 1px 1px solid; border-left: 1px solid #9999; border-bottom: 1px solid #9999;" class="ps-0">
                                                                        <li class="ps-2" style="border: 1px 1px solid; border-left: 1px solid #9999; border-bottom: 1px solid #9999;"><?php echo $id;?></li>
                                                                        <li class="ps-2" style="border: 1px 1px solid; border-left: 1px solid #9999; border-bottom: 1px solid #9999;" ><?php echo $name;?></li>
                                                                        <li class="ps-2" style="border: 1px 1px solid; border-left: 1px solid #9999; border-bottom: 1px solid #9999;"><?php echo $qnt;?></li>
                                                                        <li class="ps-2" style="border: 1px 1px solid; border-left: 1px solid #9999; border-bottom: 1px solid #9999;"><?php echo $supply?></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- modal body print end  -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <a href="product.php?delete_id=<?php echo $user_id;?>" class="btn btn-info">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>                                
                                            </div>
                                            
                                        </tr>
                                        <?php }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

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