<?php
    
    /* Prevent Direct Access to this file */
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
    {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
    
    abstract class BaseController
    {
    	protected $registry;
        protected $model;
        protected $view;
        protected $repository;
    
    	function __construct($registry)
    	{
    	    $this->view = new View();
    		$this->registry = $registry;
    		
    		// Include all the utils we're going to need
		    foreach($this->registry->utils as $util)
		    {
		        $file = 'application/utils/' . $util . '.php';
		        if(is_readable($file))
                {
                    include $file;
                }
		    }
		    
		    require_once('application/models/Repository.php');
		    $this->repository = new Repository($this->registry->database);
    	}
    }

?>
