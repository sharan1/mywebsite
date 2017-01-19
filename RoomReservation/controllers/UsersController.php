<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearch;
use app\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\BookingRequest;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->identity->PrivilegeID != 1)
        {
            $this->goHome();
        }
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->identity->PrivilegeID != 1)
        {
            $this->goHome();
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->identity->PrivilegeID != 1)
        {
            $this->goHome();
        }
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->UserID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->identity->PrivilegeID != 1)
        {
            $this->goHome();
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->UserID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->identity->PrivilegeID != 1)
        {
            $this->goHome();
        }
        $model = $this->findModel($id);
        $model->IsActive = 0;
        $model->save();

        return $this->redirect(['index']);
    }

    public function actionHome()
    {
        if(Yii::$app->user->identity->PrivilegeID != 1)
        {
            $this->goHome();
        }
        $data = [];
        $data['pending'] = BookingRequest::find()->where(['Booking_Status' => 1])->count();
        $data['cancelled'] = BookingRequest::find()->where(['Booking_Status' => 0])->count();
        $data['confirmed'] = BookingRequest::find()->where(['Booking_Status' => 2])->count();
        $data['all'] = BookingRequest::find()->count();
        return $this->render('home', [
            'data' => $data
        ]);
    }


    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
