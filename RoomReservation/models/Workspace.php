<?php

namespace app\models;

use Yii;
use app\models\Area;
use yii\db\Query;

/**
 * This is the model class for table "Workspace".
 *
 * @property integer $WorkspaceID
 * @property string $Name
 * @property integer $AreaID
 * @property integer $Capacity
 * @property integer $IsActive
 * @property string $AdditionalInfo
 */
class Workspace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Workspace';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name','AreaID'], 'required'],
            [['AreaID', 'Capacity', 'IsActive'], 'integer'],
            [['AdditionalInfo'], 'string'],
            [['Name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WorkspaceID' => 'Workspace',
            'Name' => 'Name',
            'AreaID' => 'Area',
            'Capacity' => 'Capacity',
            'IsActive' => 'Is Active',
            'AdditionalInfo' => 'Additional Info',
        ];
    }

    public function getArea()
    {
        return $this->hasOne(Area::className(), ['AreaID' => 'AreaID']);
        //return Area::find()->where(['AreaID' => $this->AreaID])->one();
    }

    public static function getAvailabilityResults($start_time, $end_time, $area_id, $workspace_id)
    {
        $query = new Query;
        $query->select('w.WorkspaceID')->distinct()
              ->from('Workspace w')
              ->leftJoin('RequestBookingPairing rbp', 'w.WorkspaceID = rbp.WorkspaceID')
              ->leftJoin('BookingRequest br', 'br.RequestID = rbp.RequestID')
              ->where("(br.StartTime < '".$start_time."' OR br.StartTime < '".$end_time."') AND (br.EndTime > '".$start_time."' OR br.EndTime > '".$end_time."')")
              ->andWhere(['w.IsActive' => 1]);
        $temp = $query->all();

        $w_ids = array_column($temp, 'WorkspaceID');

        $q = new Query;
        $q->select('w.*, a.Name as AreaName')
          ->from('Workspace w')
          ->innerJoin('Area a', 'a.AreaID = w.AreaID');
        if(!empty($w_ids))
        {
            $q->where("w.WorkspaceID NOT IN (".implode($w_ids, ',').")");
        }
        else
        {
            $q->where("1");
        }

        
        if($area_id != '')
        {
            $q->andWhere(['w.AreaID' => $area_id]);
        }
        if($workspace_id != '')
        {
            $q->andWhere(['w.WorkspaceID' => $workspace_id]);
        }
        return $q->all();
    }
}
