<?php
    /**
     * IndexController.php contains the class definition for our main
     * controller.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
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
         */
        public function index()
        {

            $data['pageTitle'] = 'Home';
            $data['styles'] = $this->registry->styles;
            $data['js'] = $this->registry->js;
            $data['request'] = $this->registry->request;

            $this->view->show('header', $data);
            $this->view->show('index', $data);
            $this->view->show('footer', $data);
        }
    }
