<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Restauranttiming;

/**
 * RestauranttimingSearch represents the model behind the search form about `app\modules\admin\models\Restauranttiming`.
 */
class RestauranttimingSearch extends Restauranttiming
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurantTimingID', 'restaurantID', 'dayID', 'isActive', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['openingTime', 'closingTime', 'createdDatetime', 'modifiedDatetime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Restauranttiming::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'restaurantTimingID' => $this->restaurantTimingID,
            'restaurantID' => $this->restaurantID,
            'dayID' => $this->dayID,
            'openingTime' => $this->openingTime,
            'closingTime' => $this->closingTime,
            'isActive' => $this->isActive,
            'createdDatetime' => $this->createdDatetime,
            'createdByUserID' => $this->createdByUserID,
            'modifiedDatetime' => $this->modifiedDatetime,
            'modifiedByUserID' => $this->modifiedByUserID,
        ]);

        return $dataProvider;
    }
}
