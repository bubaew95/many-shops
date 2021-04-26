<?php

namespace common\modules\eav\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\eav\models\EavAttribute;

/**
 * EavAttributeSearch represents the model behind the search form of `common\modules\eav\models\EavAttribute`.
 */
class EavAttributeSearch extends EavAttribute
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entityId', 'typeId', 'defaultOptionId', 'order', 'categoryId'], 'integer'],
            [['type', 'name', 'label', 'defaultValue', 'description'], 'safe'],
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
        $query = EavAttribute::find();

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
            'entityId' => $this->entityId,
            'typeId' => $this->typeId,
            'defaultOptionId' => $this->defaultOptionId,
            'order' => $this->order,
            'categoryId' => $this->categoryId,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'defaultValue', $this->defaultValue])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
