<?php

namespace app\controllers;

use Yii;
use app\models\BookingRequest;
use app\models\BookingRequestSearch;
use app\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use app\models\Email;
use app\models\Workspace;

/**
 * BookingRequestController implements the CRUD actions for BookingRequest model.
 */
class BookingRequestController extends Controller
{
    /**
     * Lists all BookingRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->identity->PrivilegeID != 1)
        {
            $this->goHome();
        }
        $searchModel = new BookingRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BookingRequest model.
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
     * Creates a new BookingRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->identity->PrivilegeID != 1)
        {
            $this->goHome();
        }
        $model = new BookingRequest;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Email::sendRequestRecievedMail($model);
            return $this->redirect(['view', 'id' => $model->RequestID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BookingRequest model.
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
            return $this->redirect(['view', 'id' => $model->RequestID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionConfirm($id)
    {
        if(Yii::$app->user->identity->PrivilegeID != 1)
        {
            $this->goHome();
        }
        $model = $this->findModel($id);
        $model->Booking_Status = 2;
        $model->save();
        Email::sendStatusChangeMail($model);
        return $this->redirect(['index']);
    }

    public function actionCancel($id)
    {
        $model = $this->findModel($id);
        $model->Booking_Status = 0;
        $model->save();
        Email::sendStatusChangeMail($model);
        if(Yii::$app->user->identity->PrivilegeID == 1)
            return $this->redirect(['index']);
        else
            return $this->redirect(['userhistory']);
    }

    public function actionUserhistory()
    {
        $userid = Yii::$app->user->id;
        if($userid)
        {
            $past_bookings = BookingRequest::find()->where(['UserID' => $userid])->andWhere('StartTime <= NOW()')->all();
            $future_bookings = BookingRequest::find()->where(['UserID' => $userid])->andWhere('StartTime > NOW()')->all();
            $mapping = [];
            foreach ($past_bookings as $key => $value) 
            {
                $temp_map = $value->workspaces;
                if(!isset($mapping[$value->RequestID]))
                {
                    $mapping[$value->RequestID] = [];
                }
                foreach ($temp_map as $key1 => $value1) 
                {
                   $mapping[$value->RequestID][] = $value1->Name;
                }
            }
            foreach ($future_bookings as $key => $value) 
            {
                $temp_map = $value->workspaces;
                if(!isset($mapping[$value->RequestID]))
                {
                    $mapping[$value->RequestID] = [];
                }
                foreach ($temp_map as $key1 => $value1) 
                {
                   $mapping[$value->RequestID][] = $value1->Name;
                }
            }
            return $this->render('user-history', [
                'past_bookings' => $past_bookings,
                'future_bookings' => $future_bookings,
                'mapping' => $mapping,
            ]);
        }
        else
        {
            return $this->redirect(['users/home']);
        }

    }

    public function actionHistory()
    {
        if(Yii::$app->user->identity->PrivilegeID != 1)
        {
            $this->goHome();
        }
        $all_bookings = BookingRequest::find()->where(['Booking_Status' => array(0,2)])->orderBy('RequestedOn')->all();
        $mapping = [];
        foreach ($all_bookings as $key => $value) 
        {
            $temp_map = $value->workspaces;
            if(!isset($mapping[$value->RequestID]))
            {
                $mapping[$value->RequestID] = [];
            }
            foreach ($temp_map as $key1 => $value1) 
            {
               $mapping[$value->RequestID][] = $value1->Name;
            }
        }
        return $this->render('history', [
            'all_bookings' => $all_bookings,
            'mapping' => $mapping,
        ]);
    }

    public function actionBookingavail()
    {
        $result = [];
        $workspace_dropdown = [];
        $start_time = '';
        $end_time = '';
        $area_id = '';
        $workspace_id = '';
        $reason = '';
        $additional_info = '';

        if(!empty($_POST))
        {
            $reason = $_POST['Reason'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $area_id = $_POST['AreaID'];
            if($area_id != '')
            {
                $q = new Query;
                $q->select('WorkspaceID, Name')
                  ->from('Workspace')
                  ->where(['AreaID' => $area_id]);
                $data = $q->all();
                $workspace_dropdown = array_column($data, 'Name', 'WorkspaceID');
            }
            $workspace_id = $_POST['WorkspaceID'];
            $additional_info = $_POST['Additional_Info'];

            $result = Workspace::getAvailabilityResults($start_time, $end_time, $area_id, $workspace_id);
        }

        return $this->render('bookingavail', [
            'result' => $result,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'area_id' => $area_id,
            'workspace_id' => $workspace_id,
            'reason' => $reason,
            'additional_info' => $additional_info,
            'workspace_dropdown' => $workspace_dropdown
        ]);
    }

    /**
     * Finds the BookingRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BookingRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BookingRequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
