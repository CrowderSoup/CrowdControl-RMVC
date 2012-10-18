<?php
    /**
     * View.php contains the View class
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
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
         * show($viewName)
         * 
         * Show the specified view.
         * 
         * @param string $viewName The name of the view we need to display
         * @param array $data The data that we need to pass into the view.
         */
        public function show($viewName, $data = array())
        {
            try {
                $file = 'application/views/' . $viewName . 'View.php';

                if (!file_exists($file))
                    throw new Exception('View ' . $viewName . ' not found.');
                else {
                    extract($data);
                    
                    include($file);
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                exit(0);
            }
        }
    }
