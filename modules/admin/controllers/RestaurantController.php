<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Restaurant;
use app\modules\admin\models\RestaurantSearch;
use app\modules\admin\models\RestauranttimingSearch;
use app\modules\admin\models\MenuSearch;
use app\modules\admin\models\RestaurantPhotoSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\lib\App;

/**
 * RestaurantController implements the CRUD actions for Restaurant model.
 */
class RestaurantController extends ControllerAdmin
{

    const RESTAURANT_CREATE_SUCCESSFUL = "Restaurant created successfully ";
    const RESTAURANT_DELETE_SUCCESSFUL = "Restaurant deteted successfully ";
    const RESTAURANT_UPDATE_SUCCESSFUL = "Restaurant updated successfully ";
    const RESTAURANT_OPERATION_FAILS = "Error ! Operation failed ";

    /**
     * Lists all Restaurant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RestaurantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Restaurant model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $restauranttimingSearchModel        = new RestauranttimingSearch;
        $restauranttimingSearchModel->restaurantID = $id;
        $restauranttimingDataProvider   = $restauranttimingSearchModel->search(Yii::$app->request->queryParams);


        $menuSearchModel        = new MenuSearch;
        $menuSearchModel->restaurantID = $id;
        $menuDataProvider   = $menuSearchModel->search(Yii::$app->request->queryParams);
		
		$restaurantPhotoSearchModel = new RestaurantPhotoSearch;
        $restaurantPhotoSearchModel->restaurantID = $id;
        $restaurantPhotoDataProvider   = $restaurantPhotoSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $model,
            'restauranttimingSearchModel' => $restauranttimingSearchModel,
            'restauranttimingDataProvider' => $restauranttimingDataProvider,
            'menuSearchModel' => $menuSearchModel,
            'menuDataProvider' => $menuDataProvider,
			'restaurantPhotoSearchModel' => $restaurantPhotoSearchModel,
			'restaurantPhotoDataProvider' => $restaurantPhotoDataProvider,
        ]);


        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    /**
     * Creates a new Restaurant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Restaurant();
        $model->scenario = 'create';

        // echo "<pre>";
        // print_r(Yii::$app->request->post());
        // echo "</pre>";

        if ( $model->load(Yii::$app->request->post()) ) { 

            #== Start Insert Restaurant Photo if Found ==#
            $image = UploadedFile::getInstance($model, 'imagePath');
            if (!is_null($image)) 
            {
               // $model->image_src_filename = $image->name;
                $ext = end((explode(".", $image->name)));
                $randomImageName = Yii::$app->security->generateRandomString().".{$ext}";
                $model->imagePath = App::restaurantUploadPath().$randomImageName;              
                Yii::$app->params['uploadPath'] = Yii::$app->basePath.App::restaurantUploadPath();
                $path = Yii::$app->params['uploadPath'] . $randomImageName;
                $image->saveAs($path);
            }

            if ($model->save()) 
            {      
                Yii::$app->session->setFlash('success',self::RESTAURANT_CREATE_SUCCESSFUL);
                $code = App::generateRestaurantCode($model->restaurantID);
                App::updateRecord('res_restaurants',array('code'=>$code), array('restaurantID'=>$model->restaurantID));
                return $this->redirect(['view', 'id' => $model->restaurantID]);             
            }  
            else 
            {
                var_dump ($model->getErrors()); die();
             }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Restaurant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImage = $model->imagePath;
        $isCodeSet = $model->code;
        $oldPassword = $model->password;
        if ($model->load(Yii::$app->request->post())) {

            #== Start Insert Restaurant Photo if Found ==#
            $image = UploadedFile::getInstance($model, 'imagePath');
            if (!is_null($image)) 
            {
               // $model->image_src_filename = $image->name;
                $ext = end((explode(".", $image->name)));
                $randomImageName = Yii::$app->security->generateRandomString().".{$ext}";
                $model->imagePath = App::restaurantUploadPath().$randomImageName;              
                Yii::$app->params['uploadPath'] = Yii::$app->basePath.App::restaurantUploadPath();
                $path = Yii::$app->params['uploadPath'] . $randomImageName;
                $image->saveAs($path);
                $oldImageWithPath = Yii::$app->basePath.$oldImage;
                if (file_exists ($oldImageWithPath))
                {
                    @unlink($oldImageWithPath);                    
                }   
            }
            else
            {
                $model->imagePath = $oldImage;
            }
            if(!$isCodeSet)
                $model->code =App::generateRestaurantCode($model->restaurantID);
            if(!$model->password)
                $model->password = $oldPassword;

            if($model->save())
            {
                Yii::$app->session->setFlash('success',self::RESTAURANT_UPDATE_SUCCESSFUL);
                return $this->redirect(['view', 'id' => $model->restaurantID]);   
            }
            else
            {                
                var_dump ($model->getErrors()); die();
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Restaurant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Restaurant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Restaurant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Restaurant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
