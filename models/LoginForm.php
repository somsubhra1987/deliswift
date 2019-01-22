<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\lib\Core;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "cust_customer".
 *
 * @property string $customerID
 * @property string $firstName
 * @property string $lastName
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property integer $isActive
 */
class LoginForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $deleted,$tableFields,$isPasswordHash;
    
    private $_customer = false;
    
    
    public static function tableName()
    {
        return 'cust_customer';
    }

    /**
     * @inheritdoc
     */
     
	public function rules()
    {
        return [

             [['emailAddress', 'password', 'isPasswordHash'],'required'],
        ];
    }
	
    /**
     * @inheritdoc
     */
	public function login()
    {
        if ($this->validate())
        {
	        $customer = $this->getCustomer(); /* Check the credentials on user identity page*/
	        if($customer)
	        {
                if(isset($customer->isActive) && $customer->isActive == 0)
                {
                    $this->addError('password', "Account has been deactivated !");
                }
                elseif($customer->validateCredentials($this->emailAddress, $this->password, $this->isPasswordHash))
                {
                    $login = Yii::$app->user->login($this->getCustomer());
                    if($login)
                    {
                        Yii::$app->session['loggedCustomerID'] = Core::getLoggedCustomerID();
                    }
                    return $login;
                }
                else
                {
                    $this->addError('password', "Incorrect emailAddress or password !");
                }
        	}
        	else
        	{
                $this->addError('password', "Incorrect emailAddress or password !");
        	}
            return false;        	        	
        }
        return false;
    }
    
    public function getCustomer()
    {
        if ($this->_customer === false) {
	        $this->_customer = User::findByCredentials($this->emailAddress, $this->password, $this->isPasswordHash);
        }       
        return $this->_customer;
    }    
}
