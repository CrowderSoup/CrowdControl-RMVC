<?php
    /**
     * Request.php contains the Request class
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    /**
     * Request class
     * 
     * This is a catchall class that holds data. It allows you to pass things
     * from config, the router, etc. into your controllers.
     */
    class Request
    {
        /**
         * @var array Holds all the data passed into the $_GET superglobal
         */
        public $GET = array();
        
        /**
         * @var array Holds all the data passed into the $_POST superglobal
         */
        public $POST = array();
        
        /**
         * @var array Holds all the data passed into the $_FILES superglobal
         */
        public $FILES = array();
        
        /**
         * @var array Holds all the data passed into the $_REQUEST superglobal
         */
        public $REQUEST = array();
        
        /**
         * @var array Holds all the data passed into the $_COOKIE superglobal
         */
        public $COOKIE = array();

        function __construct()
        {
        	foreach($_GET as $key => $val) {
        		$this->GET[$key] = strip_tags($val);
        	}

        	foreach($_POST as $key => $val) {
        		$this->POST[$key] = strip_tags($val);
        	}

        	foreach($_REQUEST as $key => $val) {
        		$this->REQUEST[$key] = strip_tags($val);
        	}

        	foreach($_FILES as $key => $val) {
        		$this->FILES[$key] = $val;
        	}

        	foreach ($_COOKIE as $key => $val) {
        		$this->COOKIE[$key] = $val;
        	}
        }
    }
