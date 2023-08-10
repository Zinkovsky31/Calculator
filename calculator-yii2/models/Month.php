<?php

namespace app\models;
use yii\db\ActiveRecord;


class month extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%months}}';
    }
    public  function rules()
    {

    }
    public  function attributeLabels()
    {
        
    }
}

?>
