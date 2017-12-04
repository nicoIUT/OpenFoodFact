<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
    <title><?php echo $title; ?></title>

    <main>
        <?php $this->load->view($content); ?>
    </main>
</html>
