<?php
    /**
     * config.php contains the basic configuration settings for the framework.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */

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
     
    /**
     * @const string The title of the site
     */
    const SITETITLE = 'CrowdControl MVC';

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
