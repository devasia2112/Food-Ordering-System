<?php
session_start();
$session_id='1'; //$session id
$path = "../../images/logo/";
include('../../includes/config/config.php');

$valid_formats = array("jpg", "png", "gif", "bmp");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
	$name = $_FILES['photoimg']['name'];
	$size = $_FILES['photoimg']['size'];
	
	if(strlen($name))
	{
		list($txt, $ext) = explode(".", $name);
		if(in_array($ext,$valid_formats))
		{
			if($size<(1024*1024))
			{
				$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
				$tmp = $_FILES['photoimg']['tmp_name'];
				if(move_uploaded_file($tmp, $path.$actual_image_name))
				{
					echo "<img src='../../images/logo/".$actual_image_name."'  class='preview'>";
					$_SESSION['product_image'] = $actual_image_name;		// create a session with the image name

                    if (isset($_SESSION['product_image']))
                    {
                        $res = mysql_query("UPDATE `empresa` SET `logotipo` = '$_SESSION[product_image]' WHERE `id` = '$_SESSION[empresa_id]'") or die("Erro Update Logotipo!");
                        unset($_SESSION['product_image']);
                        unset($_SESSION['empresa_id']);
                    }

				}
				else
				{
					echo "failed";
				}
			}
			else
			{
				echo "Image file size max 1 MB";
			}
		}
		else
		{
			echo "Invalid file format..";
		}
	}
	else
	{
		echo "Please select image..!";
	}
	exit;
}
?>
