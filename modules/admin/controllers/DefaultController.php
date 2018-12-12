<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\admin\models\AdminLoginForm;
use app\lib\Core;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
		if(isset(Yii::$app->user->identity->id))
		{
            return $this->redirect(Yii::$app->getHomeUrl() . "admin/dashboard");
	    }
        return $this->actionLogin();
    }
    
    public function actionLogin()
    {
	    $this->layout = "@app/web/themes/backend/adminlte/templates/Login/Page";
	    
        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->getHomeUrl() . "admin/dashboard");
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        
//         Yii::$app->session->remove('loggedAdminID');
		Yii::$app->session->removeAll();

        return $this->redirect(Yii::$app->getHomeUrl() . "admin");
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
	   		return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl().'admin')->send();
        }
    }
}
