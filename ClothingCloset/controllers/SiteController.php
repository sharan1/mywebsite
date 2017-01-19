<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Person;
use app\components\AdminLogin; 
use app\components\ResetProfilePasswordForm;
use yii\web\Response;

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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['login'])->send();
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $model = new AdminLogin();
        if (!Yii::$app->user->isGuest) 
        {
            $userDetails = Person::findIdentity(Yii::$app->user->id);
            if (isset($userDetails)) 
            {
                $this->redirect(['/person'])->send();
            } 
            else 
            {
                return $this->render('login', [
                        'model' => $model,
                ]);
            }
        }
        else 
        {
            if(!empty($_POST))
            {
                
                if($_POST["UserName"] != "" && $_POST["Password"] != "")
                {
                    $model->UserName = $_POST["UserName"];
                    $model->Password = $_POST["Password"];
                    if ($model->login()) 
                    {
                        $userDetails = Person::findIdentity(Yii::$app->user->id);
                        if (isset($userDetails)) 
                        {
                            if(Yii::$app->user->isGuest || Yii::$app->user->identity->PrivilegeID == 3)
                            {
                                $this->redirect(['/users'])->send();
                            }
                            else
                            {

                            }
                            $this->redirect(['/person'])->send();
                        } 
                        else 
                        {
                            return $this->render('login', [
                                    'model' => $model,
                            ]);
                        }
                    } 
                    else 
                    {
                        return $this->render('login', [
                                'model' => $model,
                        ]);
                    }
                }
                else
                {
                    return $this->render('login', [
                                'model' => $model,
                        ]);
                }
            }
            else
            {
                return $this->render('login', [
                                'model' => $model,
                        ]);
            }
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

    public function actionResetPassword()
    {
        $hash=$_GET['hash'];
        $username = $_GET['username'];
        $resetpasswordmodel = new ResetProfilePasswordForm();
        if (!empty($_POST)) 
        {
            $resetpasswordmodel->load(Yii::$app->request->post());
            $user = Person::findByUsername($username);
            if($user->PasswordHash != $hash)
            {
                die("Wrong Link");
            }
            $user->Password = md5($resetpasswordmodel->changepassword);
            $user->save();

            $this->redirect(['/users'])->send();
        }

        return $this->render('reset-password', [
            'resetpasswordmodel' => $resetpasswordmodel
        ]);
    }

    public function actionSignup()
    {
        $model = new Person();
        if($model->load(Yii::$app->request->post())) 
        {
            $model->PrivilegeID = 3;
            $model->Type="User";
            var_dump($model->save());
            die;
            return $this->redirect(['/person'])->send();
        } 
        else 
        {
            return $this->render('signup', [
                'model' => $model,
            ]);
        }
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
}
