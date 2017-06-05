<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
        'actions' => [
        'logout' => ['post'],
        ],
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

    public function actionRbac(){
		/*$role = Yii::$app->authManager->createRole('admin');
		$role->description = 'Супер Администратор';
		Yii::$app->authManager->add($role);
		 
		$role = Yii::$app->authManager->createRole('jadmin');
		$role->description = 'Младший администратор';
		Yii::$app->authManager->add($role);
		
		$role = Yii::$app->authManager->createRole('sadmin');
		$role->description = 'Старший администратор';
		Yii::$app->authManager->add($role);
		
		$role = Yii::$app->authManager->createRole('director');
		$role->description = 'Директор';
		Yii::$app->authManager->add($role);
		*/

		/* ---------------------------------------------------------- */

		/*	Привязка юзера с id 1 к роли admin	
		$userRole = Yii::$app->authManager->getRole('admin');
		Yii::$app->authManager->assign($userRole, 1);
		*/
	}

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
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
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
            ]);
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


    /**
     * Страница цитат.
     *
     * @return string
     */
    public function actionWords()
    {
        
        return $this->renderPartial('words');
    }

    public function actionWordsimg()
    {


        return $this->render('wordsimg');
    }









}
