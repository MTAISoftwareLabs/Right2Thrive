<?php
@set_time_limit(0);
@error_reporting(E_ALL | E_NOTICE);

if(!$argv[1] or !$argv[2]){

print_r("
================================================================================
USAGE : php shell.php [IP] [FILENAME]
Ex    : php shell.php 127.0.0.1 shell.txt

================================================================================
");
die();

}


function check_url($url,$filename){ // By DR.THMOORY 
$site = @get_headers($url);
if (eregi('200', $site[0])){
echo "[+] Found :D -> $url\n";
$rr=fopen($filename,"a+");
fwrite($rr,$url."\n");
}
else{ echo "[~] Not Found :D-> $url\n"; }
}

function php_scan($site,$filename1){ // By DR.THMOORY 
$phps = array("C99","r57","sniper","shell","snperegy","shellzaZ","mailer","c99","r57","cc99","c99ud","bypass","safe0ver");
foreach($phps as $php){
$rs = "$site$php.php";
check_url($rs,$filename1);
}}

function mystripos($haystack, $needle){
    return strpos($haystack, stristr( $haystack, $needle ));
	}
	
function sec($ent)
{
$bb = str_replace("http://", "", $ent);
$cc = str_replace("www.", "", $bb);
$dd = substr($cc, 0, mystripos($cc, "/"));
return $dd;
}
$npages = 50000;

  $npage = 1;
  $allLinks = array();
				$ip = $argv[1];
		
  while($npage <= $npages) 
  { 
	$ch = curl_init();
                                
	curl_setopt($ch, CURLOPT_URL, 'http://www.bing.com/search?q=ip%3A' . $ip . '&first=' . $npage);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_REFERER, 'http://www.bing.com/');
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8');
 
	$result['EXE'] = curl_exec($ch);
	$result['ERR'] = curl_error($ch);
 
	curl_close($ch);
 
	if ( empty( $result['ERR'] ) )
	{
		preg_match_all('(<div class="sb_tlst">.*<h3>.*<a href="(.*)".*>(.*)</a>.*</h3>.*</div>)siU', $result['EXE'], $findlink);
		for ($i = 0; $i < count($findlink[1]); $i++)
		array_push($allLinks,sec($findlink[1][$i]));


		$npage = $npage + 10;
		if (preg_match('(first=' . $npage . '&amp)siU', $result['EXE'], $linksuiv) == 0) 
			break;			   
	}
    else
		break;
  }

$allDmns = array();



	foreach ($allLinks as $kk => $vv){
	$allDmns[] = $vv;
	}
	$resultPages = array_unique($allDmns);
	sort($resultPages) ;
	
print_r("
================================================================================
                           search shell via server tool..
                           (c)oded By DR.THMOORY
                           SiTe:sec4ever.com|vbspiders.com
						  
								
================================================================================
");

for ($x = 0; $x < count($resultPages); $x++){
$h3h3 = $resultPages[$x];
php_scan("http://".$h3h3."/",$argv[2]);
}

print_r("
================================================================================
            INFO / IP : ".$ip." / Domine ScaNNed : ".count($resultPages)."
		   
		                 FINISHED:)
							 
================================================================================
");
?>