<?php
    /**
     * View.php contains the View class
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */

    // Prevent Direct Access to this file
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
    
    /**
     * View class
     * 
     * The View class actually displays the content of our application. It takes
     * data that was given to it via the Controller->Action and provides that 
     * data to the view itself.
     */
    class View
    {
        /**
         * @var array Contains all the data that needs to be passed from the
         * controller to our View.
         */
        private $vars = array();
        
        /**
         * __set($index, $value)
         * 
         * Puts data in the $vars array.
         * 
         * @param string $index The name by which this piece of data will be 
         * represented.
         * @param mixed $value The actual data.
         */
        public function __set($index, $value)
        {
            $this->vars[$index] = $value;
        }
        
        /**
         * show($viewName)
         * 
         * Show the specified view.
         * 
         * @param string $viewName The name of the view we need to display
         */
        public function show($viewName)
        {
            try {
                $file = 'application/views/' . $viewName . 'View.php';

                if (!file_exists($file))
                    throw new Exception('View ' . $viewName . ' not found.');
                else {
                    foreach ($this->vars as $key => $value) {
                        $$key = $value;
                    }

                    include($file);
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                exit(0);
            }
        }
    }
