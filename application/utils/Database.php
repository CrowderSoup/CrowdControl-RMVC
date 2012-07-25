<?php
    
    class Database
    {
        
        private $Server, $Schema, $User, $Password, $dbh, $query;
        
        function __construct($Server, $Schema, $User, $Password)
        {
            $this->Server   =   $Server;
            $this->Schema   =   $Schema;
            $this->User     =   $User;
            $this->Password =   $Password;
            
            try
            {
                $this->dbh = new PDO("mysql:host=$Server;dbname=$Schema", $User, $Password);
            }
            catch(PDOException $e)
            {
                return $e->getMessage();
            }
        }
        
        public function getLastQuery()
        {
            return $this->query;
        }
        
        public function select($table, $values = array(), $where = array())
        {
            $query = "SELECT ";
            
            if(!empty($values))
            {
                $iCount = 0;
                $vCount = count($values);
                
                foreach($values as $Column => $Value)
                {
                    $query .= $Value;
                    
                    $iCount++;
                    if($iCount != $vCount)
                        $query .= ", ";
                }
            }
            else
                $query .= " * ";
            
            $query .= " FROM " . $table;
            
            if(!empty($where))
            {
                if(!empty($where))
                {
                    $arrWhere = $this->buildWhere($where);
                    if($arrWhere !== false)
                    {
                        $query .= $arrWhere[0];
                        $data = array();
                        
                        foreach($arrWhere[1] as $item)
                        {
                            array_push($data, $item);
                        }
                    }
                    else
                        throw new Exception("Couldn't build where clause!");
                }
            }
            
            $this->query = $query;
            
            try
            {
                $statement = $this->dbh->prepare($this->query);
                
                if(!empty($data))
                    $statement->execute($data);
                else
                    $statement->execute();
                
                return $statement->fetchAll();
            }
            catch(PDOException $e)
            {
                return $e->getMessage();
            }
        }
        
        public function insert($table, $values)
        {
            $data = array();
            
            $query = "INSERT INTO " . $table . " (";
            
            if(!empty($values) && is_array($values))
            {
                $iCount = 0;
                $vCount = count($values);
                
                foreach($values as $Column => $Value)
                {
                    $query .= $Column;
                    
                    $iCount++;
                    if($iCount != $vCount)
                        $query .= ", ";
                }
                
                $query .= ") VALUES(";
                
                $iCount = 0;
                
                foreach($values as $Column => $Value)
                {
                    $query .= "?";
                    array_push($data, $Value);
                    
                    $iCount++;
                    if($iCount != $vCount)
                        $query .= ", ";
                }
                
                $query .= ")";
                
                $this->query = $query;
                
                try
                {
                    $ins = $this->dbh->prepare($this->query);
                    $ins->execute($data);
                    
                    return $ins->rowCount();
                }
                catch(PDOException $e)
                {
                    return $e->getMessage();
                }
            }
            else
            {
                throw new Exception("You cannot perform an INSERT action without passing any values.");
            }
        }
        
        public function update($table, $values, $where = array())
        {
            $query = "UPDATE " . $table . " SET ";
            $data = array();
            
            if(!empty($values) && is_array($values))
            {
                $iCount = 0;
                $vCount = count($values);
                
                foreach($values as $Column => $Value)
                {
                    $query .= $Column . " = ?";
                    array_push($data, $Value);
                    
                    $iCount++;
                    if($iCount != $vCount)
                        $query .= ", ";
                }
                
                if(!empty($where))
                {
                    $Where = $this->buildWhere($where);
                    
                    if($Where !== false)
                    {
                        $query .= $Where[0];
                        
                        foreach($Where[1] as $item)
                        {
                            array_push($data, $item);
                        }
                    }
                    else
                        throw new Exception("Couldn't build where clause!");
                }
                
                $this->query = $query;
                
                try
                {
                    $up = $this->dbh->prepare($this->query);
                    $up->execute($data);
                    
                    return $up->rowCount();
                }
                catch(PDOException $e)
                {
                    return $e->getMessage();
                }
            }
            else
            {
                throw new Exception("You cannot perform an UPDATE action without passing a where array.");
            }
        }
        
        public function delete($table, $where)
        {
            $data = array();
            
            $query = "DELETE FROM " . $table;
            
            if(!empty($where) && is_array($where))
            {
                if(!empty($where))
                {
                    $Where = $this->buildWhere($where);
                    
                    if($Where !== false)
                    {
                        $query .= $Where[0];
                        
                        foreach($Where[1] as $item)
                        {
                            array_push($data, $item);
                        }
                    }
                    else
                        throw new Exception("Couldn't build where clause!");
                }
                
                $this->query = $query;
                
                try
                {
                    $del = $this->dbh->prepare($this->query);
                    $del->execute($data);
                    
                    return $del->rowCount();
                }
                catch(PDOException $e)
                {
                    return $e->getMessage();
                }
            }
            else
            {
                throw new Exception("You cannot perform an DELETE action without passing a where array.");
            }
        }
        
        public function closeConn()
        {
            $this->dbh = null;
        }
        
        /* Private Functions */
        
        private function buildWhere($where)
        {
            $query = " WHERE ";
            $iCount = 0;
            $wCount = count($where);
            $data = array();
            
            foreach($where as $Column => $Value)
            {
                $iCount++;
                if(is_array($Value))
                {
                    if(count($Value) == 2)
                    {
                        $query .= $Column . " = ?";
                        array_push($data, $$Value[0]);
                        
                        if($iCount != $wCount)
                            $query .= " " . $Value[1] . " ";
                    }
                    elseif(count($Value) == 3)
                    {
                        $query .= $Column . "? ?";
                        array_push($data, $$Value[0], $Value[1], $Value[2]);
                        
                        if($iCount !=  $wCount)
                            $query .= " " . $Value[2] . " ";
                    }
                    else
                        return false;
                }
                else
                {
                    $query .= $Column . " = ?";
                    array_push($data, $Value);
                    
                    if($iCount != $wCount)
                        $query .= " AND ";
                }
            }
            
            return array($query, $data);
        }
    }
    
?>
