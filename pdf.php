<?php
include("db.php");
// session_start();
require('fpdf/fpdf.php');

// fpdf page start here 
$pdf = new FPDF();
$pdf -> AddPage();

$pdf-> SetFont('Arial','B',10);

//first table title 
$pdf->cell(190,5,"Order Details : ",0,1);


foreach($_SESSION["cst"] as $k => $v){

    $cname      = $v['cname'];
    $number     = $v['number'];
    $payby      = $v['payby'];
    $Order      = $v['order_id'];
    $invoice    = $v['invoice_id'];
    $date       = $v['date'];
    
    $pdf->SetDrawColor(188,188,188);
    $pdf->cell(55,5,"Name :$cname",1,0);
    $pdf->cell(62,5,"Number :$number",1,0);
    $pdf->cell(25,5,"Pay with :$payby",1,0);
    $pdf->cell(48,5,"Order id :$Order",1,1);

    $pdf->cell(55,5,"Invoice id :$invoice",1,1);
    $pdf->SetDrawColor(188,188,188);
}

//Product table title 
$pdf->cell(190,5,"Product Details : ",0,1);
// table start here 
$pdf->cell(55,5,"Product Name",1,0);
$pdf->cell(52,5,"Price",1,0);
$pdf->cell(25,5,"Quantity",1,0);
$pdf->cell(58,5,"Total",1,1);
$sum = 0;
foreach($_SESSION["cart"] as $key => $value){
    $pro_name = $value['productName'];
    $id = $value['pid'];
    $price = $value['productPrice'];
    $Qnt = $value['productQnt'];
    $total = $price * $Qnt; 
    $sum = $sum+$total;
    
    $pdf->cell(55,5,"$pro_name",1,0);
    $pdf->cell(52,5,"$price",1,0);
    $pdf->cell(25,5,"$Qnt",1,0);
    $pdf->cell(58,5,"$total",1,1);  
    

}
// Order table end 


// total equation part start here 
$tex = ($sum/100)*10;
$serv = 100;
$ntamt = $tex+$serv+$sum;

$pdf->cell(190,10,"",0,1);  
$pdf->cell(190,5,"Total : $sum",0,1,'R');  
$pdf->cell(190,5,"Service charge : $serv",0,1,'R');  
$pdf->cell(190,5,"tax : $tex",0,1,'R'); 
$pdf->cell(190,5,"Total pay : $ntamt",0,1,'R');   

$pdf->cell(190,10," ",0,1,'L');   
$pdf->cell(190,5,"Signature",0,1,'R');   
// total equation part end here 


$pdf->Output();
unset($_SESSION['cst']);

unset($_SESSION['cart']);






?>