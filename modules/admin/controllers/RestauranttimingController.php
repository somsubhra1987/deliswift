<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Restauranttiming;
use app\modules\admin\models\RestauranttimingSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;

/**
 * RestauranttimingController implements the CRUD actions for Restauranttiming model.
 */
class RestauranttimingController extends ControllerAdmin
{
    const RESTIMG_CREATE_SUCCESSFUL    = "Restaurant Timing created successfully ";
    const RESTIMG_DELETE_SUCCESSFUL    = "Restaurant Timing deteted successfully ";
    const RESTIMG_UPDATE_SUCCESSFUL    = "Restaurant Timing updated successfully ";
    const RESTIMG_OPERATION_FAILS      = "Error ! Operation failed ";


    /**
     * Lists all Restauranttiming models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RestauranttimingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Restauranttiming model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Restauranttiming model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Restauranttiming();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->restaurantTimingID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    public function actionAjaxcreate($restaurantID)
    {
        $model = new Restauranttiming;
        $model->restaurantID = $restaurantID;

        if ($model->load(Yii::$app->request->post())) 
        {
            if($model->save())
            {
                $restauranttimingSearchModel = new RestauranttimingSearch;
                $restauranttimingSearchModel->restaurantID = $restaurantID;
                $restauranttimingDataProvider = $restauranttimingSearchModel->search(Yii::$app->request->queryParams);
                
                $renderDataDiv = Yii::$app->controller->renderPartial('index', ['model' => $model,'searchModel' => $restauranttimingSearchModel,'dataProvider' => $restauranttimingDataProvider, 'restaurantID' => $restaurantID]);

                $msg = self::RESTIMG_CREATE_SUCCESSFUL;
                $divAppend = 'Restauranttiming';
                exit(json_encode(['result' => 'success', 'msg' => $msg, 'renderDataDiv' => $renderDataDiv, 'divAppend' => $divAppend]));
            }
            else
            {
                $errorSummary = Html::errorSummary($model); 
                exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
            }
        } 
        else 
        {
            $restauranttimingCreateUrl = Yii::$app->urlManager->createUrl(['admin/restauranttiming/ajaxcreate','restaurantID' => $restaurantID]);
            return $this->renderPartial('create', [
            'model' => $model,
            'restauranttimingCreateUrl' => $restauranttimingCreateUrl,
            ]);
        }

    }


    /**
     * Updates an existing Restauranttiming model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->restaurantTimingID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Restauranttiming model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Restauranttiming model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Restauranttiming the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Restauranttiming::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
