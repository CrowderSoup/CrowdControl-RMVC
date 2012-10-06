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
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#">CrowdControl RMVC</a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <?= Nav::BuildMainNav(array(
                                                    'Home' => array('index', 
                                                                    'index'), 
                                                    'Login' => array('login',
                                                                     'index'),
                                                    'test' => array('test',
                                                                    'index')), $URIdata) ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <div class="container">
