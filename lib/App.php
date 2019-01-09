<?php
namespace app\lib;
use Yii;
use app\lib\Core;

class App extends \yii\db\ActiveRecord {

	const RESTAURANT_CODE_PREFIX = "RES";
	const RESTAURANT_IMAGE_PATH = "uploads/restaurant/";

    #== Check Data in Use ==#
    
    public function checkDataInUse($tableArr = array())
    {
	   	$inUseCount = 0;
	   	
	    foreach($tableArr as $tableData)
	    {
		    $whereCond = '';
		    $whereCondArr = array();
		    $tableName = $tableData['tableName'];
		    $fieldName = $tableData['fieldName'];
		    if(count($tableData['condDataArr']) > 0)
		    {
			    $whereCondArr = $tableData['condDataArr'];
		    }
		    
		    foreach($whereCondArr as $whereFieldName => $whereFieldValue)
		   	{
			   	if($whereCond == '')
			   	{
				   	$whereCond = " WHERE $whereFieldName = '$whereFieldValue'";
			   	}
			   	else
			   	{
				   	$whereCond.= " AND $whereFieldName = '$whereFieldValue'";
			   	}
		   	}
		    
		    $sql = "SELECT COUNT($fieldName) as rowCount
		    			FROM $tableName
		    		$whereCond";
		    
		    $inUseCount += Core::getData($sql) ;
		    if($inUseCount > 0)
		    {
				return $inUseCount;
		    }
	    }
	    
	    return $inUseCount;
    }
    
    #== Check whether logged in user is super user ==#
    public function isSuperUser()
    {
    	$loggedUser = Core::getLoggedUser();
    	return ($loggedUser->userType == 'superuser') ? true : false;
    }
    
    #== Get Module Controller Action ==#
    
    public function getCurrentModuleControllerAction()
	{
		$controllerCode = Yii::$app->controller->id;
		$moduleCode = Yii::$app->controller->module->id;
		if($moduleCode == 'basic') $moduleCode = '/';
		
		if($moduleCode != '/') {
			$currentModule = $moduleCode;
			$modules = Yii::$app->getModules();
			unset($modules['gii']);
			unset($modules['debug']);
			
			$moduleArr = array_keys($modules);
			
			foreach($moduleArr as $module)
			{
				$submodules = Yii::$app->getModule($module)->getModules();
	            $submoduleArr = array_keys($submodules);
	            
	 			foreach($submoduleArr as $submodule)
	 			{
		 			if($submodule == $currentModule)
		 			{
			 			$moduleCode = $module ."/modules/". $submodule;
		 			}
	 			}
 			}
		}
		$actionName = Yii::$app->controller->action->id;
		
		$controllerCode = ucwords($controllerCode);
		$actionName = 'action'.ucwords($actionName);
		
		return array($moduleCode, $controllerCode, $actionName);
	}
	
	#== Get Default message form no permission ==#
	
	public function getNoPermissionMessage()
	{
		return 'Oops! You are not authorized to perform this action';
	}
	
	#== Get Month Assoc ==#
	public function getMonthAssoc()
	{
		return array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
	}

    #== get salutation for users ==#    	
	public function getSalutationAssoc()
	{
		return array("Mr."=>"Mr.", "Mrs."=>"Mrs.", "Miss."=>"Miss.", "Ms."=>"Ms.", "Dr."=>"Dr.", "Prof."=>"Prof.", "Rev."=>"Rev.");
	}

    #== get gender for users ==#    	
	public function getGenderAssoc()
	{
		return array("Male"=>"Male", "Female"=>"Female");
	}

    #== Formated Date Time ==#

	public function getFormatedDateTime($dateTime, $format = 'jS F Y H:i a')
	{
		return date($format, strtotime($dateTime));
	}

    #== Current Date ==#

	public function getCurrentDatetime()
	{
		return date('Y-m-d H:i:s');
	}

    #== Formated Date ==#

	public function getFormatedDate($date, $format = 'jS F Y')
	{
		return date($format, strtotime($date));
	}
	
	#== Remove all non numeric characters ==#

	function getOnlyDigits($string) {

	   return preg_replace('/[^0-9]/', '', $string);
	}
	
	#== Update record from table name ==#
	public function updateRecord($tableName, $dataArr, $conditionArr)
	{
		$connection = Yii::$app->db;
		$connection->createCommand()->update($tableName, $dataArr, $conditionArr)->execute();
		$lastInsertID = $connection->getLastInsertID();
        return $lastInsertID ? $lastInsertID : 0;
	}
	
	#== Delete Records from table ==#
    public function deleteRecord($tableName, $condition)
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand("DELETE FROM `".$tableName."` WHERE $condition");
        $res = $command->execute();
        if($res>0)
            return true;
        else
            return false;
    }
	
	public function getOrderStatusAssoc()
	{
		return array(1=>'Processing', 2=>'Confirmed by Restaurent', 3=>'Assign to delivery boy', 4=>'Confirmed by delivery boy', 5=>'Out for delivery', 6=>'Delivered');
	}
	
	public function generateOTP()
	{
		return rand(1111,99999);
	}
	
	public function sendMail($toEmail, $fromEmail, $fromName, $subject, $body, $isHTML)
	{
		if($isHTML)
		{
			Yii::$app->mailer->compose()
				->setTo($toEmail)
				->setFrom([$fromEmail => $fromName])
				->setSubject($subject)
				->setHtmlBody($body)
				->send();
		}
		else
		{
			Yii::$app->mailer->compose()
				->setTo($toEmail)
				->setFrom([$fromEmail => $fromName])
				->setSubject($subject)
				->setTextBody($body)
				->send();
		}
		
		return true;
	}
	
	public function getDatePickerDateFormat()
	{
		return "yyyy-MM-dd";
	}


	public function getMenuCourseTypeAssoc()
 	{
		  $sql = "SELECT  menuCourseTypeID,type
		    	  FROM res_menu_course_type
		    	  ORDER BY type";
		    
		  return Core::getDropdownAssoc($sql);
 	}

 	public function getCourseTypeName($id)
 	{
 		return Core::getData("SELECT `type` from `res_menu_course_type` WHERE `menuCourseTypeID` = '$id'");
 	}

 	public function getCountryName($code)
 	{
 		return Core::getData("SELECT `title` from `app_country` WHERE `countryCode` = '$code'");
 	}

 	public function getProvinceName($id)
 	{
 		return Core::getData("SELECT `title` from `app_province` WHERE `provinceID` = '$id'");
 	}

 	public function getCityName($id)
 	{
 		return Core::getData("SELECT `title` from `app_city` WHERE `cityID` = '$id'");
 	}

 	public function getDeliveryLocationName($id)
 	{
 		return Core::getData("SELECT `title` from `res_delivery_location` WHERE `deliveryLocationID` = '$id'");
 	}

 	public function getRestaurantName($id)
 	{
 		return Core::getData("SELECT `name` from `res_restaurants` WHERE `restaurantID` = '$id'");
 	}
	
	function randomPassword($noOfChars)
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array();
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < $noOfChars; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass);
	}

	public function getCountryAssoc()
	{
		$sql = "SELECT countryCode,title
		    	FROM app_country
		    	ORDER BY title";
		return Core::getDropdownAssoc($sql);
	}

    public function getProvinceAssoc($countryCode = '')
 	{
		$sql = "SELECT provinceID,title as name
    	  FROM app_province";

		if($countryCode)
		{
			$sql .= " WHERE countryCode = '$countryCode'";
		}
		$sql .= " ORDER BY title";
		return Core::getDropdownAssoc($sql);
 	}

 	public function getCityAssoc($provinceID = 0)
 	{
		$sql = "SELECT cityID,title as name
		    	  FROM app_city";

		if($provinceID > 0)
		{
			$sql .= " WHERE provinceID = '$provinceID'";
		}
		$sql .= " ORDER BY title";
		    
		return Core::getDropdownAssoc($sql);
 	}

 	public function getDeliverylocationAssoc($cityID = 0)
 	{
		$sql = "SELECT deliveryLocationID,title as name
		    	  FROM res_delivery_location";

		if($cityID > 0)
		{
			$sql .= " WHERE cityID = '$cityID'";
		}
		$sql .= " ORDER BY title";
		    
		return Core::getDropdownAssoc($sql);
 	}

 	public function getCityAgainstsProvinceAssoc($provinceID = 0)
 	{
		$sql = "SELECT cityID,title as name
		    	  FROM app_city";

		if($provinceID > 0)
		{
			$sql .= " WHERE provinceID = '$provinceID'";
		}
		$sql .= " ORDER BY title";
		    
		return Core::getDropdownAssoc($sql);
 	}
 	
 	public function getLocationAgainstsCityAssoc($cityID = 0)
 	{
		$sql = "SELECT deliveryLocationID,title as name
		    	  FROM res_delivery_location";

		if($cityID > 0)
		{
			$sql .= " WHERE cityID = '$cityID'";
		}
		$sql .= " ORDER BY title";
		    
		return Core::getDropdownAssoc($sql);
 	}

 	public function generateRestaurantCode($restaurantID)
 	{
 		return self::RESTAURANT_CODE_PREFIX.sprintf("%04d", $restaurantID);
 	}

 	public function restaurantUploadPath()
 	{
 		$sDirPath = Yii::$app->basePath . '/web/uploads/';
		if (!file_exists ($sDirPath))
		{
			mkdir($sDirPath,0777,true);
 			$sDirPath2 = Yii::$app->basePath . '/web/uploads/restaurant/';
 			if (!file_exists ($sDirPath2))
			{
				mkdir($sDirPath2,0777,true);
			}			
		}
 		return '/web/uploads/restaurant/';
 	}

 	public function getWeekAssoc()
 	{
		return array(1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thrusday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday');
 	}

	public function getRestaurentDetailFromOrder($orderID)
	{
		$restaurentDetail = Core::getRow("SELECT res.name, res.countryCode, res.provinceID, res.cityID, res.deliveryLocationID, res.contactAddress FROM res_restaurants res INNER JOIN ord_order ord ON res.restaurantID = ord.restaurantID WHERE ord.orderID = '$orderID'");
		
		return $restaurentDetail;
	}

 	public function getSuggestedCityAssoc($searchText, $provinceID = 0, $limit = 0)
 	{
		$sql = "SELECT cityID, countryCode, provinceID, title
		    	  FROM app_city";
		$sql .= " WHERE isActive = 1";

		if($provinceID > 0)
		{
			$sql .= " AND provinceID = '$provinceID'";
		}
		
		if($searchText != '')
		{
			$sql .= " AND title LIKE '%$searchText%'";
		}
		$sql .= " ORDER BY title";
		if($limit > 0)
		{
			$sql .= " LIMIT $limit";
		}
		
		return Core::getRows($sql);
 	}
}