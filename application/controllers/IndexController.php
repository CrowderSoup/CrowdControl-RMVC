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
            if(DEBUGMODE) {
                $data['registry'] = $this->registry;
            }

            $data['pageTitle'] = 'Home';
            $data['styles'] = $this->registry->styles;
            $data['js'] = $this->registry->js;
            $data['request'] = $this->registry->request;

            $data['loggedIn'] = $this->auth->loggedIn;
            if($data['loggedIn']) {
                $data['User'] = $this->repository->getUserByID($_SESSION['uid']);
            }

            $this->view->show('Core/header', $data);
            $this->view->show('Index/index', $data);
            $this->view->show('Core/footer', $data);
        }
    }
