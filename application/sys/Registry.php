<?php
    
    /* Prevent Direct Access to this file */
    if (!defined('BASEPATH'))
    {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
    
    class Registry
    {
    	private $vars = array();
    
    	public function __set($index, $value)
    	{
    		$this->vars[$index] = $value;
    	}
    
    	public function __get($index)
    	{
    		return $this->vars[$index];
    	}
    }

?>