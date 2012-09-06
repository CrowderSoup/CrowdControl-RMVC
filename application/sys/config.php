<?php
    /**
     * config.php contains the basic configuration settings for the framework.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */

    // Prevent Direct Access to this file
    if (!defined('BASEPATH')) {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }

    /**
     * System Constants
     * 
     * Use of system constants should be limited to things that need a global
     * scope. In all other cases variables should be used in the interest of
     * performance.
     */

    /**
     * @const string Set the basepath (the base filesystem path of the application)
     */
    const BASEPATH = '/home/aaron/Sites/CrowdControlMVC/';
    
    /**
     * @const string Set the base uri (the root URL of the application)
     */
    const BASEURI = 'http://crowdcontrol.loc/';
    
    const BASECSSURI = 'http://crowdcontrol.loc/public/css/';
    const BASEJSURI = 'http://crowdcontrol.loc/public/js/';
     
    /**
     * @const string The title of the site
     */
    const SITETITLE = 'CrowdControl MVC';
    
    /**
     * @const string The main controller
     */
    const INDEXCONTROLLER = 'Index';
    
    /**
     * @const string The main action
     */
    const INDEXACTION = 'index';

    /**
     * System variables
     * 
     * System variables are used in the interest of performace and are passed
     * to the controllers that need them via the registry object.
     */
    
    /**
     * @var array Array of the required Utils
     */
    $utils = array('Database', 'util');
    
    /**
     * @var array Database properties
     */
    $database = array (
        'host'      => '127.0.0.1',
        'database'  => 'CrowdControlMVC',
        'user'      => 'root',
        'password'  => 'p@ssw0rd'
    );
    
    /**
     * @var array All the Stylesheets that should be included in the header of
     * our application.
     */
    $styles = array(BASECSSURI . 'bootstrap.min.css', BASECSSURI . 'bootstrap-responsive.min.css', BASECSSURI . 'style.css');
    
    $js = array(BASEJSURI . 'bootstrap.min.js');
