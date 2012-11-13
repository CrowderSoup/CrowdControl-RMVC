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
            $actionIndex = 0;

            $controller = null;
            $action = null;
            $dir = '';

            foreach ($gData as $key => $value) {
                if(is_dir('application/controllers/' . $value)) {
                    $dir .= $value . '/';
                    continue;
                } elseif (is_readable('application/controllers/' . $dir . ucfirst($value) . 'Controller.php')) {
                    $controller = ucfirst($value);

                    $actionIndex = $key + 1;
                    $action = $gData[$actionIndex];
                    break;
                }
            }
            $this->GET['Controller'] = ($controller != null) ? $controller : INDEXCONTROLLER;
            $this->GET['Action'] = ($action != null) ? $action : INDEXACTION;
            $this->GET['Dir'] = $dir;

            for($i = $actionIndex + 1; $i < $iCount; $i++) {
                $this->GET['gData_' . ($i)] = $gData[$i];
            }
        }
    }
