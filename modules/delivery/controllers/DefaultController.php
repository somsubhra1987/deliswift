<?php

namespace app\modules\delivery\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\delivery\models\DeliveryLoginForm;
use app\lib\Core;
use app\lib\App;

/**
 * Default controller for the `delivery` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
		if(isset(Yii::$app->user->identity->id) && isset(Yii::$app->session['loggedDeliveryBoyID']) && Yii::$app->session['loggedDeliveryBoyID'] > 0)
		{
            return $this->redirect(Yii::$app->getHomeUrl() . "delivery/dashboard");
	    }
        return $this->actionLogin();
    }
    
    public function actionLogin()
    {
	    $this->layout = "@app/web/themes/frontend/default/templates/Login/Page";
	    
        $model = new DeliveryLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			$loggedDeliveryBoyID = Yii::$app->session['loggedDeliveryBoyID'];
			App::updateRecord( "dlv_delivery_boy", array('isOnDuty' => 1) , array('deliveryBoyID' => $loggedDeliveryBoyID) );
			
            return $this->redirect(Yii::$app->getHomeUrl() . "delivery/dashboard");
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
		$loggedDeliveryBoyID = Yii::$app->session['loggedDeliveryBoyID'];
		App::updateRecord( "dlv_delivery_boy", array('isOnDuty' => 0) , array('deliveryBoyID' => $loggedDeliveryBoyID) );
		
        Yii::$app->user->logout();
		Yii::$app->session->removeAll();

        return $this->redirect(Yii::$app->getHomeUrl() . "delivery");
    }
	
	#== Handle system error redirection ==#
    
    public function actionError()
    {
        if(Core::getLoggedDeliveryBoyID() > 0)
        {
	   	    $exception = Yii::$app->errorHandler->exception;
	   	    $error = array('statusCode' => $exception->statusCode, 'message' => $exception->getMessage(), 'name' => $exception->getName());
   		    return $this->render('/error', ['error' => $error]);
        }
        else
        {
	   		return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl().'delivery')->send();
        }
    }
}
