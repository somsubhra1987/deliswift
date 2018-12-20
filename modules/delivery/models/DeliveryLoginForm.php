<?php
namespace app\modules\delivery\models;

use Yii;
use yii\base\Model;
use app\lib\Core;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "dlv_delivery_boy".
 *
 * @property string $deliveryBoyID
 * @property string $password
 */
class DeliveryLoginForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    // public $username;
    // public $password;
    public $deleted,$tableFields;
    
    private $_deliveryBoy = false;
    
    
    public static function tableName()
    {
        return 'dlv_delivery_boy';
    }

    /**
     * @inheritdoc
     */
     
	public function rules()
    {
        return [

             [['userID', 'password'],'required'],
        ];
    }
	
    /**
     * @inheritdoc
     */
	public function login()
    {
        if ($this->validate())
        {
	        $deliveryBoy = $this->getDeliveryBoy(); /* Check the credentials on delivery identity page*/
	        if($deliveryBoy)
	        {
                if(isset($deliveryBoy->isActive) && $deliveryBoy->isActive == 0)
                {
                    $this->addError('password', "Account has been deactivated !");
                }
                elseif($deliveryBoy->validateCredentials($this->userID, $this->password))
                {
                    $login = Yii::$app->user->login($this->getDeliveryBoy());
                    if($login)
                    {
                        Yii::$app->session['loggedDeliveryBoyID'] = Core::getLoggedDeliveryBoyID();
                    }
                    return $login;
                }
                else
                {
                    $this->addError('password', "Incorrect username or password !");
                }
        	}
        	else
        	{
                $this->addError('password', "Incorrect username or password !");
        	}
            return false;        	        	
        }
        return false;
    }
    
    public function getDeliveryBoy()
    {
        if ($this->_deliveryBoy === false) {
	        $this->_deliveryBoy = Delivery::findByCredentials($this->userID, $this->password);
        }       
        return $this->_deliveryBoy;
    }    
}
