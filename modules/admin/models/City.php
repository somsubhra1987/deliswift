<?php

namespace app\modules\admin\models;

use Yii;
use app\lib\Core;
use app\lib\App;

/**
 * This is the model class for table "app_city".
 *
 * @property string $cityID
 * @property string $countryCode
 * @property string $provinceID
 * @property string $title
 * @property integer $isActive
 * @property string $createdDatetime
 * @property string $createdByUserID
 * @property string $modifiedDatetime
 * @property string $modifiedByUserID
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryCode', 'provinceID', 'title'], 'required'],
            [['provinceID', 'isActive', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['createdDatetime', 'modifiedDatetime'], 'safe'],
            [['countryCode'], 'string', 'max' => 2],
            [['title'], 'string', 'max' => 100],
            [['countryCode', 'provinceID', 'title'], 'unique', 'targetAttribute' => ['countryCode', 'provinceID', 'title'], 'message' => 'The combination of Country Code, Province ID and Title has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cityID' => 'City ID',
            'countryCode' => 'Country ',
            'provinceID' => 'Province',
            'title' => 'Title',
            'isActive' => 'Is Active',
            'createdDatetime' => 'Created Datetime',
            'createdByUserID' => 'Created By User ID',
            'modifiedDatetime' => 'Modified Datetime',
            'modifiedByUserID' => 'Modified By User ID',
        ];
    }


    

    #== Before Save ==#    
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
