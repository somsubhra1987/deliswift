<?php
namespace app\lib;

use Yii;
use yii\filters\AccessControl;
use app\lib\UserAccessRule;

class userParentController extends \yii\web\Controller
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
                    'class' => UserAccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['customer'],
                    ],
                ],
            ],
        ];
    }
}