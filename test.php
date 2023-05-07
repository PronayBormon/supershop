<?php


// fpdf page start here 
$pdf = new FPDF();
$pdf -> AddPage();

$pdf-> SetFont('Arial','B',10);

//first table title 
$pdf->cell(190,5,"Order Details : ",0,1);
// table start her e 
$pdf->cell(55,5,"Order Id ",1,0);
$pdf->cell(52,5,"Price",1,0);
$pdf->cell(25,5,"Quantity",1,0);
$pdf->cell(58,5,"Total",1,1);

//Order table title 
$pdf->cell(190,5,"Order Details : ",0,1);
// table start here 
$pdf->cell(55,5,"Name",1,0);
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

$pdf->Output();


$tex = ($sum/100)*10;
$serv = 100;
$ntamt = $tex+$serv+$sum;
?>