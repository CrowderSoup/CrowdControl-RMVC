<?php
    /**
     * Repository.php contains the class definition for our Repository.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    /**
     * User class extends @link BaseModel
     * 
     * User class is an object that mirrors the structure of the User
     * table in the database.
     */
    class User extends BaseModel
    {
        /**
         * @var int
         */
        public $pkid;
        
        /**
         * @var string
         */
        public $uName;
        
        /**
         * @var string
         */
        public $password;
        
        /**
         * @var string
         */
        public $email;
        
        /**
         * __construct()
         * 
         * Set all object parameters when object is instantiated.
         * 
         * @param int $pkid
         * @param string $uName
         * @param string $password
         * @param string $email
         */
        function __construct($pkid, $uName, $password, $email)
        {
            $this->pkid = $pkid;
            $this->uName = $uName;
            $this->password = $password;
            $this->email = $email;
        }
    }
