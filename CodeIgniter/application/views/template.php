<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
    </head>

    <body>
        <?php $this->load->view($content); ?>
    </body>
</html>
