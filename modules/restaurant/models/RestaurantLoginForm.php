<?php
namespace app\modules\restaurant\models;

use Yii;
use yii\base\Model;
use app\lib\Core;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "res_restaurants".
 *
 * @property string $restaurantID
 * @property string $password
 */
class RestaurantLoginForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $deleted,$tableFields;
    private $_restaurant = false;
    
    
    public static function tableName()
    {
        return 'res_restaurants';
    }

    /**
     * @inheritdoc
     */
     
	public function rules()
    {
        return [

             [['code', 'password'],'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Restaurant Code',
        ];
    }
	
    /**
     * @inheritdoc
     */
	public function login()
    {
        if ($this->validate())
        {
	        $restaurant = $this->getRestaurant(); /* Check the credentials on restaurant identity page*/
	        if($restaurant)
	        {
                if(isset($restaurant->isActive) && $restaurant->isActive == 0)
                {
                    $this->addError('password', "Account has been deactivated !");
                }
                elseif($restaurant->validateCredentials($this->code, $this->password))
                {
                    $login = Yii::$app->user->login($this->getRestaurant());
                    if($login)
                    {
                        Yii::$app->session['loggedRestaurantID'] = Core::getLoggedRestaurantID();
                    }
                    return $login;
                }
                else
                {
                    $this->addError('password', "Incorrect restaurant code or password !");
                }
        	}
        	else
        	{
                $this->addError('password', "Incorrect restaurant code or password !");
        	}
            return false;        	        	
        }
        return false;
    }
    
    public function getRestaurant()
    {
        if ($this->_restaurant === false) {
	        $this->_restaurant = Restaurant::findByCredentials($this->code, $this->password);
        }       
        return $this->_restaurant;
    }    
}
