<?php
    /**
     * Error404Controller.php contains the class definition for our 404
     * controller.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    // Prevent Direct Access to this file
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
    
    /**
     * Error404Controller class
     *
     * This is the 404 controller for the application.
     */
    class Error404Controller extends BaseController
    {
        /**
         * index()
         * 
         * The index action for our controller
         */
        public function index()
        {
            $data['pageTitle'] = 'Home';
            $data['styles'] = $this->registry->styles;
            $data['js'] = $this->registry->js;

            $this->view->show('header', $data);
            $this->view->show('404', $data);
            $this->view->show('footer', $data);
        }
    }
