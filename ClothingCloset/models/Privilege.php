<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Privilege".
 *
 * @property integer $PrivilegeID
 * @property string $PrivilegeName
 */
class Privilege extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Privilege';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PrivilegeName'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PrivilegeID' => 'Privilege ID',
            'PrivilegeName' => 'Privilege Name',
        ];
    }
}
