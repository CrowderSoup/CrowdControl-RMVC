<?php
    /**
     * Repository.php contains the class definition for our Repository.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    /**
     * Repository class extends @link BaseRepository
     * 
     * This is our main repository. You may add more just like this one,
     * or you may just add all your data access functions here.
     */
    class Repository extends BaseRepository
    {
        /**
         * getAllUsers()
         * 
         * Gets and returns an array of @link User objects
         */
        public function getAllUsers()
        {
            try {
                $this->IncludeModelClass("User");

                $users = array();
                $results = $this->db->select("users");

                if (!empty($results)) {
                    foreach ($results as $user) {
                        array_push($users, new User($user['pkid'], $user['fName'], $user['lName'], $user['uName'], $user['password'], $user['email'], $user['salt'], $user['jsonSettings']));
                    }

                    return $users;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo "Caught Exception: " . $e->getMessage();
            }
        }
        
        /**
         * getUserByUserName()
         * 
         * Gets and returns a @link User object containing a user gotten
         * by User Name.
         * 
         * @param string $uName
         */
        public function getUserByUserName($uName)
        {
            try {
                $this->IncludeModelClass("User");

                $users = array();
                $results = $this->db->select("users", array("*"), array("uName" => $uName));

                if (!empty($results)) {
                    foreach ($results as $user) {
                        array_push($users, new User($user['pkid'], $user['fName'], $user['lName'], $user['uName'], $user['password'], $user['email'], $user['salt'], $user['jsonSettings']));
                    }

                    return $users;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo "Caught Exception: " . $e->getMessage();
            }
        }

        /**
         * getUserByID()
         * 
         * Gets and returns a @link User object containing a user gotten
         * by the ID.
         * 
         * @param int $id
         */
        public function getUserByID($id)
        {
            try {
                $this->IncludeModelClass("User");

                $users = array();
                $results = $this->db->select("users", array("*"), array("pkid" => $id));

                if (!empty($results)) {
                    foreach ($results as $user) {
                        array_push($users, new User($user['pkid'], $user['fName'], $user['lName'], $user['uName'], $user['password'], $user['email'], $user['salt'], $user['jsonSettings']));
                    }

                    return $users[0];
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo "Caught Exception: " . $e->getMessage();
            }
        }
    }
