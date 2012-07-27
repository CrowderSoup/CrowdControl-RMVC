<?php

    /***************************************************************************
    * System Constants                                                         *
    *                                                                          *
    * Use of system constants should be limited to things that need a global   *
    * scope. In all other cases variables should be used in the interest of    *
    * performance.                                                             *
    ***************************************************************************/

    // Set the basepath (the base filesystem path of the application)
    const BASEPATH = '/home/aaron/Sites/CrowdControlMVC/';

    // Set the base uri (the root URL of the application)
    const BASEURI = 'http://crowdcontrol.loc/';

    // The title of the site
    const SITETITLE = 'CrowdControl MVC';

    /***************************************************************************
    * System variables                                                         *
    ***************************************************************************/

    // Array of required Utils
    $utils = array('Database', 'util');

    //Database properties
    $database = array (
        'host'      => '127.0.0.1',
        'database'  => 'CrowdControlMVC',
        'user'      => 'root',
        'password'  => 'p@ssw0rd'
    );
