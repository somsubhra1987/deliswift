<?php
namespace app\modules\delivery\models;

use app\lib\Core;

class Delivery extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $userID;
    public $password;
    public $isActive;
    public $error;
    
    public static function findIdentity($id)
    {
	    $sql = "SELECT deliveryBoyID AS id, userID
	    		FROM dlv_delivery_boy
	    		WHERE userID = :userID ";
	    		
	   	$deliveryBoy = Core::getRow($sql, array('userID'=>$id));
        return empty($deliveryBoy) ? null : new static($deliveryBoy);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$deliveryBoy as $deliveryBoy) {
            if ($deliveryBoy['accessToken'] === $token) {
                return new static($deliveryBoy);
            }
        }

        return null;
    }
    
    public static function findByCredentials($userID, $password)
    {
        $sql = "SELECT deliveryBoyID AS id, userID, password, isActive
        		FROM dlv_delivery_boy
        		WHERE userID = :userID AND password = MD5(:password)";
        			
        $deliveryBoy = Core::getRow($sql, array('userID'=>$userID,'password'=>$password));
        if(!empty($deliveryBoy) && isset($deliveryBoy))
        {
          return empty($deliveryBoy) ? null : new static($deliveryBoy);
        }
        return null;
    }

    /**
     * Finds user by userID
     *
     * @param  string      $userID
     * @return static|null
     */
    public static function findByUserID($userID)
    {
        $sql = "SELECT deliveryBoyID AS id, userID
	    		FROM dlv_delivery_boy
	    		WHERE userID = :userID";
	    		
	   	$deliveryBoy = Core::getRow($sql, array('userID'=>$userID));	   
        return empty($deliveryBoy) ? null : new static($deliveryBoy);
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
    public function validateCredentials($userID, $password)
    {
	    /*$password = Db::getMd5Value($password);*/
	    
	    $sql = "SELECT deliveryBoyID AS id
	    		FROM dlv_delivery_boy
	    		WHERE userID = :userID
	    			AND password = MD5(:password)
	    			AND isActive = 1";
	    		
	   	$id = Core::getData($sql, array('userID'=>$userID,'password'=>$password));
	   	
	   	if($id) return true;
	   	return false;
    }   
}