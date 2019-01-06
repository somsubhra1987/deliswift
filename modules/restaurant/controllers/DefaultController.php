<?php

namespace app\modules\restaurant\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\restaurant\models\RestaurantLoginForm;
use app\lib\Core;

/**
 * Default controller for the `restaurant` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
		if(isset(Yii::$app->user->identity->id) && isset(Yii::$app->session['loggedRestaurantID']) && Yii::$app->session['loggedRestaurantID'] > 0)
		{
            return $this->redirect(Yii::$app->getHomeUrl() . "restaurant/dashboard");
	    }
        return $this->actionLogin();
    }
    
    public function actionLogin()
    {
	    $this->layout = "@app/web/themes/restaurant/default/templates/Login/Page";
	    
        $model = new RestaurantLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->getHomeUrl() . "restaurant/dashboard");
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
		Yii::$app->session->removeAll();

        return $this->redirect(Yii::$app->getHomeUrl() . "restaurant");
    }
	
	#== Handle system error redirection ==#
    
    public function actionError()
    {
        if(Core::getLoggedRestaurantID() > 0)
        {
	   	    $exception = Yii::$app->errorHandler->exception;
	   	    $error = array('statusCode' => $exception->statusCode, 'message' => $exception->getMessage(), 'name' => $exception->getName());
   		    return $this->render('/error', ['error' => $error]);
        }
        else
        {
	   		return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl().'restaurant')->send();
        }
    }
}
