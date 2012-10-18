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
            $this->GETData();

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

            unset($_GET, $_POST, $_REQUEST, $_FILES);
        }

        private function GETData()
        {
            $request = '';
            if(isset($_GET['request']))
                $request = $_GET['request'];

            $gData = explode('/',trim($request,'/'));
            $iCount = count($gData);

            $this->GET['Controller'] = !empty($gData[0]) ? ucfirst($gData[0]) : INDEXCONTROLLER;
            $this->GET['Action'] = !empty($gData[1]) ? $gData[1] : INDEXACTION;

            for($i = 2; $i < $iCount; $i++) {
                $this->GET['gData_' . ($i - 2)] = $gData[$i];
            }
        }
    }
