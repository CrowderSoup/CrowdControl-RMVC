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
                        array_push($users, new User($user['pkid'], $user['uName'], $user['password'], $user['email']));
                    }

                    return $users;
                } else

                    return false;
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
                        array_push($users, new User($user['pkid'], $user['uName'], $user['password'], $user['email']));
                    }

                    return $users;
                } else

                    return false;
            } catch (Exception $e) {
                echo "Caught Exception: " . $e->getMessage();
            }
        }
        
        /**
         * updateUserEmail()
         * 
         * Update a @link User's email address
         * 
         * @param int $id
         * @param string $new_email
         */
        public function updateUserEmail($id, $new_email)
        {
            try {
                $this->IncludeModelClass("User");

                $upEmail = $this->db->update("users", array("email" => $new_email), array("pkid" => $id));

                return $upEmail;
            } catch (Exception $e) {
                echo "Caught Exception: " . $e->getMessage();
            }
        }
        
        /**
         * insertNewUser()
         * 
         * Insert a new @link User into the database.
         * 
         * @param string $uName
         * @param string $password
         * @param string $email
         */
        public function insertNewUser($uName, $password, $email)
        {
            try {
                $this->IncludeModelClass("User");

                $result = $this->db->insert("users", array("uName" => $uName, "password" => $password, "email" => $email));

                return $result;
            } catch (Exception $e) {
                echo "Caught Exception: " . $e->getMessage();
            }
        }
        
        /**
         * deleteUser()
         * 
         * Delete a @link User from the database.
         * @param unknown_type $id
         */
        public function deleteUser($id)
        {
            try {
                $this->IncludeModelClass("User");

                $result = $this->db->delete("users", array("pkid" => $id));

                return $result;
            } catch (Exception $e) {
                echo "Caught Exception: " . $e->getMessage();
            }
        }
    
        public function getAllUsersSCLR()
        {
            try {
                $this->IncludeModelClass("User");
                
                $result = $this->db->rawQuery("SELECT * FROM users", array());
                
                return $result;
            } catch (Exception $e) {
                echo "Caught Exception: " . $e->getMessage();
            }
        }
    }
