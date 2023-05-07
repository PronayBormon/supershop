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
<div class="content-wrapper">
    <form action="" method="post">
        <div class="card m-2">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <div style="width: 30%;"><img src="images/logo.png" class="img-fluid" alt=""></div>
                    </div>
                    <div class="col-md-8">
                        <div style="width: 70%;border-top:2px solid #000;">
                            <h2>Online Sell center </h2>
                            <p class="mb-0">Purches Summary </p>
                            <p class="mt-1">Best rate </p>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="card-body">
                
                <?php
                $order_id = rand(0,99999999);
                "<br>";
                $invoice_id = rand(0,99999);
                // get date 
                // $mydate=getdate(date("U"));
                $date=getdate(date("U"));
                $today = "$date[weekday], $date[month] $date[mday], $date[year]";

                // $today = $date[weekday]


                
                echo $today;
                ?>
                <!-- Order Details table start here  -->
                <h4>Order Details :</h4>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col"> </th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Order Id : </th>
                            <td><?php echo $order_id;?></td>
                            <th>Order Date</th>
                            <td><?php echo $today;?></td>
                        </tr>
                        <tr>
                            <th>Invoice Id : </th>
                            <td><?php echo $invoice_id;?></td>
                            <th>Pay By </th>
                            <td>
                                <select name="payby" id="" class="form-control">
                                    <option selected value="1">Cash</option>
                                    <option value="2">Card</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Bill To (Name) : </th>
                            <td><input type="text" name="name" autocomplete="off" value="" required class="form-control"></td>
                            <th>Phone : </th>
                            <td><input type="text" name="number" value="+880" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>
                <!-- order details table end here  -->

                <!-- Order items table start here  -->
                <h4 class="mt-5">Order Details :</h4>
                
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col"> Product Id</th>
                        <th scope="col">Product Name </th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Product Price </th>                    
                        <th scope="col">Paid Price </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sum=0;
                    foreach($_SESSION["cart"] as $key => $value){
                        $pname = $value['productName'];
                        $id = $value['pid'];
                        $price = $value['productPrice'];
                        $Qnt = $value['productQnt'];
                        $total = $price * $Qnt; 
                        $sum = $sum+$total;?>
                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $pname;?></td>
                            <td><?php echo $Qnt;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $total;?></td>
                        </tr>
                        <?php   
                    }
                        $tex = ($sum/100)*10;
                        $serv = 100;
                        $ntamt = $tex+$serv+$sum; ?>

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-4 ms-auto text-end">
                    <strong>Subtotal : <?php echo $sum;?> TK</strong> <br>                           
                    <strong>Service Charge : <?php echo $serv;?> TK</strong>    <br>               
                    <strong>( 10% )Tax : <?php echo $tex;?> TK</strong><br>               
                    <strong>Net Ammount : <?php echo $ntamt;?> TK</strong><br>
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-5">
            <div class="col-md-3 m-auto text-center ">
            <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </div>
        <?php
        if(isset($_POST["submit"])){

            $name = $_POST["name"];            
            $phone = $_POST["number"];       
            $payby = $_POST["payby"];
            $_SESSION['cst'][] = array('cname'=>$name,'number'=>$phone,'payby'=>$payby,'order_id'=>$order_id,'invoice_id'=>$invoice_id,'date'=>$today); 
            // ===================order array print here ===============================
            foreach($_SESSION["cst"] as $k => $v){

                $cname      = $v['cname'];
                $number     = $v['number'];
                $payby      = $v['payby'];
                $Order      = $v['order_id'];
                $invoice    = $v['invoice_id'];
                $date       = $v['date'];
                
            }
            
            // =================Product cart array print here ==============
            $sum = 0;
            foreach($_SESSION["cart"] as $key => $value){
                $pro_name = $value['productName'];
                $id = $value['pid'];
                $price = $value['productPrice'];
                $Qnt = $value['productQnt'];
                $total = $price * $Qnt; 
                $sum = $sum+$total;

            }
            // Order table end 


            // total equation part start here 
            $tex = ($sum/100)*10;
            $serv = 100;
            $ntamt = $tex+$serv+$sum;          
            // unset($_SESSION['cst']);
            // unset($_SESSION['cart']);
            // ========================== database sql ==========================
            $insert = "INSERT INTO `order`(`order_id`, `invoice_id`, `name`, `phone`, `paywith`, `net_amt`, `date`) VALUES ('$Order','$invoice','$cname','$number','$payby','$ntamt',now() )";
            $sql = mysqli_query($db,$insert);
            if($sql){
                header("location:pdf.php");
            }else{
                echo "sothing wrong";
            }
        }
        ?>
    </form>
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