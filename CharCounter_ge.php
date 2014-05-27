<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

$dir = "TextsGeorgean/*";


$CountChars[" "]=1;

//այլ լեզուների համար $AlphabetChars մասիվը լցնել համապատասխան լեզվի այբուբենի տառերով 
$AlphabetChars = array("ა"=>0,
"ბ"=>0,
"გ"=>0,
"დ"=>0,
"ე"=>0,
"ვ"=>0,
"ზ"=>0,
"თ"=>0,
"ი"=>0,
"კ"=>0,
"ლ"=>0,
"მ"=>0,
"ნ"=>0,
"ო"=>0,
"პ"=>0,
"ჟ"=>0,
"რ"=>0,
"ს"=>0,
"ტ"=>0,
"უ"=>0,
"ფ"=>0,
"ქ"=>0,
"ღ"=>0,
"ყ"=>0,
"შ"=>0,
"ჩ"=>0,
"ც"=>0,
"ძ"=>0,
"წ"=>0,
"ჭ"=>0,
"ხ"=>0,
"ჯ"=>0,
"ჰ"=>0);

$StopChars=array(" ","·",",",".","1","2","3","4","5","6","7","8","9","0",")","(",")","[","-","	","a","t","n","o",".","i","I","]","r","s","\t","\n",".",";","l","„","“",".");


foreach(glob($dir) as $file) { //դիրեկտորիայի բոլոր ֆայլերի համար
    $fileHandle = fopen($file, "r");

    while (!feof($fileHandle)) {   // ֆայլի բոլոր տողերի համար

        $line = fgets($fileHandle);
	$currArray = mb_str_split($line);
	
	foreach($currArray as $char)
	{
		
		if(!in_array($char,$StopChars))
		{
			if(array_key_exists($char,$AlphabetChars))
			{
			  $CountChars[$char]++;
			}
		}
			
	}

	
    }
    fclose($fileHandle);
}


function mb_str_split( $string ) { 
    return preg_split('/(?<!^)(?!$)/u', $string ); 
} 

arsort($CountChars);

$sum=0;
foreach($CountChars as $key=>$value)
{
 $sum += $value;	
 
}


echo "<table>";
$j=1;
foreach($CountChars as $key=>$value)
{
 $perc = round($value/$sum,4);
 echo "<tr><td>".$j."</td><td>".$key."</td><td>[$perc]</td><tr>";	
 $j++;
}
echo "</table>";


//միայն թագքլոուդ սարքելու համար
/*
foreach ($CountChars as $key=>$value) {
	for($h=0;$h<=$value;$h=$h+10)
		echo $key." ";
}

?>
