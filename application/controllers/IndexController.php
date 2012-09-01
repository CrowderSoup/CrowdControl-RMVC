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
     * IndexController class exends @link BaseController
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
                $data['URIdata'] = $URIdata;

            $data['pageTitle'] = 'Home';
            $data['styles'] = $this->registry->styles;
            $data['js'] = $this->registry->js;

            $this->view->show('header', $data);
            $this->view->show('index', $data);
            $this->view->show('footer', $data);
        }
    }
