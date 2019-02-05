<?php

namespace app\modules\delivery\controllers;

use Yii;
use yii\helpers\Html;
use app\modules\delivery\ControllerDelivery;
use app\modules\delivery\models\Order;
use app\modules\delivery\models\DeliveryBoyOrderCancel;
use app\lib\Core;
use app\lib\App;

class OrderController extends ControllerDelivery
{
    public function actionGetnewordercount()
    {
        $loggedDeliveryBoyID = Yii::$app->session['loggedDeliveryBoyID'];
		$orderID = Core::getData("SELECT orderID FROM ord_order WHERE assignedDeliveryBoyID = '$loggedDeliveryBoyID' AND orderStatus = 3");
		
		return $orderID;
    }

	public function actionConfirmneworder($orderID)
	{
		$loggedDeliveryBoyID = Yii::$app->session['loggedDeliveryBoyID'];
		$restaurentDetail = App::getRestaurentDetailFromOrder($orderID);
		$model = $this->findModel($orderID);
		
		$renderDataDiv = $this->renderPartial('confirmneworder', ['model' => $model, 'deliveryBoyID' => $loggedDeliveryBoyID, 'restaurentDetail' => $restaurentDetail]);
		exit(json_encode(['result' => 'success', 'renderDataDiv' => $renderDataDiv]));
	}
	
	public function actionConfirmorder($orderID)
	{
		$model = $this->findModel($orderID);
		$model->orderStatus = 4;
		if($model->save())
		{
			$loggedDeliveryBoyID = Yii::$app->session['loggedDeliveryBoyID'];
			$deliveryBoyDetail = Core::getDeliveryBoy($loggedDeliveryBoyID);
			$todayOrderCount = $deliveryBoyDetail->todayOrderCount + 1;
			
			App::updateRecord( "dlv_delivery_boy", array('lastOrderID' => $orderID) , array('deliveryBoyID' => $loggedDeliveryBoyID) );
			$redirectUrl = Yii::$app->urlManager->createUrl(['delivery/order/viewcurrentorder']);
			exit(json_encode(['result' => 'success', 'redirectUrl' => $redirectUrl]));
		}
		else
		{
			exit(json_encode(['result' => 'error', 'message' => 'Something went wrong']));
		}
	}
	
	public function actionCancelorder($orderID)
	{
		$model = $this->findModel($orderID);
		$model->orderStatus = 2;
		$model->assignedDeliveryBoyID = 0;
		if($model->save())
		{
			$loggedDeliveryBoyID = Yii::$app->session['loggedDeliveryBoyID'];
			App::updateRecord( "dlv_delivery_boy", array('isEngaged' => 0) , array('deliveryBoyID' => $loggedDeliveryBoyID) );
			
			$deliveryBoyOrderCancel = new DeliveryBoyOrderCancel();
			$deliveryBoyOrderCancel->deliveryBoyID = $loggedDeliveryBoyID;
			$deliveryBoyOrderCancel->orderID = $orderID;
			$deliveryBoyOrderCancel->save();
			
			exit(json_encode(['result' => 'success']));
		}
		else
		{
			exit(json_encode(['result' => 'error', 'message' => 'Something went wrong']));
		}
	}
	
	public function actionViewcurrentorder()
	{
		$loggedDeliveryBoyID = Yii::$app->session['loggedDeliveryBoyID'];
		$deliveryBoyDetail = Core::getDeliveryBoy($loggedDeliveryBoyID);
		$orderID = $deliveryBoyDetail->lastOrderID;
		if($orderID > 0)
		{
			$model = $this->findModel($orderID);
			if($model->load(Yii::$app->request->post()))
			{
				if($model->orderStatus == 4)
				{
					$model->orderStatus = 6;
					if($model->save())
					{
						$floatingCash = round($deliveryBoyDetail->floatingCash + $model->totalAmount, 2);
						App::updateRecord( "dlv_delivery_boy", array('isEngaged' => 0, 'floatingCash' => $floatingCash, 'lastOrderID' => 0) , array('deliveryBoyID' => $loggedDeliveryBoyID) );
						
						Yii::$app->session->setFlash('success', 'Order delivered successfully');
						return $this->redirect(['/delivery/dashboard']);
					}
					else
					{
						Yii::$app->session->setFlash('error', Html::errorSummary($model));
					}
				}
				else
				{
					Yii::$app->session->setFlash('error', 'Order status already changed. Please contact administrator');
				}
				return $this->redirect(['/delivery/order/viewcurrentorder']);
			}
	
			$deliveryAddressDetail = $model->getOrderDeliveryAddress($model->orderID);
			$orderItemDetailArr = $model->getOrderItems($model->orderID);
			
			return $this->render('orderdetail', ['model' => $model, 'deliveryAddressDetail' => $deliveryAddressDetail, 'orderItemDetailArr' => $orderItemDetailArr]);
		}
		else
		{
			Yii::$app->session->setFlash('error', 'No recent order found');
			return $this->redirect(['/delivery/dashboard']);
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
}
