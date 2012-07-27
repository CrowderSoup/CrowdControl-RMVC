<?php

    /* Prevent Direct Access to this file */
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }

    abstract class BaseRepository
    {
        protected $db;

        function __construct($database)
        {
            $this->db = new Database($database['host'], $database['database'], $database['user'], $database['password']);
        }

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
