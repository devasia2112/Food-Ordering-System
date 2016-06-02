<script type="text/javascript">alert("<?php echo $_SERVER[REQUEST_METHOD]; ?>");</script>

<?php
include '../../includes/config/config.php';
include '../../includes/Sql/sql.class.php';

session_start();

if ($_POST)
{
	// session image name
	//echo $_SESSION['product_image'];

	$code    = mysql_real_escape_string($_POST['code']);
	$price   = mysql_real_escape_string($_POST['price']);
	$coupom  = mysql_real_escape_string($_POST['coupom']);
	$name_ll = filter_var($_POST['name_ll'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$name_en = filter_var($_POST['name_en'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$desc_ll = filter_var($_POST['desc_ll'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$desc_en = filter_var($_POST['desc_en'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);

	if ( $_POST[chef] == "true" ) { $chef = 1; } else { $chef = 0; }

	try
	{
		// Insert table products
		mysql_query("INSERT INTO `products`(category_id, product_code, image, name, description, registered_in) VALUES('{$_POST[category]}', '{$code}', '{$_SESSION[product_image]}', '{$name_ll}', '{$desc_ll}', NOW())");
		$product_id = mysql_insert_id();

		// Insert table products atributes
		mysql_query("INSERT INTO `products_atributes`(product_id, atributes, recommended, product_size, price, cupom_discount_code) VALUES('{$product_id}', '{$_POST[spicy]}', '{$chef}', '{$_POST[size]}', '{$price}', '{$coupom}')");

		// Insert table products description (2 languages)
		mysql_query("INSERT INTO `products_description`(products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES('{$product_id}', '1', '{$name_ll}', '{$desc_ll}', '', '')");
		mysql_query("INSERT INTO `products_description`(products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES('{$product_id}', '2', '{$name_en}', '{$desc_en}', '', '')");

		// Define the size of the dish (product) in grams
		if ($_POST[size] == 1) $size = 350;
		elseif ($_POST[size] == 2) $size = 450;
		elseif ($_POST[size] == 3) $size = 550;
		else $size = 0;

		echo "Success!";

	}
	catch (Exception $e)
	{
		echo 'INSERT: empty: ',  $e->getMessage(), "\n";
		echo "Error";
	}
}
?>
