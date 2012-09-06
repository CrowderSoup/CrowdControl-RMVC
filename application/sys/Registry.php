<?php
    /**
     * Registry.php contains the Registry class
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    /**
     * Registry class
     * 
     * This is a catchall class that holds data. It allows you to pass things
     * from config, the router, etc. into your controllers.
     */
    class Registry
    {
        /**
         * @var array Holds all the data passed into the Registry
         */
        private $vars = array();
        
        /**
         * __set($index, $value)
         * 
         * Puts data in the $vars array.
         * 
         * @param string $index The name by which this piece of data will be 
         * represented.
         * @param mixed $value The actual data.
         */
        public function __set($index, $value)
        {
            $this->vars[$index] = $value;
        }
        
        /**
         * __get
         * 
         * @param string $index The index of the data we want to get out of the
         * registry.
         */
        public function __get($index)
        {
            return $this->vars[$index];
        }
    }
