<?php
namespace app\lib;
use Yii;
use app\lib\Core;

class App extends \yii\db\ActiveRecord {
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
	
	public function getProfessionalCodeAssoc()
 	{
		$sql = "SELECT professionCode as id,professionDesc as name
		    	FROM professional_code
		    	ORDER BY professionDesc";

		$professionalCodeArr = Core::getDropdownAssoc($sql);

		return $professionalCodeArr;
 	}
	
	public function getUniqueProfessionalID($professionalCode)
	{
		$newProfessionalCode = '';
		while($newProfessionalCode == '')
		{
			$profCode = $professionalCode.rand(111111, 999999);
			$profID = Core::getData("SELECT professionalUserID FROM professional_user_code WHERE professionalID = '$profCode'");
			if($profID == 0)
			{
				$newProfessionalCode = $profCode;
			}
		}
		
		return $newProfessionalCode;
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
}