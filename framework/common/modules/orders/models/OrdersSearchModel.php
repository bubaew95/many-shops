<?php

namespace common\modules\orders\models;

use common\models\orders\OrderItems;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\orders\Orders;

/**
 * OrdersSearchModel represents the model behind the search form of `common\models\orders\Orders`.
 */
class OrdersSearchModel extends Orders
{
    public $name;
    public $phone;
    public $email;
    public $qty;
    public $amount;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'created_at', 'updated_at', 'ship_city', 'ship_region', 'ship_country', 'ship_zip'], 'integer'],
            [['ship_address', 'ship_city', 'ship_country', 'ship_zip', 'name', 'phone', 'email', 'qty', 'amount'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Orders::find()->viewShopOrders();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'ship_city' => $this->ship_city,
            'ship_country' => $this->ship_country,
            'ship_region' => $this->ship_region,
        ]);

        $query->andFilterWhere(['like', 'ship_address', $this->ship_address])
            ->andFilterWhere(['like', 'ship_zip', $this->ship_zip]);

        return $dataProvider;
    }
}
