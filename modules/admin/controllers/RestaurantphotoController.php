<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Html;
use app\modules\admin\models\RestaurantPhoto;
use app\modules\admin\models\RestaurantPhotoSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\UploadedFile;
use app\lib\Core;
use app\lib\App;
use yii\web\NotFoundHttpException;

/**
 * RestaurantphotoController implements the CRUD actions for RestaurantPhoto model.
 */
class RestaurantphotoController extends ControllerAdmin
{
    /**
     * Lists all RestaurantPhoto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RestaurantPhotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RestaurantPhoto model.
     * @param string $id
     * @return mixed
     */
    public function actionView($restaurantPhotoID)
    {
        return $this->renderPartial('view', [
            'model' => $this->findModel($restaurantPhotoID),
        ]);
    }

    /**
     * Creates a new RestaurantPhoto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($restaurantID)
    {
        $model = new RestaurantPhoto();
		$model->restaurantID = $restaurantID;

        if ($model->load(Yii::$app->request->post()))
		{
			$model->photoName = UploadedFile::getInstance($model, 'photoName');
			if($model->validate())
			{
				$image = $model->photoName;
				$model->photoName = Yii::$app->security->generateRandomString().'.'.$image->extension;
				if($model->save())
				{
					$photoUploadPath = Yii::$app->basePath.App::restaurantUploadPath().$model->photoName;
					$image->saveAs($photoUploadPath);
					
					$restaurantPhotoSearchModel = new RestaurantPhotoSearch;
					$restaurantPhotoSearchModel->restaurantID = $restaurantID;
					$restaurantPhotoDataProvider = $restaurantPhotoSearchModel->search(null);
					
					$renderDataDiv = $this->renderPartial('index', ['searchModel' => $restaurantPhotoSearchModel,'dataProvider' => $restaurantPhotoDataProvider, 'restaurantID' => $restaurantID]);

					$msg = 'Photo Added Successfully';
					$divAppend = 'RestaurantPhoto';
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
            	$errorSummary = Html::errorSummary($model); 
                exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
			}
        }
		else
		{
			$photoUploadUrl =  Yii::$app->urlManager->createUrl(['admin/restaurantphoto/create', 'restaurantID' => $restaurantID]);
            return $this->renderPartial('create', [
                'model' => $model,
				'photoUploadUrl' => $photoUploadUrl,
            ]);
        }
    }

    /**
     * Updates an existing RestaurantPhoto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($restaurantID, $restaurantPhotoID)
    {
        $model = $this->findModel($restaurantPhotoID);
		$oldImageName = $model->photoName;

        if ($model->load(Yii::$app->request->post()))
		{
			$model->photoName = UploadedFile::getInstance($model, 'photoName');
			if($model->validate())
			{
				if(!is_null($model->photoName))
				{
					$image = $model->photoName;
					$photoUploadPath = Yii::$app->basePath.App::restaurantUploadPath().$oldImageName;
					@unlink($photoUploadPath);
					$image->saveAs($photoUploadPath);
				}
				$model->photoName = $oldImageName;
				if($model->save())
				{
					$restaurantPhotoSearchModel = new RestaurantPhotoSearch;
					$restaurantPhotoSearchModel->restaurantID = $restaurantID;
					$restaurantPhotoDataProvider = $restaurantPhotoSearchModel->search(null);
					
					$msg = 'Photo Updated Successfully';
					$divAppend = 'RestaurantPhoto';
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
				$errorSummary = Html::errorSummary($model); 
				exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
			}
        }
		else
		{
            $photoUploadUrl =  Yii::$app->urlManager->createUrl(['admin/restaurantphoto/update', 'restaurantID' => $restaurantID, 'restaurantPhotoID' => $restaurantPhotoID]);
            return $this->renderPartial('update', [
                'model' => $model,
				'photoUploadUrl' => $photoUploadUrl,
            ]);
        }
    }

    /**
     * Deletes an existing RestaurantPhoto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {return false;
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RestaurantPhoto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return RestaurantPhoto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RestaurantPhoto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
