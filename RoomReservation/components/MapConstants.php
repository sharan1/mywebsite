<?php namespace app\components;

use Yii;
use yii\base\Model;

/**
 * Site Constants
 */
class MapConstants extends Model
{
    public static function getBookingStatus()
    {
        return [
            0 => 'Cancelled',
            1 => 'Pending',
            2 => 'Confirmed'
        ];
    }

    public static function getAreaType()
    {
        return [
            1 => 'Academic',
            2 => 'Miscellaneous Activities',
            3 => 'Outsourced'
        ];
    }
}
?>