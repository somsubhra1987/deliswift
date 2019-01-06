<?php
namespace app\modules\restaurant;

use Yii;
use yii\filters\AccessControl;
use app\lib\RestaurantAccessRule;

class ControllerRestaurant extends \yii\web\Controller
{
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	
	
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                	'class' => RestaurantAccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['restaurant'],
                    ],
                ],
				'denyCallback' => function($rule, $callback){
					Yii::$app->controller->redirect(array ('/restaurant'));
				},
            ],
        ];
    }
}