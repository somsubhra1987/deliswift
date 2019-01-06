<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Order;
use app\modules\admin\models\OrderSearch;
use app\modules\admin\models\DeliveryBoy;
use app\lib\App;
use yii\web\NotFoundHttpException;
use app\modules\admin\ControllerAdmin;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends ControllerAdmin
{
    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	#== assign order to delivery boy ==#
	public function actionAssigntodeliveryboy($id, $deliveryBoyID = 0)
	{
		$model = $this->findModel($id);

        if ($deliveryBoyID > 0) 
        {
            if($model->orderStatus == 2)
			{
				$model->orderStatus = 3;
				$model->assignedDeliveryBoyID = $deliveryBoyID;
				
				$deliveryBoyModel = $this->findDeliveryBoyModel($deliveryBoyID);
				if($deliveryBoyModel->isEngaged == 0)
				{
					$todayOrderCount = $deliveryBoyModel->todayOrderCount;
					$deliveryBoyModel->isEngaged = 1;
					$deliveryBoyModel->todayOrderCount = $todayOrderCount + 1;
					if($deliveryBoyModel->save())
					{
						if($model->save())
						{
							exit(json_encode(array('result' => 'success', 'divAppend' => 'OrderView', 'msg' => 'Successfully assigned')));
						}
						else
						{
							$deliveryBoyModel->isEngaged = 0;
							$deliveryBoyModel->todayOrderCount = $todayOrderCount - 1;
							$deliveryBoyModel->save();
							
							exit(json_encode(array('result' => 'error', 'msg' => 'Something went wrong, order is not assigned to any delivery boy')));
						}
					}
					else
					{
						exit(json_encode(array('result' => 'error', 'msg' => 'Something went wrong, delivery boy not assigned')));
					}
				}
				else
				{
					exit(json_encode(array('result' => 'error', 'msg' => $deliveryBoyModel->name.' is not available')));
				}
			}
			else
			{
				exit(json_encode(array('result' => 'error', 'msg' => $model->orderID.' is already '.App::getOrderStatusAssoc()[$model->orderStatus])));
			}
        } 
        else 
        {
			$availableDeliveryBoyArr = DeliveryBoy::getAvailableDeliveryBoy();
            return $this->renderAjax('_listavailabledeliveryboy', [
				'model' => $model,
				'availableDeliveryBoyArr' => $availableDeliveryBoyArr,
            ]);
        }
	}

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	protected function findDeliveryBoyModel($id)
    {
        if (($model = DeliveryBoy::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
