<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\User;

/**
 * @property int $id
 * @property int $name
 * @property string $raw_type
 * @property string $months
 * @property int $tonnages
 * @property int $prices
 * @property string $price_table
 */



class History extends ActiveRecord
{
    
   
   

    
    public function rules()
    {
        return [
            [['name', 'raw_types', 'months', 'tonnages', 'prices',], 'required'],
            [['tonnages', 'prices'], 'integer'],
            [['raw_types', 'months'], 'string', 'max' => 255],
            
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'name']);
    }

    public function getRawPrices()
    {
        return json_decode($this->table_data);
    }

    public function getUsername()
    {
        return User::find()->select('username')->where(['id' => $this->name])->scalar();
    }

    public function getCalculationData()
    {
        return User::find()->select('created_at')->where(['id' => $this->name])->scalar();
    }

    public function snapshot(CalculatorForm $model)
{
    $repository = new PricesRepository();
    if (!Yii::$app->user->isGuest) {
        $userName = Yii::$app->user->identity->name;
    } else {
        
        $userName = 'Гость'; 
    }
    
   
    $this->name = $userName;
    $this->months = $model->month;
    $this->tonnages = $model->tonnage;
    $this->raw_types = $model->raw_type;
    $this->prices = $repository->getResultPrice($model->raw_type, $model->tonnage, $model->month);
    $this->price_table = json_encode($repository->getRawPricesByType($model->raw_type));
    
    if ($this->save()) {
        Yii::$app->session->setFlash('success', 'Расчет успешно сохранен.');
    } else {
        Yii::$app->session->setFlash('error', 'Ошибка сохранения: ' . print_r($this->errors, true));
    }
}

}