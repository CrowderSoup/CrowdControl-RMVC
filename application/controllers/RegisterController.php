<?php
    /**
     * RegisterController.php contains the class definition for our register
     * controller.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    /**
     * RegisterController class exends @link BaseController
     *
     * This is the login controller for the application.
     */
    class RegisterController extends BaseController
    {
        /**
         * index()
         * 
         * The index action for our controller
         */
        public function index()
        {
            if(!$this->auth->loggedIn) {
                if(DEBUGMODE) {
                    $data['registry'] = $this->registry;
                }
                
                $data['pageTitle'] = 'Login';
                $data['styles'] = $this->registry->styles;
                $data['js'] = $this->registry->js;
                $data['request'] = $this->registry->request;

                $this->view->show('header', $data);
                $this->view->show('register', $data);
                $this->view->show('footer', $data);
            } else {
                header('Location: ' . BASEURI);
            }
        }

        public function do_reg()
        {
            if(!$this->auth->loggedIn) {
                if(DEBUGMODE) {
                    $data['registry'] = $this->registry;
                }
                
                $data['pageTitle'] = 'Login';
                $data['styles'] = $this->registry->styles;
                $data['js'] = $this->registry->js;
                $data['request'] = $this->registry->request;

                if($this->auth->RegisterUser($data['request']->POST['username'], $data['request']->POST['password'], $data['request']->POST['email'])) {
                    $data['registered'] = true;
                } else {
                    $data['registered'] = false;
                }

                $this->view->show('header', $data);
                $this->view->show('registerDone', $data);
                $this->view->show('footer', $data);
            } else {
                header('Location: ' . BASEURI);
            }
        }
    }
