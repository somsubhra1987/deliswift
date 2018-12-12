<?php
namespace app\modules\admin\models;

use app\lib\Core;

class Admin extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $isActive;
    public $error;
	public $userType;
    
    public static function findIdentity($id)
    {
	    $sql = "SELECT userID AS id, username, userType
	    		FROM app_users
	    		WHERE userID = :userID ";
	    		
	   	$user = Core::getRow($sql, array('userID'=>$id));
        return empty($user) ? null : new static($user);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }
    
    public static function findByCredentials($username, $password,$myLastLoginFranchiseID=false)
    {
        $sql = "SELECT userID AS id, username, password, isActive
        		FROM app_users
        		WHERE username = :username AND password = MD5(:password)";
        			
        $user = Core::getRow($sql, array('username'=>$username,'password'=>$password));
        if(!empty($user) && isset($user))
        {
          return empty($user) ? null : new static($user);
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $sql = "SELECT userID AS id, username
	    		FROM app_users
	    		WHERE username = :username";
	    		
	   	$user = Core::getRow($sql, array('username'=>$username));	   
        return empty($user) ? null : new static($user);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validateCredentials($username, $password)
    {
	    /*$password = Db::getMd5Value($password);*/
	    
	    $sql = "SELECT userID AS id
	    		FROM app_users
	    		WHERE username = :username
	    			AND password = MD5(:password)
	    			AND isActive = 1";
	    		
	   	$id = Core::getData($sql, array('username'=>$username,'password'=>$password));
	   	
	   	if($id) return true;
	   	return false;
    }   
}