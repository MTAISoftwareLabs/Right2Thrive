<?php 

require_once 'vzaar/Vzaar.php';
Vzaar::$token = "F5g7Lt3pgKDIxYwjoGQ2rPOvyVYRn9ctt1inRCgPqec";
Vzaar::$secret = "CareerPathsOnline";

$Vl = Vzaar::getVideoList('CareerPathsOnline', true, 20);
 $i=1;echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
  ";

 ?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<style type="text/css">
#uploadCntr,#uploadvideos{border: 1px solid rgb(232, 232, 232);border-radius: 5px;padding-left: 50px;}#uploadvideos{height:auto;padding: 50px;padding-top: 30px;}.vtitle{background-color: #eee;border: 1px solid rgb(232, 232, 232);border-radius: 5px;padding: 5px;color:#444;font-size: 20px;font-weight: 700;font-family: 'Roboto Slab', serif;}#ttl{width: 250px;height: 39px;border-radius: 10px;border-color:rgb(214, 214, 214);margin-bottom:10px;padding: 0 10px;}
</style>

<div id="uploadvideos">
<div id="videosl" style="width:546px;height:auto;">
<?php

foreach ($Vl as $video){
if (strpos($video->title,'-Aproved') !== false) { 
$ttl=$video->title;
$textt = str_replace("-Aproved", " ", $ttl);
  
echo'<h1 class="vtitle">'.$textt.'</h1><video width="545" poster='.$video->thumbnail.' preload="none" controls><source src=' . $video->url . '  /></video>';
}	
$i++;
}

?>



</div>
</div>
</br>
<div id="uploadCntr">
</script><link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/redmond/jquery-ui.css">
<script type="text/javascript" src="../../vzaar/s3_upload.js"></script><script type="text/javascript" src="../../vzaar/s3_kp.js"></script><input id="key" name="key" type="hidden"/><input id="orginal_filename" name="original_filename" type="hidden"/>
    <input id="encoding" name="encoding" type="hidden" value="true"/> <label class='videoFileStep'>Upload Video</label> <br/>

<div class="input-group">
    <input type="text" class="form-control" placeholder="title" value="" id='ttl'name="ttl">
  </div>

<div id="s3_swf1">
        Please <a href="http://www.adobe.com/go/getflashplayer">Update</a> your Flash Player to Flash v.10.0 or
        higher...
</div><br/>
<a class="btn btn-default" id="uploadButton">Upload</a>&nbsp;&nbsp;<span class="ui-state-highlight ui-corner-all" style="padding: 0 3px;"><input type="checkbox" id="customUpload"/> Use custom settings (width: 256, bitrate: 256)</span>
    <br/>
    <small><span id="status"></span></small>
</div>