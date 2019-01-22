<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Customer;
use app\models\IpAddressCity;
use app\models\Restaurant;
use app\lib\App;
use app\lib\Core;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$featuredRestaurantArr = Restaurant::getFeaturedRestaurant();
		
        return $this->render('index', [
            'featuredRestaurantArr' => $featuredRestaurantArr,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
		$postDataArr = Yii::$app->request->post();
        if (count($postDataArr) > 0)
		{
			$model->emailAddress = $postDataArr['loginFullName'];
			$model->password = $postDataArr['loginPassword'];
			$model->isPasswordHash = 0;
		
			if($model->login())
			{
            	return $this->goBack();
			}
			else
			{
				$errorSummary = Html::errorSummary($model); 
                exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
			}
        }
        else
		{
			$error = array('statusCode' => 400, 'message' => 'Something went wrong', 'name' => 'Oops');
            return $this->render('@app/views/site/error', ['error' => $error]);
		}
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
	
	#== register user ==#
	public function actionRegister()
	{
		$model = new Customer();
		$model->setscenario('register');
		$postDataArr = Yii::$app->request->post();
		if(count($postDataArr) > 0)
		{
			$nameArr = explode(' ', $postDataArr['registrationFullName']);
			$lastName = '';
			if(count($nameArr) > 1)
			{
				$lastName = array_pop($nameArr);
			}
			$firstName = implode(' ', $nameArr);
			$model->firstName = $firstName;
			$model->lastName = $lastName;
			$model->emailAddress = $postDataArr['registrationEmailAddress'];
			$model->password = $postDataArr['registrationPassword'];
			$model->confirmPassword = $postDataArr['registrationConfirmPassword'];
			$model->isActive = 1;
			$password = $model->password;
			if($model->save())
			{
				$subject = 'Registration successful';
				$body = "Thank you for being with Us.\r\n";
				$body .= "Your account is created successfully.\r\n";
				$body .= "Please use the below mentioned details to login and access your account\r\n\n";
				$body .= "UserID:".$model->emailAddress."\r\n";
				$body .= "Password:".$password."\r\n";
		
				App::sendMail($model->emailAddress, Yii::$app->params['fromEmail'], Yii::$app->params['fromName'], $subject, $body, 0);
			}
			else
			{
				$errorSummary = Html::errorSummary($model); 
                exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
			}
		}
		else
		{
			$error = array('statusCode' => 400, 'message' => 'Something went wrong', 'name' => 'Oops');
            return $this->render('@app/views/site/error', ['error' => $error]);
		}
	}
	
	public function actionGetcitylist($searchText)
	{
		$suggestedCityArr = array();
		$cityDataArr = App::getSuggestedCityAssoc($searchText, 0, 10);
		foreach($cityDataArr as $cityData)
		{
			$cityName = $cityData['title'];
			$cityArr = array('cityID' => $cityData['cityID'], 'cityName' => $cityName);
			array_push($suggestedCityArr, $cityArr);
		}
	    return json_encode($suggestedCityArr);
	}
	
	public function actionGetdeliverylocationlist($searchText, $cityID = 0)
	{
		$suggestedDeliveryLocationArr = array();
		$deliveryLocationDataArr = App::getSuggestedDeliveryLocationAssoc($searchText, $cityID, 10);
		foreach($deliveryLocationDataArr as $deliveryLocationData)
		{
			$deliveryLocationName = $deliveryLocationData['title'];
			$deliveryLocationArr = array('deliveryLocationID' => $deliveryLocationData['deliveryLocationID'], 'deliveryLocationName' => $deliveryLocationName);
			array_push($suggestedDeliveryLocationArr, $deliveryLocationArr);
		}
	    return json_encode($suggestedDeliveryLocationArr);
	}
	
	public function actionSetlastselectedcity($cityID)
	{
		if(Yii::$app->session->has('loggedCustomerID'))
		{
			$customerID = Core::getLoggedCustomerID();
			App::updateRecord('cust_customer', ['lastSelectedCityID' => $cityID], ['customerID' => $customerID]);
		}
		else
		{
			$userIP = Yii::$app->request->getUserIP();
			$ipAddressCityID = Core::getData("SELECT ipAddressCityID FROM app_ip_address_city WHERE ipAddress = '$userIP'");
			if($ipAddressCityID > 0)
			{
				App::updateRecord('app_ip_address_city', ['lastSelectedCityID' => $cityID], ['ipAddress' => $userIP]);
			}
			else
			{
				$ipAddressCityModel = new IpAddressCity();
				$ipAddressCityModel->ipAddress = $userIP;
				$ipAddressCityModel->lastSelectedCityID = $cityID;
				$ipAddressCityModel->save();
			}
		}
		
		return $this->goBack();
	}
}
