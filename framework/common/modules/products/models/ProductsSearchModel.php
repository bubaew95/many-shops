<?php

namespace common\modules\products\models;

use common\models\shops\Shops;
use common\traits\HelperTrait;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\products\Products;

/**
 * ProductsSearchModel represents the model behind the search form of `common\models\products\Products`.
 */
class ProductsSearchModel extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'shop_id', 'category_id', 'created_at', 'updated_at', 'active', 'discount', 'is_installment'], 'integer'],
            [['title', 'alias', 'meta_d', 'meta_k', 'text', 'specifications'], 'safe'],
            [['price', 'pre_order_price'], 'number'],
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
        $query = Products::find()
            ->joinWith('shop')
            ->where(['shop_id' => $params['shop_id']])
            ->andWhere([Shops::tableName() . '.user_id' => HelperTrait::userId()]);

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
            'shop_id' => $this->shop_id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'active' => $this->active,
            'discount' => $this->discount,
            'is_installment' => $this->is_installment,
            'pre_order_price' => $this->pre_order_price,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'meta_d', $this->meta_d])
            ->andFilterWhere(['like', 'meta_k', $this->meta_k])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'specifications', $this->specifications]);

        return $dataProvider;
    }
}
