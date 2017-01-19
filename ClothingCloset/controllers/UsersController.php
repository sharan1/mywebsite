<?php

namespace app\controllers;

use Yii;
use app\models\Person;
use app\models\PersonSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\AllItem;
use yii\db\Query;
use app\models\ItemSold;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class UsersController extends Controller
{
    /**
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->PrivilegeID < 3)
        {
            return $this->redirect(['/person'])->send();
        }
        $item_data = AllItem::find()
                    ->leftJoin('ItemSold is', 'AllItem.ItemID = is.ItemID')
                    ->where('Image IS NOT NULL AND is.AddedOn IS NULL')->andWhere(['IsActive' => 1])->orderBy('AllItem.AddedOn DESC')->limit(4)->all();
        return $this->render('index', [
            'item_data' => $item_data
        ]);
    }

    public function actionMen()
    {
        $category_ids = [1,2,3,4,7,16,17,18,19,20];
        $query = new Query;
        $query->select('ai.*')->distinct()
              ->from('AllItem ai')
              ->innerJoin('ItemCategory ic', 'ai.ItemID = ic.ItemID')
              ->leftJoin('ItemSold is', 'ai.ItemID = is.ItemID')
              ->where('Image IS NOT NULL AND is.AddedOn IS NULL')
              ->andWhere(['CategoryID' => $category_ids, 'ai.IsActive' => 1])
              ->orderBy('ai.AddedOn DESC');
        $item_data = $query->all();
        return $this->render('men', [
            'item_data' => $item_data,
        ]);
    }
    
    public function actionWomen()
    {
        $category_ids = [5,6,8,10,12,13,15,21,27];
        $item_data = AllItem::find()->where('Image IS NOT NULL')->andWhere(['IsActive' => 1])->orderBy('AddedOn DESC')->limit(4)->all();
        $query = new Query;
        $query->select('ai.*')->distinct()
              ->from('AllItem ai')
              ->innerJoin('ItemCategory ic', 'ai.ItemID = ic.ItemID')
              ->leftJoin('ItemSold is', 'ai.ItemID = is.ItemID')
              ->where('Image IS NOT NULL AND is.AddedOn IS NULL')
              ->andWhere(['CategoryID' => $category_ids, 'ai.IsActive' => 1])
              ->orderBy('ai.AddedOn DESC');
        $item_data = $query->all();
        return $this->render('women', [
            'item_data' => $item_data,
        ]);
    }
    
    public function actionKids()
    {
        $category_ids = [9,11,14,22,23,24,25,26,28];
        $item_data = AllItem::find()->where('Image IS NOT NULL')->andWhere(['IsActive' => 1])->orderBy('AddedOn DESC')->limit(4)->all();
        $query = new Query;
        $query->select('ai.*')->distinct()
              ->from('AllItem ai')
              ->innerJoin('ItemCategory ic', 'ai.ItemID = ic.ItemID')
              ->leftJoin('ItemSold is', 'ai.ItemID = is.ItemID')
              ->where('Image IS NOT NULL AND is.AddedOn IS NULL')
              ->andWhere(['CategoryID' => $category_ids, 'ai.IsActive' => 1])
              ->orderBy('ai.AddedOn DESC');
        $item_data = $query->all();
        return $this->render('kids', [
            'item_data' => $item_data,
        ]);
    }

    public function actionItemdetails($id)
    {
        $model = AllItem::find()->where(['ItemID' => $id])->one();
        return $this->render('itemdetails', [
            'model' => $model,
        ]);
    }

    public function actionBuyitem($id)
    {
        $sold = new ItemSold;
        $sold->ItemID = $id;
        $sold->CustomerID = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
        $sold->save();
        sleep(1);
        return $this->redirect(['index']);
    }
    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
