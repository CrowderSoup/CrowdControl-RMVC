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

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
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
                                                    ($loggedIn ? 'Logout' : 'Login') => array('login',
                                                                     ($loggedIn ? 'logout' : 'index')),
                                                    '404' => array('test-404',
                                                                    'index')), $request->GET['Controller']) ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <div class="container">
