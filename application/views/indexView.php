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

    <div class="hero-unit">
        <h1>Starter Template</h1>
        <p>Use this as a way to quick start any new CrowdControl RMVC project. 
        All you get is this message and an awesome PHP framework.</p>
    </div>
    
    <div class="row">
        <div class="span4">
            <h2>RMVC</h2>
            <p>CrowdControl is an RMVC framework. RMVC stands for:</p>
            <ul>
                <li>Repository</li>
                <li>Model</li>
                <li>View</li>
                <li>Controller</li>
            </ul>
        </div>
        <div class="span4">
            <h2>PHP</h2>
            <p>CrowdControl was built in PHP. Many people knock PHP as an 
            out-of-date language and not well suited to todays problems. 
            I dissagree. The major problem with PHP is vast sea of bad code
            and tutorials that exist. CrowdControl was built as I was (and still am)
            learning the very BEST way to write PHP.</p>
        </div>
        <div class="span4">
            <h2>MySQL</h2>
            <p>CrowdControl has MySQL support out of the box. However, support
            for more database engines is planned.</p>
        </div>
    </div>
