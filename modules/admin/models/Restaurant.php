<?php

namespace app\modules\admin\models;

use Yii;
use app\lib\Core;
use app\lib\App;

/**
 * This is the model class for table "res_restaurants".
 *
 * @property integer $restaurantID
 * @property string $name
 * @property string $description
 * @property string $imagePath
 * @property string $contactName
 * @property string $contactPhone
 * @property string $contactMobile
 * @property integer $avgCostAmount
 * @property integer $avgCostHeadCount
 * @property string $avgCostInfo
 * @property integer $isCartAccept
 * @property integer $isHomeDelivery
 * @property string $bestKnownFor
 * @property string $countryCode
 * @property integer $provinceID
 * @property integer $cityID
 * @property integer $deliveryLocationID
 * @property string $contactAddress
 * @property integer $isActive
 * @property integer $isClosed
 * @property string $createdDatetime
 * @property integer $createdByUserID
 * @property string $modifiedDatetime
 * @property integer $modifiedByUserID
 */
class Restaurant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['name', 'countryCode', 'password' ,'provinceID', 'cityID', 'deliveryLocationID', 'createdByUserID'], 'required'],
            [['description', 'avgCostInfo'], 'string'],
            [['avgCostAmount', 'avgCostHeadCount', 'isCartAccept', 'isHomeDelivery', 'provinceID', 'cityID', 'deliveryLocationID', 'isActive', 'isClosed', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['createdDatetime', 'modifiedDatetime'], 'safe'],
            [['name', 'imagePath', 'contactAddress'], 'string', 'max' => 255],
            [['contactName'], 'string', 'max' => 100],
            [['contactPhone', 'contactMobile'], 'string', 'max' => 15],
            [['bestKnownFor'], 'string', 'max' => 150],
            [['countryCode'], 'string', 'max' => 2],
            [['code'], 'string', 'max' => 10],
            [['code'], 'unique', 'targetAttribute' => ['code'], 'message' => 'The restaurant code has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'restaurantID' => 'Restaurant ID',
            'name' => 'Name',
            'code' => 'Code',
            'password' => 'Password',
            'description' => 'Description',
            'imagePath' => 'Image Path',
            'contactName' => 'Contact Name',
            'contactPhone' => 'Contact Phone',
            'contactMobile' => 'Contact Mobile',
            'avgCostAmount' => 'Avg Cost Amount',
            'avgCostHeadCount' => 'Avg Cost Head Count',
            'avgCostInfo' => 'Avg Cost Info',
            'isCartAccept' => 'Is Cart Accept',
            'isHomeDelivery' => 'Is Home Delivery',
            'bestKnownFor' => 'Best Known For',
            'countryCode' => 'Country ',
            'provinceID' => 'State ',
            'cityID' => 'City',
            'deliveryLocationID' => 'Delivery Location',
            'contactAddress' => 'Contact Address',
            'isActive' => 'Is Active',
            'isClosed' => 'Is Closed',
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

         if( $this->password )   
            $this->password = md5($this->password);

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


   /* public function afterSave($insert)
    {
        if($this->isNewRecord) 
        {
            $this->code = App::generateRestaurantCode($this->restaurantID);
            $this->save();
        }
        return true;
    }*/


}
