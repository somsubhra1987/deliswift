<?php
namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use app\lib\Core;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $userID
 * @property string $firstName
 * @property string $lastName
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property integer $active
 * @property integer $isSuper
 * @property integer $isDev
 * @property integer $deleted
 */
class AdminLoginForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    // public $username;
    // public $password;
    public $deleted,$tableFields;
    
    private $_user = false;
    
    
    public static function tableName()
    {
        return 'app_users';
    }

    /**
     * @inheritdoc
     */
     
	public function rules()
    {
        return [

             [['username', 'password'],'required'],
			 [['name', 'userType'], 'safe'],
        ];
    }
	
    /**
     * @inheritdoc
     */
	public function login()
    {
        if ($this->validate())
        {
	        $user = $this->getUser(); /* Check the credentials on user identity page*/
	        if($user)
	        {
                if(isset($user->active) && $user->active == 0)
                {
                    $this->addError('password', "Account has been deactivated !");
                }
                elseif($user->validateCredentials($this->username, $this->password))
                {
                    $login = Yii::$app->user->login($this->getUser());
                    if($login)
                    {
                        Yii::$app->session['loggedUserID'] = Core::getLoggedUserId();
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
    
    public function getUser()
    {
        if ($this->_user === false) {
	        $this->_user = Admin::findByCredentials($this->username, $this->password);
        }       
        return $this->_user;
    }    
}
