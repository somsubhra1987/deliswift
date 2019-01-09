<?php

namespace app\modules\admin\models;

use Yii;
use app\lib\Core;
use app\lib\App;

/**
 * This is the model class for table "res_menu_item".
 *
 * @property string $menuItemID
 * @property string $menuItemName
 * @property string $courseType
 * @property integer $isVeg
 * @property integer $isActive
 * @property string $createdDatetime
 * @property string $createdByUserID
 * @property string $modifiedDatetime
 * @property string $modifiedByUserID
 */
class MenuItem extends \yii\db\ActiveRecord
{
    public $restaurantID;
    public $specialmenuItemName;
    public $price;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_menu_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

           [['menuItemName'], 'required'],
            //[['refRestaurantID','specialmenuItemName','price'], 'required','on'=>['create_specialmenu_ajax']],
            [['courseType', 'isVeg', 'isActive', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['createdDatetime', 'modifiedDatetime','refRestaurantID','specialmenuItemName','price'], 'safe'],
            [['menuItemName'], 'string', 'max' => 100],
            [['price'], 'number'],
            [['menuItemName'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menuItemID' => 'Menu Item ID',
            'menuItemName' => 'Menu Item Name',
            'specialmenuItemName' => 'Special Menu Name',
            'restaurantID' => 'Restaurant Name',
            'Price' => 'Price',
            'courseType' => 'Course Type',
            'isVeg' => 'Is Veg',
            'isActive' => 'Is Active',
            'createdDatetime' => 'Created Datetime',
            'createdByUserID' => 'Created By User ID',
            'modifiedDatetime' => 'Modified Datetime',
            'modifiedByUserID' => 'Modified By User ID',
        ];
    }
	
	public function beforeSave($insert)
	{
		$loggedUserDetails = Core::getLoggedUser();
        $loggedUserID = (int) $loggedUserDetails->userID;
        
        if($this->isNewRecord) 
        {
            $this->modifiedByUserID = 0;
            $this->createdByUserID = $loggedUserID;
        }
        else 
        {
            $this->modifiedByUserID = $loggedUserID;
            $this->modifiedDatetime = App::getCurrentDateTime();
        }
        return true;
	}
}
