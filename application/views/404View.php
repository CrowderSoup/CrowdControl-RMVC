<?php
    /**
     * Error404View.php contains the view definition for our 404
     * controller.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    // Prevent Direct Access to this file
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
?>

<article>
    <h3>404</h3>
    <p>Uh oh, looks like you've torn a whole in the internet!</p>
    <img src="<?= BASEIMGURI . '404error.jpg' ?>" alt="404 Code" />
</article>