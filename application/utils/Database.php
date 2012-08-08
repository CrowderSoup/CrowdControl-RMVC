<?php
    /**
     * Database.php contains the Database class
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */

    // Prevent Direct Access to this file
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
    
     /**
     * Database class
     * 
     * The Database class is a wrapper around all interactions with the database.
     * It allows the developer to worry less about writing SQL and more about
     * working with the data that comes back.
     */
    class Database
    {
        /**
         * @var string The MySQL Server
         */
        private $Server;
        
        /**
         * @var string The Schema we want to work with
         */
        private $Schema;
        
        /**
         * @var string The User we'll use to connect
         */
        private $User;
        
        /**
         * @var string The Password we'll use to authenticate our User
         */
        private $Password;
        
        /**
         * @var string The PDO object we'll use to work with the Database
         */
        private $dbh;
        
        /**
         * @var string The query we're going to run
         */
        private $query;
        
        /**
         * __construct()
         * 
         * @param string $Server The Server we want to connect to
         * @param string $Schema The Schema we want to work with
         * @param string $User The User we want to use to connect
         * @param string $Password The Password to authenticate the User
         */
        function __construct($Server, $Schema, $User, $Password)
        {
            $this->Server   =   $Server;
            $this->Schema   =   $Schema;
            $this->User     =   $User;
            $this->Password =   $Password;

            try {
                $this->dbh = new PDO("mysql:host=$Server;dbname=$Schema", $User, $Password);
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
        
        /**
         * getLastQuery()
         * 
         * Gets the last query that was run. Useful for diagnostic and debugging
         * purposes.
         */
        public function getLastQuery()
        {
            return $this->query;
        }
        
        /**
         * select()
         * 
         * Build and execute a SELECT statement on a specified table.
         * 
         * @param string $table The table that we want to perform the select on
         * @param array $values The values that we want to select from the table
         * @param array $where The values that we will use to build the where
         * caluse.
         * @example select('Users', array('uName', 'email'), array("uName" => 'aaron'))
         */
        public function select($table, $values = array(), $where = array())
        {
            $query = "SELECT ";

            if (!empty($values)) {
                $iCount = 0;
                $vCount = count($values);

                foreach ($values as $Column => $Value) {
                    $query .= $Value;

                    $iCount++;
                    if($iCount != $vCount)
                        $query .= ", ";
                }
            } else
                $query .= " * ";

            $query .= " FROM " . $table;

            if (!empty($where)) {
                if (!empty($where)) {
                    $arrWhere = $this->buildWhere($where);
                    if ($arrWhere !== false) {
                        $query .= $arrWhere[0];
                        $data = array();

                        foreach ($arrWhere[1] as $item) {
                            array_push($data, $item);
                        }
                    } else
                        throw new Exception("Couldn't build where clause!");
                }
            }

            $this->query = $query;

            try {
                $statement = $this->dbh->prepare($this->query);

                if(!empty($data))
                    $statement->execute($data);
                else
                    $statement->execute();

                return $statement->fetchAll();
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
        
        /**
         * insert()
         * 
         * Build and execute an INSERT statement on a specified table
         * 
         * @param string $table The table that we want to perform the insert on
         * @param array $values A key => value pair array of columns and values 
         * that we need to insert into the table.
         * @example insert('Users', array('uName' => 'aaron', 'password' => '1234'))
         */
        public function insert($table, $values)
        {
            $data = array();

            $query = "INSERT INTO " . $table . " (";

            if (!empty($values) && is_array($values)) {
                $iCount = 0;
                $vCount = count($values);

                foreach ($values as $Column => $Value) {
                    $query .= $Column;

                    $iCount++;
                    if($iCount != $vCount)
                        $query .= ", ";
                }

                $query .= ") VALUES(";

                $iCount = 0;

                foreach ($values as $Column => $Value) {
                    $query .= "?";
                    array_push($data, $Value);

                    $iCount++;
                    if($iCount != $vCount)
                        $query .= ", ";
                }

                $query .= ")";

                $this->query = $query;

                try {
                    $ins = $this->dbh->prepare($this->query);
                    $ins->execute($data);

                    return $ins->rowCount();
                } catch (PDOException $e) {
                    return $e->getMessage();
                }
            } else {
                throw new Exception("You cannot perform an INSERT action without passing any values.");
            }
        }
        
        /**
         * update()
         * 
         * Build and execute an UPDATE statement on a specified table
         * 
         * @param string $table The table that we want to perform the update on
         * @param array $values A key => value pair array of columns and values 
         * that we need to insert into the table.
         * @param array $where The values that we will use to build the where
         * caluse.
         * @example update('Users', array('email' => 'aaron@aaroncrowder.com'), array("uName" => 'aaron'))
         */
        public function update($table, $values, $where = array())
        {
            $query = "UPDATE " . $table . " SET ";
            $data = array();

            if (!empty($values) && is_array($values)) {
                $iCount = 0;
                $vCount = count($values);

                foreach ($values as $Column => $Value) {
                    $query .= $Column . " = ?";
                    array_push($data, $Value);

                    $iCount++;
                    if($iCount != $vCount)
                        $query .= ", ";
                }

                if (!empty($where)) {
                    $Where = $this->buildWhere($where);

                    if ($Where !== false) {
                        $query .= $Where[0];

                        foreach ($Where[1] as $item) {
                            array_push($data, $item);
                        }
                    } else
                        throw new Exception("Couldn't build where clause!");
                }

                $this->query = $query;

                try {
                    $up = $this->dbh->prepare($this->query);
                    $up->execute($data);

                    return $up->rowCount();
                } catch (PDOException $e) {
                    return $e->getMessage();
                }
            } else {
                throw new Exception("You cannot perform an UPDATE action without passing a where array.");
            }
        }
        
        /**
         * delete()
         * 
         * Build and execute an DELETE statement on a specified table
         * 
         * @param string $table The table that we want to perform the delete on 
         * @param array $where The values that we will use to build the where
         * caluse.
         * @example delete('Users', array("uName" => 'aaron'))
         */
        public function delete($table, $where)
        {
            $data = array();

            $query = "DELETE FROM " . $table;

            if (!empty($where) && is_array($where)) {
                if (!empty($where)) {
                    $Where = $this->buildWhere($where);

                    if ($Where !== false) {
                        $query .= $Where[0];

                        foreach ($Where[1] as $item) {
                            array_push($data, $item);
                        }
                    } else
                        throw new Exception("Couldn't build where clause!");
                }

                $this->query = $query;

                try {
                    $del = $this->dbh->prepare($this->query);
                    $del->execute($data);

                    return $del->rowCount();
                } catch (PDOException $e) {
                    return $e->getMessage();
                }
            } else {
                throw new Exception("You cannot perform an DELETE action without passing a where array.");
            }
        }

        public function closeConn()
        {
            $this->dbh = null;
        }

        /* Private Functions */
        
        /**
         * buildWhere()
         * 
         * Builds the where clause for all of our other functions.
         *
         * @param array $where The values that we will use to build the where
         * caluse.
         */
        private function buildWhere($where)
        {
            $query = " WHERE ";
            $iCount = 0;
            $wCount = count($where);
            $data = array();

            foreach ($where as $Column => $Value) {
                $iCount++;
                if (is_array($Value)) {
                    if (count($Value) == 2) {
                        $query .= $Column . " = ?";
                        array_push($data, $Value[0]);

                        if($iCount != $wCount)
                            $query .= " " . $Value[1] . " ";
                    } elseif (count($Value) == 3) {
                        $query .= $Column . "? ?";
                        array_push($data, $Value[0], $Value[1], $Value[2]);

                        if($iCount !=  $wCount)
                            $query .= " " . $Value[2] . " ";
                    } else

                        return false;
                } else {
                    $query .= $Column . " = ?";
                    array_push($data, $Value);

                    if($iCount != $wCount)
                        $query .= " AND ";
                }
            }

            return array($query, $data);
        }
    }
