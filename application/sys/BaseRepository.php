<?php
    /**
     * BaseRepository.php contains the abstract class definition for our
     * Repositories.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    /**
     * BaseRepository class
     * 
     * This class should contain things that will be commonly used by all of
     * our controllers throughout the application. <strong>If this isn't the 
     * case, then it doesn't belong here.</strong> While most applications will
     * only use one Repository I thought it prudent to allow for multiple as
     * the programmer sees fit.
     */
    abstract class BaseRepository
    {
        protected $db;

        function __construct($database)
        {
            $this->db = new Database($database['host'], $database['database'], $database['user'], $database['password']);
        }
        
        function __destruct()
        {
            $this->db->closeConn();
        }
        
        /**
         * IncludeModelClass($name)
         * 
         * Includes a model class for use in the Repository. Will not include a
         * model that's already been included.
         * 
         * @param string $name
         */
        protected function IncludeModelClass($name)
        {
            $file = 'application/models/' . $name . 'Model.php';

            if (is_readable($file)) {
                include_once $file;

                $strModel = $name;
            } else {
                throw new Exception("Could not get Model!");
            }
        }
    }
