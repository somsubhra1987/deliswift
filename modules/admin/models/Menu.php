<?php

namespace app\modules\admin\models;

use Yii;
use app\lib\Core;
use app\lib\App;

/**
 * This is the model class for table "res_menu".
 *
 * @property string $menuID
 * @property string $restaurantID
 * @property string $menuItemID
 * @property string $imagePath
 * @property string $price
 * @property integer $isOutofstock
 * @property string $createdDatetime
 * @property integer $createdByUserID
 * @property string $modifiedDatetime
 * @property integer $modifiedByUserID
 */
class Menu extends \yii\db\ActiveRecord
{
    public $courseType=1;
    public $specialmenuItemName;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurantID', 'menuItemID', 'price'], 'required'],
            [['restaurantID', 'specialmenuItemName', 'price'], 'required','on'=>['create_specialmenu_ajax']],
            [['restaurantID', 'menuItemID', 'isOutofstock', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['price'], 'number'],
            [['createdDatetime', 'modifiedDatetime','courseType','specialmenuItemName'], 'safe'],
            [['imagePath'], 'string', 'max' => 255],
            [['imagePath'], 'image','extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 1, 'minWidth' => 400, 'maxWidth' => 1600, 'minHeight' => 250, 'maxHeight'=>900,'skipOnEmpty' => true],
            [['restaurantID', 'menuItemID'], 'unique', 'targetAttribute' => ['restaurantID', 'menuItemID'], 'message' => 'The Restaurant Menu item is already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menuID' => 'Menu ID',
            'courseType' => 'Course Type',
            'restaurantID' => 'Restaurant ID',
            'menuItemID' => 'Menu name',
            'specialmenuItemName' => 'Special Menu name',
            'imagePath' => 'Image Path',
            'price' => 'Price',
            'isOutofstock' => 'Is Outofstock',
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
