<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Users;
use app\components\ResetProfilePasswordForm;
use app\components\AdminLogin; 

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
            $userDetails = Users::findIdentity(Yii::$app->user->id);
            if (isset($userDetails))
            {
                if($userDetails->PrivilegeID == 1)
                {
                    $this->redirect(['/users/home'])->send();
                }
                else
                {
                    $this->redirect(['/booking-request/bookingavail'])->send();
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
            if(!empty($_POST))
            {
                if($_POST["UserName"] != "" && $_POST["Password"] != "")
                {
                    $model->UserName = $_POST["UserName"];
                    $model->Password = $_POST["Password"];
                    if ($model->login()) 
                    {
                        $userDetails = Users::findIdentity(Yii::$app->user->id);
                        if (isset($userDetails)) 
                        {
                            if($userDetails->PrivilegeID == 1)
                            {
                                $this->redirect(['/users/home'])->send();
                            }
                            else
                            {
                                $this->redirect(['/booking-request/bookingavail'])->send();
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
            $user = Users::findByUsername($username);
            if($user->PasswordHash != $hash)
            {
                die("Wrong Link");
            }
            $user->Password = md5($resetpasswordmodel->changepassword);
            $user->save();
            if($user->PrivilegeID == 1)
            {
                $this->redirect(['/users/home'])->send();
            }
            else if($user->PrivilegeID == 2)
            {
                $this->redirect(['/booking-request/bookingavail'])->send();
            }
        }

        return $this->render('reset-password', [
            'resetpasswordmodel' => $resetpasswordmodel
        ]);
    }

    public function actionSignup()
    {
        $model = new Users();
        if($model->load(Yii::$app->request->post())) 
        {
            $model->PrivilegeID = 2;
            $model->save();
            $this->redirect(['/booking-request/bookingavail'])->send();
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
