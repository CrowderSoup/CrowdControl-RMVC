<?php
    /**
     * LoginController.php contains the class definition for our login
     * controller.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    /**
     * LoginController class exends @link BaseController
     *
     * This is the login controller for the application.
     */
    class LoginController extends BaseController
    {
        /**
         * index()
         * 
         * The index action for our controller
         */
        public function index()
        {
            $auth = new Auth($this->registry->database);

            if(!$auth->loggedIn) {
                if(DEBUGMODE) {
                    $data['registry'] = $this->registry;
                }
                
                $data['pageTitle'] = 'Login';
                $data['styles'] = $this->registry->styles;
                $data['js'] = $this->registry->js;
                $data['request'] = $this->registry->request;

                $this->view->show('header', $data);
                $this->view->show('login', $data);
                $this->view->show('footer', $data);
            } else {
                header('Location: ' . BASEURI);
            }
        }
    }
