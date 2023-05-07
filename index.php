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
      <!-- wrapper part start here  -->
      <div class="content-wrapper"> 
        <div class="card mx-2">
          <div class="card-header d-flex ">
            <div><h2><i class="fa-solid fa-cart-shopping"></i> Sell Product page</h2></div>
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
            <p><i class="fa-solid fa-cart-shopping"></i>Selected Items</p>
              <div class="row">
                <div class="col-md-8 m-auto">
                  <div class="card">
                    <div class="card-header text-center">
                      Customer Shooping cart

                      <!-- ==========================cart read part start here ========================== -->
                    </div>
                    <div class="card-body">
                      
                      <ul><?php
                      // print_r($_SESSION['cart']);
                        if(isset($_SESSION['cart'])){       
                          $sum = 0;                   
                          foreach($_SESSION["cart"] as $key => $value){
                              $pname = $value['productName'];
                              $id = $value['pid'];
                              $price = $value['productPrice'];
                              $Qnt = $value['productQnt'];
                              $key;
                            ?>
                            <li class="d-flex justify-content-between border p-2 m-1" style="list-style: none;">

                              <?php 
                              $total = $price * $Qnt;
                               $sum = $sum + $total;
                               
                              echo "<br>";
                               
                              
                              ?> 

                              <strong><?php echo $pname?></strong> <span> Quantity : <?php echo $Qnt?></span><span> Price : <?php echo $price?></span> <span>Total : <?php echo $total;?></span>
                              
                              <form action="insertcart.php" method="post">
                                <input type="hidden" name="p_name" value="<?php echo $pname?>">
                                <input type="submit" name="remove" value="Remove">
                              </form>
                              
                            </li>
                          <?php
                          }
                        }
                        ?>
                      </ul>
                      
                      <!-- ==================================== cart read part end here =============================================== -->
                    </div>
                    <!-- check out part start here  -->
                    <div class="card-footer ">
                      <div class="row">
                        <div class="col-md-2 ms-auto">
                          <form action="checkout.php" method="POST" >
                            <input type="submit" value="Checkout" class="btn btn-secondary form-control" name="check">
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- check out part end here  -->
                  </div>
                </div>
              </div>      
          </div>
          <div class="card-footer" >
            <!-- product table start here  -->
            
            <div class="card">
              <div class="card-header d-flex justify-content-center">
                <p>Product list</p> 
                <input type="text" class="m-auto" placeholder="search...." id="live_search" autocomplete="off">                                   
                  
              </div>
              
              <!-- search result here  -->
              <div id="search_result"></div>
              <div class="card-body" id="product">
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
              
                <div class="row">
                  <div class="col-md-6 m-auto">
                  <form action="insertcart.php" method="post">
                    <div class="card">
                      <div class="card-header bg bg-secondary bg-gradient"><label for="" class=" "><?php echo $name;?></label></div>
                      <div class="card-body"><h6>Price : <?php echo $price;?> TK</h6>    
                      <input type="number" class="form-control" placeholder="Add Quantity" name="pqnt" value="1">
                      <input type="hidden" value="<?php echo $name;?>" name="pname">
                      <input type="hidden" value="<?php echo $price?>" name="pprice">
                      <input type="hidden" value="<?php echo $id?>" name="pid">
                      
                      
                      </div>
                      
                      <div class="card-footer bg bg-secondary bg-gradient"><button class=" " name="cart">Add</button></div>
                    </div>

                  </form> 
                  </div>
                </div>    
                
                <?php }?>
              </div>
            </div>
            <!-- product table end here  -->        
          </div>
        </div>
      </div>
    
<?php
include("footer.php");
  }else{
    header("location:login.php");

  }
?>