<?php
    
    /* Prevent Direct Access to this file */
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
    {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
    
    class View
    {
    	private $vars = array();
    
    	public function __set($index, $value)
     	{
            $this->vars[$index] = $value;
     	}
    
    	public function show($viewName)
    	{
    		try
    		{
    			$file = 'application/views/' . $viewName . 'View.php';
    
    			if (!file_exists($file))
    				throw new Exception('View ' . $viewName . ' not found.');
    			else
    			{
        			foreach ($this->vars as $key => $value)
        			{
        				$$key = $value;
        			}
        
        			include($file);
    			}
    		}
    		catch(Exception $e)
    		{
    			echo $e->getMessage();
    			exit(0);
    		}
    	}
    }

?>
