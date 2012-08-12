<?php
    /**
     * IndexController.php contains the class definition for our main
     * controller.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    // Prevent Direct Access to this file
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
    
    /**
     * IndexController class
     *
     * This is the main controller for the application.
     */
    class IndexController extends BaseController
    {
        /**
         * index()
         * 
         * The index action for our controller
         * 
         * @param array $URIdata
         */
        public function index($URIdata)
        {
            if(!empty($URIdata) && is_array($URIdata))
                $this->view->data = $URIdata;

            //$this->view->users = $this->repository->getAllUsers();

            $this->view->pageTitle = 'Home';

            $this->view->show('header');
            $this->view->show('index');
            $this->view->show('footer');
        }
    }
