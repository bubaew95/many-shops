<?php

namespace common\models\favorites;

/**
 * This is the ActiveQuery class for [[Users]].
 *
 * @see Users
 */
class FavoritesQuery extends \yii\db\ActiveQuery
{
    public function isAdv($params, $user_id)
    {
        return $this->where($params)
                ->userFavorites($user_id);
    }

    public function userFavorites($user_id)
    {
        return $this->andWhere(['user_id' => $user_id]);
    }

    /**
     * {@inheritdoc}
     * @return Users[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Users|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
