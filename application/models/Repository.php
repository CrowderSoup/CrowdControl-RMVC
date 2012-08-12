<?php
    /**
     * Repository.php contains the class definition for our Repository.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    // Prevent Direct Access to this file
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }

    class Repository extends BaseRepository
    {
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
    }
