<?php

    /* Prevent Direct Access to this file */
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }

    class Router
    {
        private $path, $controller, $action;
        private $data = array();
        static $instance;

        public function __construct()
        {
            $request = '';
            if(isset($_GET['q']))
                $request = $_GET['q'];

            $split = explode('/',trim($request,'/'));
            $iCount = count($split);

            $this->controller = !empty($split[0]) ? ucfirst($split[0]) : 'Index';
            $this->action = !empty($split[1]) ? $split[1] : 'index';

            if ($iCount > 2) {
                for ($i = 0; $i < $iCount; $i++) {
                    if ($i > 1) {
                        array_push($this->data, $split[$i]);
                    }
                }
            }
        }

        public function route($registry)
        {
            $file = 'application/controllers/' . $this->controller . 'Controller.php';
            if (is_readable($file)) {
                include $file;
                $class = $this->controller . 'Controller';
            } else {
                include 'application/controllers/Error404Controller.php';
                $class = 'Error404Controller';
            }
            $controller = new $class($registry);

            if (is_callable(array($controller, $this->action))) {
                $action = $this->action;
            } else {
                array_unshift($this->data, $this->action); // Add the "action" to the URI data so it can be used later in the controller if need be
                $action = 'index';
            }

            $controller->$action($this->data);
        }
    }
