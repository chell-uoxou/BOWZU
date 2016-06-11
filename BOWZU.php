<?php
date_default_timezone_set('Asia/Tokyo');
$file_name = 'BOWZU_LOG.log';
if( !file_exists($file_name) ){
	touch( $file_name );
}
chmod( $file_name, 0666 );

$file_name = 'saves.log';
if( !file_exists($file_name) ){
	touch( $file_name );
}
$path = 'BOWZU_LOG.log';
chmod( $file_name, 0666 );
$logHandle = fopen($path,'a');
$divmode = false;
// $ini = parse_ini_file('config.ini');
// var_dump($ini);
// $path = dirname(__FILE__) . "\\" . "坊主が野原でサバを蒸す";
// if (!file_exists($path)) {
// 	mkdir($path);
// }
loadStrFiles("boot");
echo "\x1b[38;5;83m[SYSTEM]" . "\x1b[38;5;231mテキストファイルの再読み込みがしたい場合は、「reload」と入力してエンターしてください。" . PHP_EOL .
"\x1b[38;5;83m[SYSTEM]\x1b[38;5;231m気に入った作品があれば、「save」と入力するとsaves.logに保存されます！" . PHP_EOL .
"\x1b[38;5;83m[SYSTEM]\x1b[38;5;231m終了時は「exit」と入力してください。" . PHP_EOL .
"\x1b[38;5;214m＝＝＝＝＝＝＝＝＝＝エンターキーで更新＝＝＝＝＝＝＝＝＝\x1b[38;5;231m" . PHP_EOL;
///////////////////
////////////
// for ($i=0; $i < $dokode_cnt; $i++) {
// 	echo $dokode[$i] . ":";
// 	$ichi = $dokode[$i]{0};
// 	echo $ichi . PHP_EOL;
// 	if ("#" == $ichi) {
// 		unset($dokode[$i]);
// 		var_dump($dokode);
// 		array_merge($dokode[$i]);
// 		$var_dump($dokode);
// 	}
// }

/////////////
$a = "";
while (true) {
	if ($a == "reload") {
		loadStrFiles("reload");
	}
	if ($a == "save") {
		saveStr($mozi);
	}
	if ($a == "exit") {
		exit;
	}
	$rand1 = rand(0, $darega_cnt - 1);
	$rand2 = rand(0, $dokode_cnt - 1);
	$rand3 = rand(0, $naniwo_cnt - 1);
	$rand4 = rand(0, $dousuru_cnt - 1);
	$dare = trim($darega[$rand1]);
	$doko = trim($dokode[$rand2]);
	$nani = trim($naniwo[$rand3]);
	$dou = trim($dousuru[$rand4]);
	if ($divmode == True) {
		echo $rand1 . "," .$rand2 . "," . $rand3 . "," . $rand4 . "\n";
	}
	$mozi = $dare . "が" . $doko .  "で" . $nani . "を" . $dou . PHP_EOL;
	echo "\x1b[38;5;87m[BOWZU]\x1b[38;5;227m" . $mozi . ">";
	$pr_time = date('A-H:i:s');
	$prompt = PHP_EOL . "[{$pr_time}]";
	if (isset($logHandle)){
		fwrite($logHandle,"{$prompt} [BOWZU]" . trim($mozi));
	}
	$a = trim(fgets(fopen("php://stdin", "r")));
}














function loadStrFiles($tipe){
	if ($tipe == "reload") {
		echo "\x1b[38;5;83m[SYSTEM]" . "File reloading now..." . PHP_EOL;
	}
	global $darega;
	global $dokode;
	global $naniwo;
	global $dousuru;
	global $darega_cnt;
	global $dokode_cnt;
	global $naniwo_cnt;
	global $dousuru_cnt;
	$darega_file = trim(file_get_contents(dirname(__FILE__) . "\\" . "darega.txt"));
	$darega = explode("\n", $darega_file);
	$darega_cnt = count($darega);
	$first_darega = trim($darega[0]);
	echo "\x1b[38;5;83m[SYSTEM]\x1b[38;5;231m" . "darega.txtを読み込みました。:";
	echo "\"" . $first_darega . "\"から\"" . $darega[$darega_cnt - 1] . "\"までの" . $darega_cnt . "個の単語。\n";
	$dokode_file = trim(file_get_contents(dirname(__FILE__) . "\\" . "dokode.txt"));
	$dokode = explode("\n", $dokode_file);
	$dokode_cnt = count($dokode);
	$first_dokode = trim($dokode[0]);
	echo "\x1b[38;5;83m[SYSTEM]\x1b[38;5;231m" . "dokode.txtを読み込みました。:";
	echo "\"" . $first_dokode . "\"から\"" . $dokode[$dokode_cnt - 1] . "\"までの" . $dokode_cnt . "個の単語。\n";
	$naniwo_file = trim(file_get_contents(dirname(__FILE__) . "\\" . "naniwo.txt"));
	$naniwo = explode("\n", $naniwo_file);
	$naniwo_cnt = count($naniwo);
	$first_naniwo = trim($naniwo[0]);
	echo "\x1b[38;5;83m[SYSTEM]\x1b[38;5;231m" . "naniwo.txtを読み込みました。:";
	echo "\"" . $first_naniwo . "\"から\"" . $naniwo[$naniwo_cnt - 1] . "\"までの" . $naniwo_cnt . "個の単語。\n";
	$dousuru_file = trim(file_get_contents(dirname(__FILE__) . "\\" . "dousuru.txt"));
	$dousuru = explode("\n", $dousuru_file);
	$dousuru_cnt = count($dousuru);
	$first_dousuru = trim($dousuru[0]);
	echo "\x1b[38;5;83m[SYSTEM]\x1b[38;5;231m" . "dousuru.txtを読み込みました。:";
	echo "\"" . $first_dousuru . "\"から\"" . $dousuru[$dousuru_cnt - 1] . "\"までの" . $dousuru_cnt . "個の単語。\n";
	if ($tipe == "reload") {
		echo "\x1b[38;5;83m[SYSTEM]\x1b[38;5;231m" . "Reload completed!" . PHP_EOL;
	}
	global $savesHandle;
	$savespath = "saves.log";
	$savesHandle = fopen($savespath,'a');
	// var_dump($savesHandle);
}

function saveStr($str){
	global $savesHandle;
	global $prompt;
	global $pr_time;
	$pr_time = date('A-H:i:s');
	$prompt = PHP_EOL . "[{$pr_time}]";
	if (isset($savesHandle)){
		  fwrite($savesHandle,"{$prompt}" . trim($str));
  }
	echo "\x1b[38;5;83m[SYSTEM]\x1b[38;5;231m" . trim("「" . trim("{$prompt} {$str}") . "」を保存しました。") . PHP_EOL;
	///ログを吐く
}
