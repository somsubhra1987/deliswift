<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'deliswift',
	'name' => 'Deliswift',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'timeZone'=>'Asia/Calcutta',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Deli5wift@2018!23$',
			'baseUrl' => '/deliswift',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => stristr($_SERVER['REQUEST_URI'], "/admin") ? 'app\modules\admin\models\Admin' : ((stristr($_SERVER['REQUEST_URI'], "/delivery")) ? 'app\modules\delivery\models\Delivery' : ((stristr($_SERVER['REQUEST_URI'], "/restaurant")) ? 'app\modules\restaurant\models\Restaurant' : 'app\models\User')),
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
			'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.deliswift.co.in',
                'username' => 'no-reply@deliswift.co.in',
                'password' => 'jbDGf8tjE34u',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'baseUrl' => '/deliswift',
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				'admin/logout'=> 'admin/default/logout',
				'delivery/logout'=> 'delivery/default/logout',
				'restaurant/logout'=> 'restaurant/default/logout',
				'register' => 'site/register',
				'login' => 'site/login',
				'logout' => 'site/logout',
				'contact' => 'site/contact',
				'about' => 'site/about',
			],
        ],
        
    ],
    'params' => $params,
	'layout' => (stristr($_SERVER['REQUEST_URI'], "/admin")) ? '@app/web/themes/backend/adminlte/templates/Default/Page' : ((stristr($_SERVER['REQUEST_URI'], "/delivery")) ? '@app/web/themes/frontend/default/templates/Default/Page' : ((stristr($_SERVER['REQUEST_URI'], "/restaurant")) ? '@app/web/themes/restaurant/default/templates/Default/Page' : 'main')),
	'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
		'delivery' => [
            'class' => 'app\modules\delivery\Module',
        ],
		'restaurant' => [
            'class' => 'app\modules\restaurant\Module',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
