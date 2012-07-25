<?php
    
    /* Prevent Direct Access to this file */
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
    {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
    
    class User extends BaseModel
    {
        public $pkid, $uName, $password, $email;
        
        function __construct($pkid, $uName, $password, $email)
        {
            $this->pkid     = $pkid;
            $this->uName    = $uName;
            $this->password = $password;
            $this->email = $email;
        }
    }
    
?>
