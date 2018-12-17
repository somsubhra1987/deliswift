<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\modules\admin\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderID', 'customerID', 'assignedDeliveryBoyID', 'orderStatus', 'ratingPoint'], 'integer'],
            [['orderDate', 'deliveredAt', 'promoCode', 'orderDetails', 'ratingFor'], 'safe'],
            [['price', 'discount', 'totalAmount'], 'number'],
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
        $query = Order::find();

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
            'orderID' => $this->orderID,
            'customerID' => $this->customerID,
            'assignedDeliveryBoyID' => $this->assignedDeliveryBoyID,
            'orderStatus' => $this->orderStatus,
            'orderDate' => $this->orderDate,
            'deliveredAt' => $this->deliveredAt,
            'price' => $this->price,
            'discount' => $this->discount,
            'totalAmount' => $this->totalAmount,
            'ratingPoint' => $this->ratingPoint,
        ]);

        $query->andFilterWhere(['like', 'promoCode', $this->promoCode])
            ->andFilterWhere(['like', 'orderDetails', $this->orderDetails])
            ->andFilterWhere(['like', 'ratingFor', $this->ratingFor]);

        return $dataProvider;
    }
}
