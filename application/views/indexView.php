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

<article>
    <h3>A Simple Site</h3>
    
    <p>A simple site to test and play with.</p>
</article>
