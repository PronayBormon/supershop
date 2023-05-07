<?php
include("db.php");
include("header.php");
include("sidebar.php");
?>

<div class="content-wrapper">
    <div class="card m-2">
        <div class="card-header">
            All order 
        </div>
        <div class="card-body">
            <table id="User_table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Invoice Id </th>
                        <th>Client Name</th>
                        <th>Phone Number</th>
                        <th>Pay with </th>
                        <th>Net ammount</th>
                        <th>Date</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php
                    $select= "SELECT * FROM `order`";
                    $sql = mysqli_query($db,$select);
                    while( $row = mysqli_fetch_assoc($sql)){

                        $order_id   = $row['order_id'];
                        $invoice_id = $row['invoice_id'];
                        $name       = $row['name'];
                        $phone      = $row['phone'];
                        $pay_with   = $row['paywith'];
                        $amt        = $row['net_amt'];
                        $date       = $row['date'];
                    
                    ?>
                    <tr>
                        <td><?php echo $order_id;?> </td>
                        <td><?php echo $invoice_id;?> </td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $phone;?></td>
                        <td><?php if($pay_with==1){echo '<p class="badge badge-secondary">Cash</p>';}else{echo '<p class="badge badge-secondary">Card</p>';} ;?></td>
                        <td><?php echo $amt;?></td>
                        <td><?php echo $date;?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>