<?php

namespace backend\models\adv;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\adv\Vacancy;

/**
 * VacancySearch represents the model behind the search form of `common\models\adv\Vacancy`.
 */
class VacancySearch extends Vacancy
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'region_id', 'city_id', 'year', 'price_start', 'price_end', 'count_drivers', 'created_at', 'updated_at', 'tr_cat_id'], 'integer'],
            [['marka', 'model', 'nationality', 'work_experience', 'req_driver', 'education', 'comment', 'status', 'additional_skill'], 'safe'],
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
        $query = Vacancy::find();

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
            'year' => $this->year,
            'price_start' => $this->price_start,
            'price_end' => $this->price_end,
            'count_drivers' => $this->count_drivers,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'tr_cat_id' => $this->tr_cat_id,
        ]);

        $query->andFilterWhere(['like', 'marka', $this->marka])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'work_experience', $this->work_experience])
            ->andFilterWhere(['like', 'req_driver', $this->req_driver])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'additional_skill', $this->additional_skill]);

        return $dataProvider;
    }
}
