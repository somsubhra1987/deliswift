<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "app_province".
 *
 * @property string $provinceID
 * @property string $countryCode
 * @property string $title
 * @property integer $isActive
 * @property string $createdDatetime
 * @property string $createdByUserID
 * @property string $modifiedDatetime
 * @property string $modifiedByUserID
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryCode', 'title'], 'required'],
            [['isActive', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['createdDatetime', 'modifiedDatetime'], 'safe'],
            [['countryCode'], 'string', 'max' => 2],
            [['title'], 'string', 'max' => 100],
            [['countryCode', 'title'], 'unique', 'targetAttribute' => ['countryCode', 'title'], 'message' => 'The combination of Country Code and Title has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provinceID' => 'Province ID',
            'countryCode' => 'Country Code',
            'title' => 'Title',
            'isActive' => 'Is Active',
            'createdDatetime' => 'Created Datetime',
            'createdByUserID' => 'Created By User ID',
            'modifiedDatetime' => 'Modified Datetime',
            'modifiedByUserID' => 'Modified By User ID',
        ];
    }
}
