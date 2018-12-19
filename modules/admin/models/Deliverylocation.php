<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "res_delivery_location".
 *
 * @property string $deliveryLocationID
 * @property string $countryCode
 * @property string $provinceID
 * @property string $cityID
 * @property string $title
 * @property integer $isActive
 * @property string $createdDatetime
 * @property string $createdByUserID
 * @property string $modifiedDatetime
 * @property string $modifiedByUserID
 */
class Deliverylocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_delivery_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryCode', 'provinceID', 'cityID', 'title'], 'required'],
            [['provinceID', 'cityID', 'isActive', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['createdDatetime', 'modifiedDatetime'], 'safe'],
            [['countryCode'], 'string', 'max' => 2],
            [['title'], 'string', 'max' => 255],
            [['countryCode', 'provinceID', 'cityID', 'title'], 'unique', 'targetAttribute' => ['countryCode', 'provinceID', 'cityID', 'title'], 'message' => 'The combination of Country Code, Province ID, City ID and Title has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deliveryLocationID' => 'Delivery Location ID',
            'countryCode' => 'Country Code',
            'provinceID' => 'Province ID',
            'cityID' => 'City ID',
            'title' => 'Title',
            'isActive' => 'Is Active',
            'createdDatetime' => 'Created Datetime',
            'createdByUserID' => 'Created By User ID',
            'modifiedDatetime' => 'Modified Datetime',
            'modifiedByUserID' => 'Modified By User ID',
        ];
    }
}
