<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use app\lib\UserParentController;
use app\lib\Core;
use app\models\Cart;

class UserController extends UserParentController
{
	public function actionCheckout($restaurantID)
	{
		$this->view->params['headerSearchBoxStatus'] = 0;
		$userIP = Yii::$app->request->getUserIP();
		$userSession = Yii::$app->session->getId();
		$customerDetail = Core::getLoggedCustomer();
		$cartDetailArr = Cart::getCartDetail($restaurantID, $customerDetail->customerID, $userIP, $userSession);
		
		return $this->render('checkout', ['restaurantID' => $restaurantID, 'customerDetail' => $customerDetail, 'cartDetailArr' => $cartDetailArr]);
	}
}