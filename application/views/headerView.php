<?php
    /**
     * headerView.php contains the view definition for the header / top
     * part of our application.
     * 
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    // Prevent Direct Access to this file
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= SITETITLE . "::" . $pageTitle ?></title>
    <?php 
        foreach($styles as $style) {
            echo '<link rel="stylesheet" href="' . $style . '" />';
        }
    ?>
</head>
<body>
    <header>
        <h1><?php echo SITETITLE ?></h1>
    </header>
