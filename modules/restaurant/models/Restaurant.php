<?php
namespace app\modules\restaurant\models;

use app\lib\Core;

class Restaurant extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $code;
    public $password;
    public $isActive;
    public $error;
    
    public static function findIdentity($id)
    {
	    $sql = "SELECT restaurantID AS id, code
	    		FROM res_restaurants
	    		WHERE restaurantID = :restaurantID ";
	    		
	   	$restaurant = Core::getRow($sql, array('restaurantID'=>$id));
        return empty($restaurant) ? null : new static($restaurant);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$restaurant as $restaurant) {
            if ($restaurant['accessToken'] === $token) {
                return new static($restaurant);
            }
        }

        return null;
    }
    
    public static function findByCredentials($code, $password)
    {
        $sql = "SELECT restaurantID AS id, code, password, isActive
        		FROM res_restaurants
        		WHERE code = :code AND password = MD5(:password)";
        			
        $restaurant = Core::getRow($sql, array('code'=>$code,'password'=>$password));
        if(!empty($restaurant) && isset($restaurant))
        {
          return empty($restaurant) ? null : new static($restaurant);
        }
        return null;
    }

    /**
     * Finds user by userID
     *
     * @param  string      $userID
     * @return static|null
     */
    public static function findByUserID($code)
    {
        $sql = "SELECT restaurantID AS id, code
	    		FROM res_restaurants
	    		WHERE code = :code";
	    		
	   	$restaurant = Core::getRow($sql, array('code'=>$code));	   
        return empty($restaurant) ? null : new static($restaurant);
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
    public function validateCredentials($code, $password)
    {   
	    $sql = "SELECT restaurantID AS id
	    		FROM res_restaurants
	    		WHERE code = :code
	    			AND password = MD5(:password)
	    			AND isActive = 1";
	    		
	   	$id = Core::getData($sql, array('code'=>$code,'password'=>$password));
	   	
	   	if($id) return true;
	   	return false;
    }   
}