<?php 
error_reporting(0);

$change="";
$abc="";


 define ("MAX_SIZE","400");
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

 $errors=0;
  
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
 	$image =$_FILES["file"]["name"];
	$uploadedfile = $_FILES['file']['tmp_name'];
     
 
 	if ($image) 
 	{
 	
 		$filename = stripslashes($_FILES['file']['name']);
 	
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
		
		
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
		
 			$change='<div class="msgdiv">Unknown Image extension </div> ';
 			$errors=1;
 		}
 		else
 		{

 $size=filesize($_FILES['file']['tmp_name']);


if ($size > MAX_SIZE*1024)
{
	$change='<div class="msgdiv">You have exceeded the size limit!</div> ';
	$errors=1;
}


if($extension=="jpg" || $extension=="jpeg" )
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);

}
else if($extension=="png")
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);

}
else 
{
$src = imagecreatefromgif($uploadedfile);
}

echo $scr;

list($width,$height)=getimagesize($uploadedfile);


$newwidth=60;
$newheight=($height/$width)*$newwidth;
$tmp=imagecreatetruecolor($newwidth,$newheight);


$newwidth1=25;
$newheight1=($height/$width)*$newwidth1;
$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);


$filename = "images/". $_FILES['file']['name'];

$filename1 = "images/small". $_FILES['file']['name'];



imagejpeg($tmp,$filename,100);

imagejpeg($tmp1,$filename1,100);

imagedestroy($src);
imagedestroy($tmp);
imagedestroy($tmp1);
}}

}

//If no errors registred, print the success message
 if(isset($_POST['Submit']) && !$errors) 
 {
 
   // mysql_query("update {$prefix}users set img='$big',img_small='$small' where user_id='$user'");
 	$change=' <div class="msgdiv">Image Uploaded Successfully!</div>';
 }
 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<meta content="en-us" http-equiv="Content-Language">

    <title>picture demo</title>
    
   <link href=".css" media="screen, projection" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery_002.js"></script>
<script type="text/javascript" src="js/displaymsg.js"></script>
<script type="text/javascript" src="js/ajaxdelete.js"></script>
    
	 
  <style type="text/css">
  .help
{
font-size:11px; color:#006600;
}
body {
     color: #000000;
 background-color:#999999 ;
    background:#999999 url(<?php echo $user_row['img_src']; ?>) fixed repeat top left;
	
	
	font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif; 
	
	}
		.msgdiv{
	width:759px;
padding-top:8px;
padding-bottom:8px;
background-color: #fff;
font-weight:bold;
font-size:18px;-moz-border-radius: 6px;-webkit-border-radius: 6px;
}
#container{width:763px;margin:0 auto;padding:3px 0;text-align:left;position:relative; -moz-border-radius: 6px;-webkit-border-radius: 6px; background-color:#FFFFFF }
</style>

</head>
<body>
     <div align="center" id="err"><?php echo $change; ?></div>
   <div id="space"></div>

  <div id="container" >
   <div id="con">
        <table width="502" cellpadding="0" cellspacing="0" id="main">
          <tbody>
            <tr>
              <td width="500" height="238" valign="top" id="main_right">
			 
			  <div id="posts">
			  &nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $filename; ?>" />  &nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $filename1; ?>"  />
			    <form method="post" action="" enctype="multipart/form-data" name="form1">
				<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
               <tr><Td style="height:25px">&nbsp;</Td></tr>
		<tr>
          <td width="150"><div align="right" class="titles">Picture 
            : </div></td>
          <td width="350" align="left">
            <div align="left">
              <input size="25" name="file" type="file" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10pt" class="box"/>
			  
              </div></td>
			  
        </tr>
		<tr><Td></Td>
		<Td valign="top" height="35px" class="help">Image maximum size <b>400 </b>kb</span></Td>
		</tr>
		<tr><Td></Td><Td valign="top" height="35px"><input type="submit" id="mybut" value="       Upload        " name="Submit"/></Td></tr>
        <tr>
          <td width="200">&nbsp;</td>
          <td width="200"><table width="200" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="200" align="center"><div align="left"></div></td>
                <td width="100">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
				</form>
			  </div>
			  </td>
            </tr>
          </tbody>
     </table>
</div>   
  </div>
</body></html>
