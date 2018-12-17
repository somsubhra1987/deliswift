<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\DeliveryBoy;

/**
 * DeliveryBoySearch represents the model behind the search form about `app\modules\admin\models\DeliveryBoy`.
 */
class DeliveryBoySearch extends DeliveryBoy
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deliveryBoyID', 'isEngaged', 'isActive', 'todayOrderCount', 'isOnDuty', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['userID', 'name', 'emailAddress', 'phoneNumber', 'permanentAddress', 'presentAddress', 'aadharNo', 'profileImagePath', 'createdDatetime', 'modifiedDatetime'], 'safe'],
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
        $query = DeliveryBoy::find();

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
            'deliveryBoyID' => $this->deliveryBoyID,
            'isEngaged' => $this->isEngaged,
            'isActive' => $this->isActive,
            'todayOrderCount' => $this->todayOrderCount,
            'isOnDuty' => $this->isOnDuty,
            'createdDatetime' => $this->createdDatetime,
            'createdByUserID' => $this->createdByUserID,
            'modifiedDatetime' => $this->modifiedDatetime,
            'modifiedByUserID' => $this->modifiedByUserID,
        ]);

        $query->andFilterWhere(['like', 'userID', $this->userID])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'emailAddress', $this->emailAddress])
            ->andFilterWhere(['like', 'phoneNumber', $this->phoneNumber])
            ->andFilterWhere(['like', 'permanentAddress', $this->permanentAddress])
            ->andFilterWhere(['like', 'presentAddress', $this->presentAddress])
            ->andFilterWhere(['like', 'aadharNo', $this->aadharNo])
            ->andFilterWhere(['like', 'profileImagePath', $this->profileImagePath]);

        return $dataProvider;
    }
}
