<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
	<?php echo print_r($product) ?>
	<h1><?php echo $product['product']['product_name']?></h1>
	<h2><?php echo $product['product']['brands'] ?></h2>
</html>
