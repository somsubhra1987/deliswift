<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Restaurant;
use app\models\Cart;
use app\models\Order;
use app\models\Otp;
use app\lib\App;
use app\lib\Core;

class OrderController extends Controller
{
	public function actionViewrestaurant($restaurantID)
	{
		return $this->render('/viewrestaurant/view');
	}
	
	public function actionOrderfoodonline($deliveryLocation, $page = 1, $sortDesc = 'createdDatetime')
	{
		$this->view->params['headerSearchBoxStatus'] = 0;
		$deliveryLocationDetailArr = App::getDeliveryLocationDetail($deliveryLocation);
		$restaurantArr = Restaurant::getRestaurantsInDeliveryLocation($deliveryLocation, $page, $sortDesc);
		return $this->render('orderfoodonline', [
			'deliveryLocationDetailArr' => $deliveryLocationDetailArr,
			'restaurantArr' => $restaurantArr,
		]);
	}
	
	public function actionOrderonline($restaurantID)
	{
		$userIP = Yii::$app->request->getUserIP();
		$userSession = Yii::$app->session->getId();
		$customerID = 0;
		
		if(Yii::$app->session->has('loggedCustomerID'))
		{
			$customerID = Yii::$app->session->get('loggedCustomerID');
		}
			
		$this->view->params['headerSearchBoxStatus'] = 0;
		$restaurant = App::getRestaurantDetail($restaurantID);
		$menuItemTypeWiseDetailArr = Restaurant::getMenuDetailCourseTypeWise($restaurantID);
		$cartDetailArr = Cart::getCartDetail($restaurantID, $customerID, $userIP, $userSession);
		
		return $this->render('orderonline', [
			'restaurant' => $restaurant,
			'menuItemTypeWiseDetailArr' => $menuItemTypeWiseDetailArr,
			'cartDetailArr' => $cartDetailArr,
		]);
	}
	
	public function actionAddtocart()
	{
		$postDataArr = Yii::$app->request->post();
		if(count($postDataArr) > 0)
		{
			$userIP = Yii::$app->request->getUserIP();
            $userSession = Yii::$app->session->getId();
			$qty = $postDataArr['qty'];
			$customerID = 0;
			
			if(Yii::$app->session->has('loggedCustomerID'))
			{
				$customerID = Yii::$app->session->get('loggedCustomerID');
			}
			
			$cartID = Core::getData("SELECT cartID FROM ord_cart WHERE menuItemID = '$postDataArr[menuItemID]' AND restaurantID = '$postDataArr[restaurantID]' AND customerID = '$customerID' AND userIP = '$userIP' AND sessionID = '$userSession'");
			if($cartID == 0)
			{
				$model = new Cart();
			}
			else
			{
				$model = $this->findCartModel($cartID);
			}
			
			if($qty > 0)
			{
				$model->menuItemID = $postDataArr['menuItemID'];
				$model->qty = $qty;
				$model->restaurantID = $postDataArr['restaurantID'];
				$model->customerID = $customerID;
				$model->userIP = $userIP;
				$model->sessionID = $userSession;
				if($model->save())
				{
					$cartDetailArr = Cart::getCartDetail($postDataArr['restaurantID'], $customerID, $userIP, $userSession);
					$renderDataDiv = $this->renderAjax('viewcart', ['restaurantID' => $postDataArr['restaurantID'], 'cartDetailArr' => $cartDetailArr]);
					exit(json_encode(['result' => 'success', 'renderDataDiv' => $renderDataDiv]));
				}
				else
				{
					exit(json_encode(array('result' => 'error', 'msg' => 'Something went wrong')));
				}
			}
			else
			{
				$model->delete();
				$cartDetailArr = Cart::getCartDetail($postDataArr['restaurantID'], $customerID, $userIP, $userSession);
				$renderDataDiv = $this->renderAjax('viewcart', ['restaurantID' => $postDataArr['restaurantID'], 'cartDetailArr' => $cartDetailArr]);
				exit(json_encode(['result' => 'success', 'renderDataDiv' => $renderDataDiv]));
			}
		}
		else
		{
			$error = array('statusCode' => 400, 'message' => 'Something went wrong', 'name' => 'Oops');
            return $this->render('@app/views/site/error', ['error' => $error]);
		}
	}
	
	public function actionConfirmphone()
	{
		$model = new Otp();
		$model->setscenario('confirm_phone');
		$model->phoneNumber = '';
		$model->customerName = '';
		$model->useFor = 'confirm_order';
		
		if(Yii::$app->session->has('loggedCustomerID'))
		{
			$loggedCustomerDetail = Core::getLoggedCustomer();
			$model->phoneNumber = $loggedCustomerDetail->phoneNumber;
			$model->customerName = $loggedCustomerDetail->name;
		}
		
		if ($model->load(Yii::$app->request->post()))
		{
			$model->otpSent = App::getOTP(4);
			if($model->save())
			{
				$message = $model->otpSent.' is your '.Yii::$app->name.' verification code.';
				if(App::sendSMS($model->phoneNumber, $message))
				{
					exit(json_encode(array('result' => 'success', 'msg' => $model->phoneNumber)));
				}
				else
				{
					exit(json_encode(array('result' => 'error', 'msg' => 'Someting went wrong. Please try again')));
				}
			}
			else
			{
				$errorSummary = Html::errorSummary($model); 
	            exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
			}
		}
		else
		{
			$confirmPhoneUrl = Yii::$app->urlManager->createUrl(['order/confirmphone']);
            return $this->renderAjax('_confirmphone', [
                'model' => $model,
                'confirmPhoneUrl' => $confirmPhoneUrl,
            ]);
		}
	}
	
	public function actionVerifyphone($phoneNumber)
	{
		$otpID = Core::getData("SELECT otpID FROM phn_otp WHERE phoneNumber = '$phoneNumber' AND isExpired = 0 AND useFor = 'confirm_order'");
		if($otpID > 0)
		{
			$model = $this->findOtpModel($otpID);
			$model->setscenario('verify_phone');
			
			if ($model->load(Yii::$app->request->post()))
			{
				if($model->validate())
				{
					App::updateRecord('phn_otp', ['isExpired' => 1], ['otpID' => $model->otpID]);
				}
				else
				{
					$errorSummary = Html::errorSummary($model); 
	            	exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
				}
			}
			else
			{
				$verifyPhoneUrl = Yii::$app->urlManager->createUrl(['order/verifyphone', 'phoneNumber' => $phoneNumber]);
				return $this->renderAjax('_verifyphone', [
					'model' => $model,
					'verifyPhoneUrl' => $verifyPhoneUrl,
				]);
			}
		}
		else
		{
			exit(json_encode(array('result' => 'error', 'msg' => 'Someting went wrong. Please try again')));
		}
	}
	
	protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	protected function findCartModel($id)
    {
        if (($model = Cart::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	protected function findOtpModel($id)
    {
        if (($model = Otp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}