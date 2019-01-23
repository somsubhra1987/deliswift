<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use app\lib\UserParentController;
use app\lib\Core;
use app\models\Cart;
use app\models\Order;
use app\models\PaymentMethod;

class UserController extends UserParentController
{
	public function actionCheckout($restaurantID)
	{
		$model = new Order();
		$model->setscenario('order_create');
		$customerDetail = Core::getLoggedCustomer();
		
		if($model->load(Yii::$app->request->post()))
		{
			$model->customerID = $customerDetail->customerID;
			$model->restaurantID = $restaurantID;
			if($model->save())
			{
			
			}
		}
		
		$this->view->params['headerSearchBoxStatus'] = 0;
		$userIP = Yii::$app->request->getUserIP();
		$userSession = Yii::$app->session->getId();
		$cartDetailArr = Cart::getCartDetail($restaurantID, $customerDetail->customerID, $userIP, $userSession);
		$paymentMethodModel = new PaymentMethod();
		$paymentMethodModel->lastUsedPaymentMethodID = 1;
		$paymentMethodModel->getAvailablePaymentMethods();
		
		return $this->render('checkout', ['model' => $model, 'paymentMethodModel' => $paymentMethodModel, 'restaurantID' => $restaurantID, 'customerDetail' => $customerDetail, 'cartDetailArr' => $cartDetailArr]);
		
	}
}