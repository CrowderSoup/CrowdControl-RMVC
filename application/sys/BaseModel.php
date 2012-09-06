<?php
    /**
     * BaseModel.php contains the abstract class definition for our
     * models.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    /**
     * BaseModel class
     * 
     * This class should contain things that will be commonly used by all of
     * our models throughout the application. <strong>If this isn't the 
     * case, then it doesn't belong here.</strong>
     */
    abstract class BaseModel
    {
        function __construct() { }
        function __clone() { }
    }
