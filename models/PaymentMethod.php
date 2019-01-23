<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_method".
 *
 * @property string $paymentMethodID
 * @property string $paymentMethodDesc
 * @property integer $displayOrder
 * @property integer $isActive
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
	public $paymentMethodData, $lastUsedPaymentMethodID;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paymentMethodDesc', 'displayOrder'], 'required'],
            [['displayOrder', 'isActive'], 'integer'],
            [['paymentMethodDesc'], 'string', 'max' => 50],
            [['paymentMethodDesc'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'paymentMethodID' => 'Payment Method ID',
            'paymentMethodDesc' => 'Payment Method Desc',
            'displayOrder' => 'Display Order',
            'isActive' => 'Is Active',
        ];
    }
	
	public function getAvailablePaymentMethods()
	{
		$this->paymentMethodData = PaymentMethod::find()
			->where(['isActive' => 1])
			->orderBy(['displayOrder'=>SORT_DESC])
			->all();
			
		return true;
	}
}
