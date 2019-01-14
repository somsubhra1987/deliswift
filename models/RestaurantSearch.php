<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Restaurant;

/**
 * RestaurantSearch represents the model behind the search form about `app\modules\admin\models\Restaurant`.
 */
class RestaurantSearch extends Restaurant
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurantID', 'avgCostAmount', 'avgCostHeadCount', 'isCardAccept', 'isHomeDelivery', 'provinceID', 'cityID', 'deliveryLocationID', 'isActive', 'isClosed', 'isFeatured', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['name', 'description', 'imagePath', 'contactName', 'contactPhone', 'contactMobile', 'avgCostInfo', 'bestKnownFor', 'countryCode', 'contactAddress', 'createdDatetime', 'modifiedDatetime'], 'safe'],
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
        $query = Restaurant::find();

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
            'restaurantID' => $this->restaurantID,
            'avgCostAmount' => $this->avgCostAmount,
            'avgCostHeadCount' => $this->avgCostHeadCount,
            'isCardAccept' => $this->isCardAccept,
            'isHomeDelivery' => $this->isHomeDelivery,
            'provinceID' => $this->provinceID,
            'cityID' => $this->cityID,
            'deliveryLocationID' => $this->deliveryLocationID,
            'isActive' => $this->isActive,
            'isClosed' => $this->isClosed,
			'isFeatured' => $this->isFeatured,
            'createdDatetime' => $this->createdDatetime,
            'createdByUserID' => $this->createdByUserID,
            'modifiedDatetime' => $this->modifiedDatetime,
            'modifiedByUserID' => $this->modifiedByUserID,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'imagePath', $this->imagePath])
            ->andFilterWhere(['like', 'contactName', $this->contactName])
            ->andFilterWhere(['like', 'contactPhone', $this->contactPhone])
            ->andFilterWhere(['like', 'contactMobile', $this->contactMobile])
            ->andFilterWhere(['like', 'avgCostInfo', $this->avgCostInfo])
            ->andFilterWhere(['like', 'bestKnownFor', $this->bestKnownFor])
            ->andFilterWhere(['like', 'countryCode', $this->countryCode])
            ->andFilterWhere(['like', 'contactAddress', $this->contactAddress]);

        return $dataProvider;
    }
}
