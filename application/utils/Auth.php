<?php
/**
 * Auth.php contains the Auth class
 * @author Aaron Crowder <aaron@aaroncrowder.com>
 */

/**
 * Auth class
 * 
 * User Authentication and session management
 */
class Auth
{
    /**
     * @var User
     */
    public $User = null;
    
    /**
     * @var boolean
     */
    public $loggedIn = false;
    
    /**
     * Our hashing algorithm (blowfish)
     * @var string
     */
    private $algo = '$2y';
    
    /**
     * The 'cost' parameter
     * @var string
     */
    private $cost = '$10';
    
    private $session;
    
    private $db;
    
    public function __construct($database)
    {
        include_once('application/models/UserModel.php');
        $this->db = new Database($database['host'], $database['database'], $database['user'], $database['password']);
        
        if(session_start() && isset($_SESSION['uid'])) {
            try {
                $results = $this->db->select('sessions', array('*'), array('fk_uid' => $_SESSION['uid']));
                
                if($results) {
                    $this->session = $results[0];
                    
                    if($this->session['ip'] == $_SERVER['REMOTE_ADDR']) {
                        $this->loggedIn = true;
                        $this->GetUser();
                    }
                }
            } catch(Exception $e) {
                echo "Caught Exception: " . $e->getMessage();
            }
        }
    }
    
    /**
     * LogIn()
     * 
     * Logs a user in
     * 
     * @param string $uName
     * @param string $password
     */
    public function LogIn($uName, $password)
    {
        $results = $this->db->select("users", array("*"), array("uName" => $uName));
        
        if (!empty($results)) {
            $hashArray = $this->HashPass($password, $results[0]['salt']);
            
            if($hashArray[0] == $results[0]['password']) {
                $this->loggedIn = true;
                $this->User = new User($results[0]['pkid'], $results[0]['uName'], $results[0]['password'], $results[0]['email'], $results[0]['salt']);
                $_SESSION['uid'] = $this->User->pkid;
                
                return $this->loggedIn;
            }
        } else {
            return $this->loggedIn;
        }
    }
    
    /**
     * LogOut()
     * 
     * Performs the log out action for a user
     * 
     * @return boolean
     */
    public function LogOut()
    {
        if(session_destroy()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * RegisterUser()
     * 
     * Registers the user
     * 
     * @param string $uName
     * @param string $password
     * @param string $email
     * @throws Exception
     * @return boolean
     */
    public function RegisterUser($uName, $password, $email)
    {
        $hashedArray = $this->HashPass($password);
        
        $result = $this->db->select('users', array('pkid'), array('uName' => array($uName, 'OR'), 'email' => $email));
        
        if(!empty($result)) {
            foreach($result as $user) {
                if($user['uName'] == $uName) {
                    throw new Exception('Username not unique');
                } elseif($user['email'] == $email) {
                    throw new Exception('Email not unique');
                }
            }
        } else {
            $result = $this->db->insert("users", array("uName" => $uName, "password" => $hashedArray[0], "email" => $email, "salt" => $hashedArray[1]));
            
            if($result) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    /**
     * GetUser()
     * 
     * Get's and sets this objects User parameter (which is in fact a User Model)
     * 
     * @return boolean
     */
    private function GetUser()
    {
        if($this->loggedIn) {
            $results = $this->db->select('users', array('*'), array('pkid' => $_SESSION['uid']));
            
            if(!empty($results)) {
                $this->User = new User(
                                                $results[0]['pkid'], 
                                                $results[0]['uName'], 
                                                $results[0]['password'], 
                                                $results[0]['email'], 
                                                $results[0]['salt']
                                        );
                return true;
            } else {
                return false;
            }
        }
    }
    
    
    /**
     * HashPass()
     * 
     * Hash the password supplied by the user
     * 
     * @param string $pass
     * @param string $salt
     * @return string
     */
    private function HashPass($pass, $salt = null)
    {
        if(!isset($salt)) {
            $salt = $this->GenSalt();
        }
        
        return array(
                                        crypt($pass, $this->algo . 
                                                     $this->cost . 
                                                     '$' . $salt),
                                        $salt);
    }
    
    /**
     * GenSalt()
     * 
     * Generates a random string to be used as the password salt
     * 
     * @return string
     */
    private function GenSalt()
    {
        $chars = array_merge(range('a','z'), range('A','Z'), range(0, 9));
        $max = count($chars) - 1;
        $str = "";
        $length = 22;
        
        while($length--) {
            shuffle($chars);
            $rand = mt_rand(0, $max);
            $str .= $chars[$rand];
        }
        return $str . '$';
    }
}
