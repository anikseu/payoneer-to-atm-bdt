<?php 


if (isset($_GET['amount'])){



$start = $_GET['amount'];



// Google Finance Integration 
function convertCurrency($amount, $from, $to){
	$data = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from&to=$to");
	preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
	$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
	return number_format(round($converted, 3),2);
}


$usd1 = convertCurrency($start, "BDT", "USD"); // converts input to USD

$usd2 = $usd1 + 3.15;  // Standard ATM Charge; 
$usd3 = $usd2 + ($usd2*3 / 100); // 3% Foreign Exchance Charge


if($usd3>5){

echo '<center><h2> Approximate USD Cost: ';
echo number_format($usd3, 2); 
echo '</h2> <br/><br/><a href="/payoneer">Try Again</a></center>'; 
} 





}
?> 