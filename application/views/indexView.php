<?php
    /**
     * indexView.php contains the view definition for our main
     * controller / action.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    // Prevent Direct Access to this file
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
?>

<div class="container">

    <h1>Starter template</h1>
    <p>Use this document as a way to quick start any new project.<br> All you get is this message and a barebones PHP framework.</p>

</div> <!-- /container -->
