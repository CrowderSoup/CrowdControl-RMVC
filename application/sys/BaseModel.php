<?php
    /**
     * BaseModel.php contains the abstract class definition for our
     * models.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */

    // Prevent Direct Access to this file
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
    
    /**
     * BaseModel class
     * 
     * This class should contain things that will be commonly used by all of
     * our models throughout the application. <strong>If this isn't the 
     * case, then it doesn't belong here.</strong>
     */
    abstract class BaseModel
    {
        function __construct() { }
        function __clone() { }
    }
