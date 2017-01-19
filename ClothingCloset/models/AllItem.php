<?php

namespace app\models;
use app\models\Size;
use app\models\Brand;
use yii\web\UploadedFile;
use yii\db\Query;

use Yii;

/**
 * This is the model class for table "allitem".
 *
 * @property integer $ItemID
 * @property integer $DonationID
 * @property double $Price
 * @property integer $BrandID
 * @property integer $IsPriceDec
 * @property integer $IsActive
 * @property string $AddedOn
 * @property integer $AddedBy
 * @property integer $SizeID
 *
 * @property Brand $brand
 * @property Donation $donation
 * @property Size $size
 * @property Image[] $images
 * @property Itemcategory[] $itemcategories
 * @property Itemcolor[] $itemcolors
 */
class AllItem extends \yii\db\ActiveRecord
{
    public $category_details;
    public $color_details;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'allitem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ItemName','DonationID', 'Price'], 'required'],
            [['DonationID', 'BrandID', 'IsPriceDec', 'AddedBy', 'SizeID'], 'integer'],
            [['Price'], 'number'],
            [['AddedOn', 'ItemName', 'Image', 'Description', 'category_details', 'color_details'], 'safe'],
            [['Image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ItemID' => 'Item ID',
            'DonationID' => 'Donation',
            'Price' => 'Price',
            'BrandID' => 'Brand',
            'IsPriceDec' => 'Price Decrease?',
            'IsActive' => 'Active?',
            'AddedOn' => 'Added On',
            'AddedBy' => 'Added By',
            'SizeID' => 'Size',
            'Image' => 'Image'
        ];
    }


    public function beforeSave($insert)
    {
        if($insert)
        {
            $this->AddedBy = Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if(isset($this->category_details) && !empty($this->category_details))
        {
            if(!$insert)
            {
                $pairings = ItemCategory::find()->where(['ItemID' => $this->ItemID])->all();
                foreach($pairings as $key => $value) 
                {
                    $value->delete();
                }
            }
            foreach($this->category_details as $key => $value) 
            {
                $new = new ItemCategory;
                $new->ItemID = $this->ItemID;
                $new->CategoryID = $value;
                $new->save();
            }
        }

        if(isset($this->color_details) && !empty($this->color_details))
        {
            if(!$insert)
            {
                $pairings = ItemColor::find()->where(['ItemID' => $this->ItemID])->all();
                foreach($pairings as $key => $value) 
                {
                    $value->delete();
                }
            }
            foreach($this->color_details as $key => $value) 
            {
                $new = new ItemColor;
                $new->ItemID = $this->ItemID;
                $new->ColorID = $value;
                $new->save();
            }
        }
        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterFind()
    {
        parent::afterFind();
        $query = new Query;
        $query->select('CategoryID')->from('ItemCategory')->where(['ItemID' => $this->ItemID]);
        $data = $query->all();
        $this->category_details = array_column($data, 'CategoryID');

        $query = new Query;
        $query->select('ColorID')->from('ItemColor')->where(['ItemID' => $this->ItemID]);
        $data = $query->all();
        $this->color_details = array_column($data, 'ColorID');
        //$this->Image = UploadedFile::getInstance($this, 'Image');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['BrandID' => 'BrandID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDonation()
    {
        return $this->hasOne(Donation::className(), ['DonationID' => 'DonationID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSize()
    {
        return $this->hasOne(Size::className(), ['ID' => 'SizeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['ItemID' => 'ItemID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemcategories()
    {
        return $this->hasMany(Itemcategory::className(), ['ItemID' => 'ItemID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemcolors()
    {
        return $this->hasMany(Itemcolor::className(), ['ItemID' => 'ItemID']);
    }

    public function getAddedBy()
    {
        return $this->hasOne(Person::className(), ['PersonID' => 'AddedBy']);
    }

    public function getDonatedBy()
    {
        return $this->donation->addedBy;
    }

    public function uploadImage($file)
    {
        if ($this->validate() && isset($file)) 
        {
            $filename = 'img/Item_'.$this->ItemID.''.substr($this->Image, strpos($this->Image, '.'));
            $file->saveAs($filename);
            // foreach ($this->Image as $file) 
            // {
            //     $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            // }
            $this->Image = $filename;
            $this->save();
            return true;
        } 
        else 
        {
            return false;
        }
    }

    public function getImageUrl()
    {
        if(isset($this->Image)) 
        { 
            return \yii\helpers\Html::img(Yii::getAlias('@web').'/'.$this->Image, ['width' => 100,'height'=>60]);
        }
        else
        {
            return NULL;
        }
    }
}
