<?php

namespace app\models;

use Yii;
use app\lib\Core;

/**
 * This is the model class for table "ord_cart".
 *
 * @property string $cartID
 * @property string $restaurantID
 * @property string $customerID
 * @property string $menuItemID
 * @property string $userIP
 * @property string $sessionID
 * @property integer $qty
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ord_cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurantID', 'menuItemID', 'userIP'], 'required'],
            [['restaurantID', 'customerID', 'menuItemID', 'qty'], 'integer'],
            [['userIP'], 'string', 'max' => 20],
            [['sessionID'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cartID' => 'Cart ID',
            'restaurantID' => 'Restaurant ID',
            'customerID' => 'Customer ID',
            'menuItemID' => 'Menu Item ID',
            'userIP' => 'User Ip',
            'sessionID' => 'Session ID',
            'qty' => 'Qty',
        ];
    }
	
	public function getCartDetail($restaurantID, $customerID, $userIP, $userSession)
	{
		$cartArr = Core::getRows("SELECT `cartID`, `menuItemID`, `qty` FROM `ord_cart` WHERE restaurantID = '$restaurantID' AND customerID = '$customerID' AND userIP = '$userIP' AND sessionID = '$userSession'");
		
		return $cartArr;
	}
}
