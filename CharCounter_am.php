<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

$dir = "TextsArmenian/*";


$CountChars[" "]=1;
$qanak = 0;
//այլ լեզուների համար $AlphabetChars մասիվը լցնել համապատասխան լեզվի այբուբենի տառերով 
$AlphabetChars = array("ա"=>0,
"բ"=>0,
"գ"=>0,
"դ"=>0,
"ե"=>0,
"զ"=>0,
"է"=>0,
"ը"=>0,
"թ"=>0,
"ժ"=>0,
"ի"=>0,
"լ"=>0,
"խ"=>0,
"ծ"=>0,
"կ"=>0,
"հ"=>0,
"ձ"=>0,
"ղ"=>0,
"ճ"=>0,
"մ"=>0,
"յ"=>0,
"ն"=>0,
"շ"=>0,
"ո"=>0,
"չ"=>0,
"պ"=>0,
"ջ"=>0,
"ռ"=>0,
"ս"=>0,
"վ"=>0,
"տ"=>0,
"ր"=>0,
"ց"=>0,
"ւ"=>0,
"փ"=>0,
"ք"=>0,
"և"=>0,
"օ"=>0,
"ֆ"=>0);


foreach(glob($dir) as $file) { //դիրեկտորիայի բոլոր ֆայլերի համար
    $fileHandle = fopen($file, "r");

    while (!feof($fileHandle)) {   // ֆայլի բոլոր տողերի համար

        $line = fgets($fileHandle);
	$currArray = mb_str_split($line);
	
	foreach($currArray as $char)
	{
			
			if(array_key_exists($char,$AlphabetChars))
			{

				$qanak++;
				$CountChars[$char]++;
			}
			
	}

	
    }
    fclose($fileHandle);
}


function mb_str_split( $string ) { 
    return preg_split('/(?<!^)(?!$)/u', $string ); 
} 


//ուղղում "ու" տառի համար

$CountChars["ո"]=$CountChars["ո"] - $CountChars["ւ"];

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
 echo "<tr><td>".$j."</td><td>".mb_strtoupper($key,"UTF8")." ".$key."</td><td>[$perc]</td><tr>";	
 $j++;
}
echo "</table>";


echo "<br>$qanak";

//միայն թագքլոուդ սարքելու համար
foreach ($CountChars as $key=>$value) {
	echo mb_strtoupper($key,"UTF8")."(".$key.");".$value."<br>";

}

//միայն թագքլոուդ սարքելու համար
/*
foreach ($CountChars as $key=>$value) {
	for($h=0;$h<=$value;$h=$h+100)
		echo mb_strtoupper($key,"UTF8")."(".$key.") ";
}
*/
?>
