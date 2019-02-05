<?php

namespace app\modules\admin\models;

use Yii;
use app\lib\Core;
use app\lib\App;

/**
 * This is the model class for table "res_restaurant_photo".
 *
 * @property string $restaurantPhotoID
 * @property string $restaurantID
 * @property string $photoName
 * @property integer $photoType
 * @property string $createdDatetime
 * @property string $createdByUserID
 * @property string $modifiedDatetime
 * @property string $modifiedByUserID
 */
class RestaurantPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_restaurant_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurantID', 'photoName'], 'required'],
            [['restaurantID', 'photoType', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['createdDatetime', 'modifiedDatetime'], 'safe'],
            [['photoName'], 'image', 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 2097152, 'tooBig' => 'File size should not be more than 2MB', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'restaurantPhotoID' => 'Restaurant Photo ID',
            'restaurantID' => 'Restaurant ID',
            'photoName' => ($this->isNewRecord) ? 'Choose File' : 'Choose File to change',
            'photoType' => 'Photo Type',
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
