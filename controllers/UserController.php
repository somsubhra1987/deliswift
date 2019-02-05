<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use app\lib\UserParentController;
use app\lib\Core;
use app\lib\App;
use app\models\Cart;
use app\models\Order;
use app\models\OrderItem;
use app\models\PaymentMethod;
use app\models\PaymentInfo;
use app\models\CustomerAddress;
use app\models\DeliveryAddress;

class UserController extends UserParentController
{
	public function actionCheckout($restaurantID)
	{
		$model = new Order();
		$model->setscenario('order_create');
		$customerDetail = Core::getLoggedCustomer();
		
		if($model->load(Yii::$app->request->post()))
		{
			$saveStatus = 1;
			foreach($model->cartID as $key => $cartID)
			{
				$cartCount = Core::getData("SELECT COUNT(cartID) FROM ord_cart WHERE cartID = '$cartID'");
				if($cartCount == 0)
				{
					$saveStatus = 0;
					break;
				}
			}
			if($saveStatus == 1)
			{
				$model->customerID = $customerDetail->customerID;
				$model->restaurantID = $restaurantID;
				if($model->save())
				{
					foreach($model->cartID as $key => $cartID)
					{
						$orderItemModel = new OrderItem();
						$cartModel = $this->findCartModel($cartID);
						$orderItemModel->orderID = $model->orderID;
						$orderItemModel->menuItemID = $cartModel->menuItemID;
						$orderItemModel->qty = $cartModel->qty;
						$orderItemModel->price = $model->itemPrice[$key];
						$orderItemModel->totalAmount = $model->itemAmount[$key];
						if($orderItemModel->save())
						{
							$cartModel->delete();
						}
					}
					
					#== Save payment info ==#
					$paymentInfoModel = new PaymentInfo();
					$paymentInfoModel->orderID = $model->orderID;
					$paymentInfoModel->paymentMethodID = $model->paymentMethodID;
					$paymentInfoModel->paymentAmount = $model->totalAmount;
					$paymentInfoModel->save();
					
					#== Save delivery address ==#
					$customerAddressModel = $this->findCustomerAddressModel($model->deliveryAddressID);
					$deliveryLocationDetail = App::getDeliveryLocationDetail($customerAddressModel->deliveryLocationID);
					$deliveryAddressModel = new DeliveryAddress();
					$deliveryAddressModel->orderID = $model->orderID;
					$deliveryAddressModel->customerName = trim($customerDetail->firstName.' '.$customerDetail->lastName);
					$deliveryAddressModel->phoneNumber = $customerDetail->phoneNumber;
					$deliveryAddressModel->deliveryLocation = $deliveryLocationDetail['name'];
					$deliveryAddressModel->cityName = App::getCityName($deliveryLocationDetail['cityID']);
					$deliveryAddressModel->provinceName = App::getProvinceName($deliveryLocationDetail['provinceID']);
					$deliveryAddressModel->countryName = App::getCountryName($deliveryLocationDetail['countryCode']);
					$deliveryAddressModel->address = $customerAddressModel->address;
					$deliveryAddressModel->deliveryInstruction = $customerAddressModel->deliveryInstruction;
					$deliveryAddressModel->otherAddressType = $customerAddressModel->otherAddressType;
					$deliveryAddressModel->save();
						
					return $this->redirect(['ordersucess', 'orderID' => $model->orderID]);
				}
			}
			else
			{
				return $this->redirect(['/order/orderonline', 'restaurantID' => $restaurantID]);
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
	
	public function actionOrdersucess($orderID)
	{
		$model = $this->findOrderModel($orderID);
		
		Yii::$app->session->setFlash('success', 'Order placed successfully');
		return $this->render('ordersuccess', ['model' => $model]);
	}
	
	protected function findOrderModel($id)
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
	
	protected function findCustomerAddressModel($id)
    {
        if (($model = CustomerAddress::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}