<?php

namespace common\models\pages;

use common\models\menu\Menu;
use common\models\menu\MenuQuery;
use common\models\shops\Shops;
use common\traits\HelperTrait;
use himiklab\sitemap\behaviors\SitemapBehavior;
use Yii;

/**
 * This is the model class for table "{{%pages}}".
 *
 * @property int $id
 * @property string|null $keywords Ключевые слова
 * @property string|null $descriptions Краткое описание
 * @property string|null $name Название страницы
 * @property string $alias Латинское название
 * @property string $text Текст
 * @property int|null $status
 * @property int|null $shop_id Магазин
 *
 * @property Menu[] $menus
 */
class Pages extends \yii\db\ActiveRecord
{

    public $isRootPage;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pages}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['isRootPage'], 'boolean'],
            [['shop_id', 'active'], 'integer'],
            [['keywords', 'descriptions', 'name', 'alias'], 'string', 'max' => 255],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shops::className(), 'targetAttribute' => ['shop_id' => 'id']],
            ['alias', function($attribute, $params, $validator) {
                if(!$this->hasErrors() && $this->isNewRecord) {
                    $isAlias = static::find()->where(['alias' => $this->alias])->one();
                    if($isAlias)
                        $this->addError('alias', 'Ссылка должна быть уникальной');
                }
            }],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert && empty($this->alias)) {
                $this->alias = HelperTrait::titleTranslate($this->name);
                $this->shop_id = !$this->isRootPage ? HelperTrait::get('shop_id') : null;
            }
            return true;
        }
        return false;
    }

    public function behaviors()
    {
        return [
            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    $model->select(['alias']);
                },
                'dataClosure' => function ($model) {
                    return [
                        'loc' => \yii\helpers\Url::to(["/page/index", 'alias' => $model->alias], true),
                        'lastmod' => '2020-07-30T00:00:00+03:00',
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.5
                    ];
                }
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keywords' => 'Ключевые слова',
            'descriptions' => 'Краткое описание',
            'name' => 'Название страницы',
            'alias' => 'Ссылка',
            'text' => 'Текст',
            'active' => 'Статус',
            'shop_id' => 'Магазин',
            'isRootPage' => 'Родительская страница'
        ];
    }

    /**
     * Gets query for [[Menus]].
     *
     * @return \yii\db\ActiveQuery|MenuQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['page_id' => 'alias']);
    }

    /**
     * Gets query for [shops].
     *
     * @return \yii\db\ActiveQuery|Shops
     */
    public function getShop()
    {
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }

    /**
     * {@inheritdoc}
     * @return PagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PagesQuery(get_called_class());
    }
}
