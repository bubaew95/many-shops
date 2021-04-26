<?php

namespace common\models\menu;

use common\models\pages\Pages;
use common\models\pages\PagesQuery;
use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property int $id
 * @property string|null $name Название
 * @property string|null $page_id Страница
 * @property string|null $link Ссылка
 *
 * @property Pages $page
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'page_id', 'link'], 'string', 'max' => 255],
            [['page_id'], 'default', 'value' => null],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::className(), 'targetAttribute' => ['page_id' => 'alias']],

            [['page_id', 'link'], function($attribute, $params, $validator) {
                if( is_null($this->page_id) && empty($this->link) ) {
                    if(!$this->hasErrors()) {
                        $this->addError('link', 'Поле Ссылка или Страница должны быть заполнены');
                    }
                }

                if (!empty($this->link) && filter_var($this->link, FILTER_VALIDATE_URL) !== false)  {
                    if(!$this->hasErrors()) {
                        $this->addError('link', 'Не верный формат ссылки');
                    }
                }
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'page_id' => 'Страница',
            'link' => 'Ссылка',
        ];
    }

    /**
     * Gets query for [[Page]].
     *
     * @return \yii\db\ActiveQuery|PagesQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['alias' => 'page_id']);
    }

    /**
     * {@inheritdoc}
     * @return MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
}
