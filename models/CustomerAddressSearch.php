<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CustomerAddress;

/**
 * CustomerAddressSearch represents the model behind the search form about `app\models\CustomerAddress`.
 */
class CustomerAddressSearch extends CustomerAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerAddressID', 'customerID', 'deliveryLocationID', 'addressType', 'isDefault'], 'integer'],
            [['address', 'deliveryInstruction', 'otherAddressType'], 'safe'],
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
        $query = CustomerAddress::find();

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
            'customerAddressID' => $this->customerAddressID,
            'customerID' => $this->customerID,
            'deliveryLocationID' => $this->deliveryLocationID,
            'addressType' => $this->addressType,
            'isDefault' => $this->isDefault,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'deliveryInstruction', $this->deliveryInstruction])
            ->andFilterWhere(['like', 'otherAddressType', $this->otherAddressType]);

        return $dataProvider;
    }
}
