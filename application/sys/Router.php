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
            $file = 'application/controllers/' . $registry->request->GET['Dir'] . $registry->request->GET['Controller'] . 'Controller.php';
            if (is_readable($file)) {
                include $file;
                $class = $registry->request->GET['Controller'] . 'Controller';
            } else {
                include 'application/controllers/Error404Controller.php';
                $class = 'Error404Controller';

                $registry->request->GET['Controller'] = 'Error404';
            }
            $controller = new $class($registry);

            if (is_callable(array($controller, $registry->request->GET['Action']))) {
                $action = $registry->request->GET['Action'];
            } else {
                $action = 'index';

                $registry->request->GET['Action'] = 'index';
            }

            unset($registry->request->GET['request']);
            $controller->$action();
        }
    }
