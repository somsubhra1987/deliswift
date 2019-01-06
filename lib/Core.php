<?php

namespace app\lib;

use Yii;
use yii\db\Command;
use yii\helpers\FileHelper;
class Core
{
	function printR($var, $exit=true)
	{
		echo "<pre>";
		print_r($var);
		echo "</pre>";
		
		if($exit) exit();
	}
	
	public function getAssoc($sql)
	 {
	 	$arr = array();
	 	$rows = Yii::$app->db->createCommand($sql)
            ->queryAll();
		foreach($rows as $row)
		{
			$arr[$row['id']] = $row['name'];
		}
		
		return $arr;
	 }

	 public function getLoggedUserID()
	 {
	 	if(!isset(Yii::$app->user->getIdentity()->id) || !Yii::$app->user->getIdentity()->id) return 0;

	    return Yii::$app->user->getIdentity()->id;
	 }

	function getLoggedUser()
    {
	    $userID = self::getLoggedUserID();	    
	    $user = self::getUser($userID);	    
	    return $user;
    }

    function getUser($userID)
    {
    	$db = Yii::$app->db;
	    $user = new \StdClass();
	    
	    if(!$userID) return $user;
	    
	    $user->userID = $userID;
	    
	    $sql = "SELECT name, userType, username
	    		FROM app_users
	    		WHERE userID = :userID";
	    $row = self::getRow($sql, array('userID'=>$user->userID));
	    
	    $user->name = $row['name'];
	    $user->userType = $row['userType'];
	    $user->username = $row['username'];
	    $user->photo =  self::getRootUrl()."/themes/backend/adminlte/images/default-user-grey.png";
		
	    return $user;
	}
	
	#== get logged in deliver boy detail ==#

	public function getLoggedDeliveryBoyID()
	{
	 	if(!isset(Yii::$app->user->getIdentity()->id) || !Yii::$app->user->getIdentity()->id) return 0;

	    return Yii::$app->user->getIdentity()->id;
	}

	function getLoggedDeliveryBoy()
    {
	    $deliveryBoyID = self::getLoggedDeliveryBoyID();	    
	    $deliveryBoy = self::getDeliveryBoy($deliveryBoyID);	    
	    return $deliveryBoy;
    }

    function getDeliveryBoy($deliveryBoyID)
    {
    	$db = Yii::$app->db;
	    $deliveryBoy = new \StdClass();
	    
	    if(!$deliveryBoyID) return $deliveryBoy;
	    
	    $deliveryBoy->deliveryBoyID = $deliveryBoyID;
	    
	    $sql = "SELECT name, userID, isEngaged, todayOrderCount, lastOrderID, floatingCash
	    		FROM dlv_delivery_boy
	    		WHERE deliveryBoyID = :deliveryBoyID";
	    $row = self::getRow($sql, array('deliveryBoyID'=>$deliveryBoy->deliveryBoyID));
	    
	    $deliveryBoy->name = $row['name'];
		$deliveryBoy->userID = $row['userID'];
		$deliveryBoy->isEngaged = $row['isEngaged'];
		$deliveryBoy->todayOrderCount = $row['todayOrderCount'];
		$deliveryBoy->lastOrderID = $row['lastOrderID'];
		$deliveryBoy->floatingCash = $row['floatingCash'];
	    $deliveryBoy->photo =  self::getRootUrl()."/themes/frontend/default/images/default-user-grey.png";
		
	    return $deliveryBoy;
	}
	
	#== get logged in restaurant detail ==#

	public function getLoggedRestaurantID()
	{
	 	if(!isset(Yii::$app->user->getIdentity()->id) || !Yii::$app->user->getIdentity()->id) return 0;

	    return Yii::$app->user->getIdentity()->id;
	}

	function getLoggedRestaurant()
    {
	    $restaurantID = self::getLoggedRestaurantID();	    
	    $restaurant = self::getRestaurant($restaurantID);	    
	    return $restaurant;
    }

    function getRestaurant($restaurantID)
    {
    	$db = Yii::$app->db;
	    $restaurant = new \StdClass();
	    
	    if(!$restaurantID) return $restaurant;
	    
	    $restaurant->restaurantID = $restaurantID;
	    
	    $sql = "SELECT name, code, isClosed
	    		FROM res_restaurants
	    		WHERE restaurantID = :restaurantID";
	    $row = self::getRow($sql, array('restaurantID'=>$restaurant->restaurantID));
	    
	    $restaurant->name = $row['name'];
		$restaurant->code = $row['code'];
		$restaurant->isClosed = $row['isClosed'];
	    $restaurant->imagePath =  self::getRootUrl()."/themes/restaurant/default/images/default-restaurent.png";
		
	    return $restaurant;
	}

	public function getUploadedPath()
	{
		$uploadedPath = Yii::$app->basePath."/web/datafiles";
		return $uploadedPath;
	}

	public function getRootUrl()
	{
		$rootUrl = Yii::$app->request->baseUrl;
		return $rootUrl;
	}
	public function getDatafilesUrl()
	{
	  $url = self::getRootUrl() . "/datafiles";
	  return $url;
	}
	public function getUploadedUrl()
	{
	  $url = self::getDatafilesUrl();
	  return $url;
	}

	function getFileExtension($localFileName)
	{
		$localFileExt = strrchr($localFileName,".");
		$localFileExt = strtolower($localFileExt);
		return $localFileExt;
	}

	public function createErrorlist($errorArr)
	{
$errorAssoc = $errorArr;

$error = <<<EOF
<div class="error-summary">
	<p>Please fix the following errors:</p>
	<ul>
EOF;
		foreach ($errorAssoc as $key) {
			$errorData = $key[0];
$error .= <<<EOF
<li>$errorData</li>
EOF;
		}
$error .= <<<EOF
	</ul>
</div>
EOF;
return $error;
	}



	function getData($sql, $placeholders=false)
	{
		$db = Yii::$app->db;
		$cmd = $db->createCommand($sql);
		if(is_array($placeholders))
		{
			foreach($placeholders as $name=>$value)
			{
				$name = trim($name);
				if(substr($name, 0, 1) != ":") $name = ":" . $name;
			
				$cmd->bindValue($name, $value);	
			}
		}
		$data = $cmd->queryScalar();
		
		return $data;
	}

	function getRow($sql, $placeholders=false)
	{
		$db = Yii::$app->db;
		$cmd = $db->createCommand($sql);
		
		if(is_array($placeholders))
		{
			foreach($placeholders as $name=>$value)
			{
				$name = trim($name);
				if(substr($name, 0, 1) != ":") $name = ":" . $name;
			
				$cmd->bindValue($name, $value);	
			}
		}
		
		$row = $cmd->queryOne();		
		return $row;
	}
	function getRows($sql, $placeholders=false)
	{
		$db = Yii::$app->db;
		$cmd = $db->createCommand($sql);
		
		if(is_array($placeholders))
		{
			foreach($placeholders as $name=>$value)
			{
				$name = trim($name);
				if(substr($name, 0, 1) != ":") $name = ":" . $name;
			
				$cmd->bindValue($name, $value);	
			}
		}
				
		$rows = $cmd->queryAll();		
		
		return $rows;
	}

	function getLoggedAdmin()
    {
	    $admin = new \StdClass();
	    $admin->adminID = Yii::$app->session['loggedAdminID'];
	    
	    $sql = "SELECT
	    			AG.adminGroupCode,
	    			AG.super,
	    			AG.adminGroupID,
	    			AG.adminGroupCode,
	    			A.username,
	    			CONCAT(A.firstName, ' ', A.lastName) AS adminName
	    		FROM app_admin A
	    			INNER JOIN app_admin_group AG USING(adminGroupID)
	    		WHERE A.adminID = :adminID ";
	    $row = self::getRow($sql, array('adminID'=>$admin->adminID));
	    
	    $admin->groupCode = $row['adminGroupCode'];
	    $admin->superFlag =$row['super'];
	    $admin->username =$row['username'];
	    $admin->groupID =$row['adminGroupID'];
	    $admin->name =$row['adminName'];
	    $admin->groupCode =$row['adminGroupCode'];
	    
	    return $admin;
    }
	function getDropdownAssoc($sql)
	{
		$arr = array();
		
		$db = Yii::$app->db;
		
		$cmd = $db->createCommand($sql);
		$rows = $cmd->queryAll();
		
		foreach($rows as $row)
		{
			$rowArr = array();
			foreach($row as $val)
			{
				$rowArr[] = $val;
			}
			
			$arr[$rowArr[0]] = $rowArr[1];
		}

		return $arr;
	}
	function getModuleControllerAssoc($moduleCode)
	{
		$allControllerNameArr = self::getModuleControllers($moduleCode);
		
		$arr = array();
		foreach($allControllerNameArr AS $value)
		{
			$arr[$value] = $value;
		}
		
		return $arr;
	}
	
	public function getModuleControllers($moduleCode)
	{
		$allModuleNameArr = self::getAllModules();
		//App::printR($allModuleNameArr);
		
		$appModulePath = self::getModulesPath(); 
		 
		$appControllerPathArr = array();
		foreach($allModuleNameArr as $value)
		{
			if($moduleCode == $value && $value == 'root')
			{
				$appControllerPath = self::getRootPath() . DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'controllers';
				$appControllerPathArr[] = $appControllerPath;
			}
			elseif($moduleCode == $value)
			{
				$appControllerPathArr[] = $appModulePath.DIRECTORY_SEPARATOR.$value.DIRECTORY_SEPARATOR."controllers";
			}
		}
		
		$controllersArr = array();
		foreach($appControllerPathArr as $appControllerPath)
		{
            if(is_dir($appControllerPath))
            {
                $fileLists = FileHelper::findFiles($appControllerPath);            
	            foreach($fileLists as $controllerPath)
	            { 
	                $controllersArr[] = substr($controllerPath,  strrpos($controllerPath, DIRECTORY_SEPARATOR)+1,-4); 
	            	 
	            }
        	}
        }
		
        return $controllersArr;
           
    }
	

    public function getRootPath()
	{
		$rootPath = Yii::$app->basePath;
		return $rootPath;
	}

	public function getModulesPath()
	{
		$path = self::getRootPath() . "/modules";
		return $path;
	}
	
	public function getActiveClass($actionName)
	{
		return (Yii::$app->controller->action->id == $actionName) ? 'active' : '';
    }
	
	public function getSettingsValue($type)
	{
		return self::getData("SELECT `value` from `app_settings` WHERE `type` = '$type'");
	}
}
?>