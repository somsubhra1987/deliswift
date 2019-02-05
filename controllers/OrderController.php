<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Restaurant;
use app\models\Customer;
use app\models\LoginForm;
use app\models\Cart;
use app\models\Order;
use app\models\Otp;
use app\lib\App;
use app\lib\Core;

class OrderController extends Controller
{
	public function actionViewrestaurant($restaurantID)
	{
		$featuredRestaurantArr = Restaurant::getFeaturedRestaurant();
		$restaurantModel = $this->findRestaurantModel($restaurantID);
		$menuItemTypeWiseDetailArr = Restaurant::getMenuDetailCourseTypeWise($restaurantID);
		
		return $this->render('/viewrestaurant/view', [
			'model' => $restaurantModel,
			'menuItemTypeWiseDetailArr' => $menuItemTypeWiseDetailArr,
			'featuredRestaurantArr' => $featuredRestaurantArr,
		]);
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
		$session = Yii::$app->session;
		if(!$session->isActive) { $session->open(); }
		$userIP = Yii::$app->request->getUserIP();
		$userSession = $session->getId();
		$customerID = 0;
		
		if($session->has('loggedCustomerID'))
		{
			$customerID = $session->get('loggedCustomerID');
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
	
	public function actionViewcart($restaurantID)
	{
		$session = Yii::$app->session;
		if(!$session->isActive) { $session->open(); }
		$userIP = Yii::$app->request->getUserIP();
		$userSession = $session->getId();
		$customerID = 0;
		
		if($session->has('loggedCustomerID'))
		{
			$customerID = $session->get('loggedCustomerID');
		}
		
		$restaurant = App::getRestaurantDetail($restaurantID);
		$cartDetailArr = Cart::getCartDetail($restaurantID, $customerID, $userIP, $userSession);
		
		return $this->render('viewcart', [
			'restaurantID' => $restaurant['restaurantID'],
			'cartDetailArr' => $cartDetailArr,
		]);
	}
	
	public function actionAddtocart()
	{
		$postDataArr = Yii::$app->request->post();
		if(count($postDataArr) > 0)
		{
			$session = Yii::$app->session;
			if(!$session->isActive) { $session->open(); }
			$userIP = Yii::$app->request->getUserIP();
            $userSession = $session->getId();
			$qty = $postDataArr['qty'];
			$customerID = 0;
			
			if($session->has('loggedCustomerID'))
			{
				$customerID = $session->get('loggedCustomerID');
			}
			
			$cartID = Core::getData("SELECT cartID FROM ord_cart WHERE menuItemID = '$postDataArr[menuItemID]' AND restaurantID = '$postDataArr[restaurantID]' AND customerID = '$customerID' AND sessionID = '$userSession'");
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
					$renderDataDiv = $this->renderAjax('_viewcart', ['restaurantID' => $postDataArr['restaurantID'], 'cartDetailArr' => $cartDetailArr, 'showCartInMobile' => $postDataArr['showCartInMobile']]);
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
				$renderDataDiv = $this->renderAjax('_viewcart', ['restaurantID' => $postDataArr['restaurantID'], 'cartDetailArr' => $cartDetailArr, 'showCartInMobile' => $postDataArr['showCartInMobile']]);
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
		$otpDetail = Core::getRow("SELECT otpID, customerName FROM phn_otp WHERE phoneNumber = '$phoneNumber' AND isExpired = 0 AND useFor = 'confirm_order'");
		if($otpDetail['otpID'] > 0)
		{
			$model = $this->findOtpModel($otpDetail['otpID']);
			
			if ($model->load(Yii::$app->request->post()))
			{
				$model->setscenario('verify_phone');
				if($model->validate())
				{
					App::updateRecord('phn_otp', ['isExpired' => 1], ['otpID' => $model->otpID]);
					$customerID = 0;
					if(Yii::$app->session->has('loggedCustomerID'))
					{
						$customerID = Yii::$app->session->get('loggedCustomerID');
					}
					
					if($customerID == 0)
					{
						$userIP = Yii::$app->request->getUserIP();
						$session = Yii::$app->session;
						if(!$session->isActive) { $session->open(); }
						$userSession = $session->getId();
						$loginModel = new LoginForm();
						
						$customerDetail = Core::getRow("SELECT customerID, password FROM cust_customer WHERE phoneNumber = '$phoneNumber'");
						$customerID = $customerDetail['customerID'];
						if($customerID > 0)
						{
							$loginModel->isPasswordHash = 1;
							$password = $customerDetail['password'];
						}
						else
						{
							$customerModel = new Customer();
							$nameArr = explode(' ', $otpDetail['customerName']);
							$lastName = '';
							if(count($nameArr) > 1)
							{
								$lastName = array_pop($nameArr);
							}
							$firstName = implode(' ', $nameArr);
							$password = App::randomPassword(6);
							$customerModel->firstName = $firstName;
							$customerModel->lastName = $lastName;
							$customerModel->password = $password;
							$customerModel->phoneNumber = $phoneNumber;
							$customerModel->confirmPassword = $customerModel->password;
							$customerModel->isActive = 1;
							$customerModel->isMobileVerified = 1;
							$lastSelectedCityID = Core::getData("SELECT lastSelectedCityID FROM app_ip_address_city WHERE ipAddress = '$userIP'");
							$customerModel->lastSelectedCityID = $lastSelectedCityID;
							$loginModel->isPasswordHash = 0;
							if($customerModel->save())
							{
								$customerID = $customerModel->customerID;
							}
							else
							{
								$errorSummary = Html::errorSummary($customerModel); 
								exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
							}
						}
						$loginModel->emailAddress = $phoneNumber;
						$loginModel->password = $password;
						if($loginModel->login())
						{
							App::updateRecord('ord_cart', ['customerID' => $customerID], ['sessionID' => $userSession]);
						}
						else
						{
							$errorSummary = Html::errorSummary($loginModel); 
							exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
						}
					}
					
					$checkoutUrl = Yii::$app->urlManager->createUrl(['user/checkout', 'restaurantID' => $model->restaurantID]);
					exit(json_encode(array('result' => 'success', 'redirectUrl' => $checkoutUrl)));
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
	
	public function actionPlaceorder()
	{
		$postDataArr = Yii::$app->request->post();
		if(count($postDataArr) > 0)
		{
			$customerID = Yii::$app->session->get('loggedCustomerID');
			$restaurantID = $postDataArr['resID'];
			
			
			$orderModel = new Order();
			$orderModel->customerID = $customerID;
			$orderModel->restaurantID = $restaurantID;
		}
		else
		{
			$error = array('statusCode' => 400, 'message' => 'Something went wrong', 'name' => 'Oops');
            return $this->render('@app/views/site/error', ['error' => $error]);
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
	
	protected function findRestaurantModel($id)
    {
        if (($model = Restaurant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}