<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_ip_address_city".
 *
 * @property string $ipAddressCityID
 * @property string $ipAddress
 * @property string $lastSelectedCityID
 * @property string $createdDatetime
 */
class IpAddressCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_ip_address_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ipAddress', 'lastSelectedCityID'], 'required'],
            [['lastSelectedCityID'], 'integer'],
            [['createdDatetime'], 'safe'],
            [['ipAddress'], 'string', 'max' => 20],
            [['ipAddress'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ipAddressCityID' => 'Ip Address City ID',
            'ipAddress' => 'Ip Address',
            'lastSelectedCityID' => 'Last Selected City ID',
            'createdDatetime' => 'Created Datetime',
        ];
    }
}
