<?php

namespace app\modules\restaurant\controllers;

use Yii;
use yii\helpers\Html;
use app\modules\restaurant\ControllerRestaurant;
use app\modules\restaurant\models\Order;
use app\modules\restaurant\models\RestaurantOrderCancel;
use app\lib\Core;
use app\lib\App;

class OrderController extends ControllerRestaurant
{
    public function actionGetnewordercount()
    {
        $loggedRestaurantID = Yii::$app->session['loggedRestaurantID'];
		$orderID = Core::getData("SELECT orderID FROM ord_order WHERE restaurantID = '$loggedRestaurantID' AND orderStatus = 1 ORDER BY orderID ASC LIMIT 1");
		
		return $orderID;
    }

	public function actionConfirmneworder($orderID)
	{
		$model = $this->findModel($orderID);
		$orderDetail = '';
		
		$renderDataDiv = $this->renderPartial('confirmneworder', ['model' => $model, 'orderDetail' => $orderDetail]);
		exit(json_encode(['result' => 'success', 'renderDataDiv' => $renderDataDiv]));
	}
	
	public function actionConfirmorder($orderID)
	{
		$model = $this->findModel($orderID);
		$model->orderStatus = 2;
		if($model->save())
		{
			$redirectUrl = Yii::$app->urlManager->createUrl(['restaurant/order/viewrecentorder']);
			exit(json_encode(['result' => 'success', 'redirectUrl' => $redirectUrl]));
		}
		else
		{
			exit(json_encode(['result' => 'error', 'message' => 'Something went wrong']));
		}
	}
	
	public function actionViewrecentorder()
	{
		$model = new Order();
		return $this->render('orderdetail', ['model' => $model]);
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
