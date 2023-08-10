<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;



/**
 * @property int $id
 * @property int $user_id
 * @property string $raw_type
 * @property string $month
 * @property int $tonnage
 * @property int $price
 * @property string $table_data
 */
class HistorySearch extends History
{
    public static function tableName()
    {
        return 'history';
    }

    public function rules()
    {
        return [
            [['tonnage'], 'integer'],
            [['month', 'raw_type'], 'safe'],
        ];
    }

    public function search($params)
    {
        $isAdmin = Yii::$app->user->can('administrator');
        $query = $isAdmin  ? History::find() : History::find()->where(['name' => Yii::$app->user->identity->getId()]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

       
        $query->andFilterWhere(['like', 'tonnages', $this->tonnage])
            ->andFilterWhere(['like', 'months', $this->month])
            ->andFilterWhere(['like', 'raw_types', $this->raw_type]);

        return $dataProvider;
    }

}
