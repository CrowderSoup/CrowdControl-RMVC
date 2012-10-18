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
            if(!$this->auth->loggedIn) {
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

        /**
         * do_login()
         * 
         * Process the login of a user
         */
        public function do_login()
        {
            if(!$this->auth->loggedIn) {
                if(DEBUGMODE) {
                    $data['registry'] = $this->registry;
                }
                
                $data['pageTitle'] = 'Login';
                $data['styles'] = $this->registry->styles;
                $data['js'] = $this->registry->js;
                $data['request'] = $this->registry->request;

                if($this->auth->LogIn($data['request']->POST['username'], $data['request']->POST['password'])) {
                    $data['loggedIn'] = $this->auth->loggedIn;
                } else {
                    $data['loggedIn'] = $this->auth->loggedIn;
                }

                $this->view->show('header', $data);
                $this->view->show('loginDone', $data);
                $this->view->show('footer', $data);
            } else {
                header('Location: ' . BASEURI);
            }
        }

        /**
         * logout()
         * 
         * Log the user out
         */
        public function logout()
        {
            if($this->auth->loggedIn) {
                if($this->auth->LogOut()) {
                    header('Location: ' . BASEURI);
                } else {
                    header('Location: ' . BASEURI);
                }
            } else {
                header('Location: ' . BASEURI);
            }
        }
    }
