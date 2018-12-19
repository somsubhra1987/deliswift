<?php

namespace app\modules\delivery\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\delivery\models\DeliveryLoginForm;
use app\lib\Core;

/**
 * Default controller for the `delivery` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
		if(isset(Yii::$app->user->identity->id))
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
            return $this->redirect(Yii::$app->getHomeUrl() . "delivery/dashboard");
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
		Yii::$app->session->removeAll();

        return $this->redirect(Yii::$app->getHomeUrl() . "delivery");
    }
	
	#== Handle system error redirection ==#
    
    public function actionError()
    {
        if(Core::getLoggedUserID() > 0)
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
