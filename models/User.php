<?php
namespace app\models;

use app\lib\Core;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $emailAddress;
    public $password;
    public $isActive;
    public $error;
    
    public static function findIdentity($id)
    {
	    $sql = "SELECT customerID AS id, emailAddress
	    		FROM cust_customer
	    		WHERE customerID = :customerID ";
	    		
	   	$customer = Core::getRow($sql, array('customerID'=>$id));
        return empty($customer) ? null : new static($customer);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$customers as $customer) {
            if ($customer['accessToken'] === $token) {
                return new static($customer);
            }
        }

        return null;
    }
    
    public static function findByCredentials($phoneOrEmail, $password, $isPasswordHash = 0)
    {
		if($isPasswordHash == 0)
		{
	    	$password = md5($password);
		}
		
        $sql = (!is_numeric($phoneOrEmail) || strlen($phoneOrEmail) > 10) ? "SELECT customerID AS id, emailAddress, password, isActive
        		FROM cust_customer
        		WHERE emailAddress = :phoneOrEmail AND password = :password" : "SELECT customerID AS id, emailAddress, password, isActive
        		FROM cust_customer
        		WHERE phoneNumber = :phoneOrEmail AND password = :password";
        			
        $customer = Core::getRow($sql, array('phoneOrEmail'=>$phoneOrEmail,'password'=>$password));
        if(!empty($customer) && isset($customer))
        {
          return empty($customer) ? null : new static($customer);
        }
        return null;
    }

    /**
     * Finds customer by emailAddress
     *
     * @param  string      $emailAddress
     * @return static|null
     */
    public static function findByEmailaddress($emailAddress)
    {
        $sql = "SELECT customerID AS id, emailAddress
	    		FROM cust_customer
	    		WHERE emailAddress = :emailAddress";
	    		
	   	$customer = Core::getRow($sql, array('emailAddress'=>$emailAddress));	   
        return empty($customer) ? null : new static($customer);
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
     * @return boolean if password provided is valid for current customer
     */
    public function validateCredentials($phoneOrEmail, $password, $isPasswordHash = 0)
    {
		if($isPasswordHash == 0)
		{
	    	$password = md5($password);
		}
	    
	    $sql = (!is_numeric($phoneOrEmail) || strlen($phoneOrEmail) > 10) ? "SELECT customerID AS id
	    		FROM cust_customer
	    		WHERE emailAddress = :phoneOrEmail
	    			AND password = :password
	    			AND isActive = 1" : "SELECT customerID AS id
	    		FROM cust_customer
	    		WHERE phoneNumber = :phoneOrEmail
	    			AND password = :password
	    			AND isActive = 1";
	    		
	   	$id = Core::getData($sql, array('phoneOrEmail'=>$phoneOrEmail,'password'=>$password));
	   	
	   	if($id) return true;
	   	return false;
    }   
}