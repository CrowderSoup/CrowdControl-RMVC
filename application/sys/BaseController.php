<?php
    /**
     * BaseController.php contains the abstract class definition for our
     * controllers.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    // Prevent Direct Access to this file
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
    
    /**
     * BaseController class
     * 
     * This class should contain things that will be commonly used by all of
     * our controllers throughout the application. <strong>If this isn't the 
     * case, then it doesn't belong here.</strong>
     */
    abstract class BaseController
    {
        protected $registry;
        protected $model;
        protected $view;
        protected $repository;

        function __construct($registry)
        {
            $this->view = new View();
            $this->registry = $registry;
            
            // Pass the registry off to the view in case we need anything there
            $this->view->registry = $this->registry;

            // Include all the utils we're going to need
            foreach ($this->registry->utils as $util) {
                $file = 'application/utils/' . $util . '.php';
                if (is_readable($file)) {
                    include $file;
                }
            }
            
            // Include our Repository
            require_once 'application/models/Repository.php';
            $this->repository = new Repository($this->registry->database);
        }
    }
