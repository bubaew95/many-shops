<?php

namespace backend\models\adv;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\adv\Resume;

/**
 * ResumeSearch represents the model behind the search form of `common\models\adv\Resume`.
 */
class ResumeSearch extends Resume
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'region_id', 'city_id', 'price_start', 'price_end', 'created_at', 'updated_at'], 'integer'],
            [['residence', 'work_experience', 'additional_skill', 'comment', 'briefly_about', 'preferred_ps', 'status'], 'safe'],
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
        $query = Resume::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
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
            'region_id' => $this->region_id,
            'city_id' => $this->city_id,
            'price_start' => $this->price_start,
            'price_end' => $this->price_end,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'residence', $this->residence])
            ->andFilterWhere(['like', 'work_experience', $this->work_experience])
            ->andFilterWhere(['like', 'additional_skill', $this->additional_skill])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'briefly_about', $this->briefly_about])
            ->andFilterWhere(['like', 'preferred_ps', $this->preferred_ps])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
