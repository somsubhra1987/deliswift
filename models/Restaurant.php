<?php

namespace app\models;

use Yii;
use app\lib\Core;

/**
 * This is the model class for table "res_restaurants".
 *
 * @property integer $restaurantID
 * @property string $code
 * @property string $password
 * @property string $name
 * @property string $description
 * @property string $imagePath
 * @property string $contactName
 * @property string $contactPhone
 * @property string $contactMobile
 * @property integer $avgCostAmount
 * @property integer $avgCostHeadCount
 * @property string $avgCostInfo
 * @property integer $isCardAccept
 * @property integer $isHomeDelivery
 * @property string $bestKnownFor
 * @property string $countryCode
 * @property integer $provinceID
 * @property integer $cityID
 * @property integer $deliveryLocationID
 * @property string $contactAddress
 * @property integer $isActive
 * @property integer $isClosed
 * @property integer $isFeatured
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
            [['code', 'password', 'name', 'countryCode', 'provinceID', 'cityID', 'deliveryLocationID', 'createdByUserID'], 'required'],
            [['description', 'avgCostInfo'], 'string'],
            [['avgCostAmount', 'avgCostHeadCount', 'isCardAccept', 'isHomeDelivery', 'provinceID', 'cityID', 'deliveryLocationID', 'isActive', 'isClosed', 'isFeatured', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['createdDatetime', 'modifiedDatetime'], 'safe'],
            [['code'], 'string', 'max' => 10],
            [['password'], 'string', 'max' => 32],
            [['name', 'imagePath', 'contactAddress'], 'string', 'max' => 255],
            [['contactName'], 'string', 'max' => 100],
            [['contactPhone', 'contactMobile'], 'string', 'max' => 15],
            [['bestKnownFor'], 'string', 'max' => 150],
            [['countryCode'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'restaurantID' => 'Restaurant ID',
            'code' => 'Code',
            'password' => 'Password',
            'name' => 'Name',
            'description' => 'Description',
            'imagePath' => 'Image Path',
            'contactName' => 'Contact Name',
            'contactPhone' => 'Contact Phone',
            'contactMobile' => 'Contact Mobile',
            'avgCostAmount' => 'Avg Cost Amount',
            'avgCostHeadCount' => 'Avg Cost Head Count',
            'avgCostInfo' => 'Avg Cost Info',
            'isCardAccept' => 'Is Card Accept',
            'isHomeDelivery' => 'Is Home Delivery',
            'bestKnownFor' => 'Best Known For',
            'countryCode' => 'Country Code',
            'provinceID' => 'Province ID',
            'cityID' => 'City ID',
            'deliveryLocationID' => 'Delivery Location ID',
            'contactAddress' => 'Contact Address',
            'isActive' => 'Is Active',
            'isClosed' => 'Is Closed',
            'isFeatured' => 'Is Featured',
            'createdDatetime' => 'Created Datetime',
            'createdByUserID' => 'Created By User ID',
            'modifiedDatetime' => 'Modified Datetime',
            'modifiedByUserID' => 'Modified By User ID',
        ];
    }
	
	public function getFeaturedRestaurant()
	{
		$featuredRestaurantArr = Core::getRows("SELECT restaurantID, name, imagePath, contactAddress, deliveryLocationID, cityID FROM res_restaurants WHERE isFeatured = 1 AND isActive = 1 ORDER BY modifiedDatetime DESC, createdDatetime DESC LIMIT 10");
		
		return $featuredRestaurantArr;
	}
	
	public function getRestaurantsInDeliveryLocation($deliveryLocationID, $page, $sortDesc)
	{
		$limit = 20;
		$offset = ($page - 1) * 20;
		$restaurantArr = Core::getRows("SELECT restaurantID, name, imagePath, contactAddress, deliveryLocationID, cityID, avgCostAmount, avgCostHeadCount, isCardAccept FROM res_restaurants WHERE deliveryLocationID = '$deliveryLocationID' AND isActive = 1 ORDER BY $sortDesc DESC LIMIT $offset, $limit");
		
		return $restaurantArr;
	}
	
	public function getMenuDetailCourseTypeWise($restaurantID)
	{
		$menuItemTypeWiseDetailArr = array();
		$dataArr = array();
		$sl = 0;
		
		$menuArr = Core::getRows("SELECT rm.menuItemID, rmi.menuItemName, rmi.courseType, rmi.isVeg, rm.price FROM res_menu as rm INNER JOIN res_menu_item as rmi on rmi.menuItemID = rm.menuItemID where restaurantID = '$restaurantID' AND rm.isOutofstock = 0 ORDER by rmi.courseType, rmi.menuItemName");
		foreach($menuArr as $menu)
		{
			$sl++;
			if(!array_key_exists($menu['courseType'], $menuItemTypeWiseDetailArr))
			{
				$menuItemTypeWiseDetailArr[$menu['courseType']] = array();
			}
			$menuItemTypeWiseDetailArr[$menu['courseType']][] = array('menuItemID' => $menu['menuItemID'], 'menuItemName' => $menu['menuItemName'], 'price' => $menu['price'], 'isVeg' => $menu['isVeg']);
		}
		
		return $menuItemTypeWiseDetailArr;
	}
}
