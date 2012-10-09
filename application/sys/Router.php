<?php
    /**
     * Router.php contains the Router class
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    /**
     * Router class
     * 
     * The Router class handles the request, and passes it off to the
     * appropriate controller and action. If no appropriate controller or action
     * is found then a 404 is fired and our 404 error page is displayed.
     */
    class Router
    {
        /**
         * @var string The controller that we're routing to.
         */
        private $controller;
        
        /**
         * @var string The action that we're going to call.
         */
        private $action;
        
        /**
         * __construct()
         *
         * Construct the router object. Take the request and parse it into
         * an array that we can later work with to find the appropriate
         * controller and action.
         */
        public function __construct()
        {
            $request = '';
            if(isset($_GET['request']))
                $request = $_GET['request'];

            $split = explode('/',trim($request,'/'));
            $iCount = count($split);

            $this->controller = !empty($split[0]) ? ucfirst($split[0]) : INDEXCONTROLLER;
            $this->action = !empty($split[1]) ? $split[1] : INDEXACTION;
        }
        
        /**
         * route($registry)
         * 
         * The route() function takes the registry that we've built in index.php
         * and routes the users request.
         * 
         * @param Registry $registry A Registry object that holds config data
         * that will be used later in the application.
         */
        public function route($registry)
        {
            $file = 'application/controllers/' . $this->controller . 'Controller.php';
            if (is_readable($file)) {
                include $file;
                $class = $this->controller . 'Controller';

                $registry->request->GET['Controller'] = $this->controller;
            } else {
                include 'application/controllers/Error404Controller.php';
                $class = 'Error404Controller';

                $registry->request->GET['Controller'] = 'Error404';
            }
            $controller = new $class($registry);

            if (is_callable(array($controller, $this->action))) {
                $action = $this->action;

                $registry->request->GET['Action'] = $this->action;
            } else {
                $action = 'index';

                $registry->request->GET['Action'] = 'index';
            }

            unset($registry->request->GET['request']);
            $controller->$action();
        }
    }
