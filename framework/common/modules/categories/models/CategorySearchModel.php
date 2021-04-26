<?php

namespace common\modules\categories\models;

use common\traits\HelperTrait;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\categories\Category;

/**
 * CategorySearchModel represents the model behind the search form of `common\models\categories\Category`.
 */
class CategorySearchModel extends Category
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tree', 'lft', 'rgt', 'depth', 'position' ], 'integer'],
            [['icon', 'block', 'alias', 'title'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
        $query = Category::find();
        $adminRole = \Yii::$app->user->can(ADMIN_ROLE);

        if(!$adminRole) {
            $query->joinWith('categoryToShop')
                ->where(['tree' => \Yii::$app->shopComponent->catId])
                ->andWhere(['!=', Category::tableName() . '.id', \Yii::$app->shopComponent->catId]);
            // add conditions that should always apply here
        }

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
            'tree' => $this->tree,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'depth' => $this->depth,
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['block' => $this->block]);
        //->andFilterWhere(['like', 'title' => $this->title])

        return $dataProvider;
    }
}
