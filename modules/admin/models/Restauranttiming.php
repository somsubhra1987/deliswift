<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "res_restaurant_timings".
 *
 * @property string $restaurantTimingID
 * @property string $restaurantID
 * @property integer $dayID
 * @property string $openingTime
 * @property string $closingTime
 * @property integer $isActive
 * @property string $createdDatetime
 * @property integer $createdByUserID
 * @property string $modifiedDatetime
 * @property integer $modifiedByUserID
 */
class Restauranttiming extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_restaurant_timings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurantID', 'dayID', 'createdByUserID'], 'required'],
            [['restaurantID', 'dayID', 'isActive', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['openingTime', 'closingTime', 'createdDatetime', 'modifiedDatetime'], 'safe'],
            [['restaurantID', 'dayID'], 'unique', 'targetAttribute' => ['restaurantID', 'dayID'], 'message' => 'The combination of Restaurant ID and Day ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'restaurantTimingID' => 'Restaurant Timing ID',
            'restaurantID' => 'Restaurant ID',
            'dayID' => 'Day ID',
            'openingTime' => 'Opening Time',
            'closingTime' => 'Closing Time',
            'isActive' => 'Is Active',
            'createdDatetime' => 'Created Datetime',
            'createdByUserID' => 'Created By User ID',
            'modifiedDatetime' => 'Modified Datetime',
            'modifiedByUserID' => 'Modified By User ID',
        ];
    }
}
