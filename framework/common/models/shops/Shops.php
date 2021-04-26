<?php

namespace common\models\shops;

use common\components\Upload;
use common\models\basket\Basket;
use common\models\basket\BasketQuery;
use common\models\categories\Category;
use common\models\categories\CategoriesQuery;
use common\models\categories\CategoriesToShop;
use common\models\orders\OrderItems;
use common\models\orders\Orders;
use common\models\products\Products;
use common\models\products\ProductsQuery;
use common\models\user\User;
use common\models\user\UserQuery;
use common\traits\HelperTrait;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%shops}}".
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property int $category_id Категория
 * @property string $title Название
 * @property string $alias Алиас
 * @property string|null $meta_d Описание страницы
 * @property string|null $meta_k Ключевые слова
 * @property int $created_at Дата создания
 * @property int $updated_at Дата редактирования
 * @property int|null $active Активность
 * @property string|null $text Описание
 * @property string|null $logo Логотип
 *
 * @property Basket[] $baskets
 * @property CategoriesToShop[] $categoriesToShops
 * @property Products[] $products
 * @property Category $category
 * @property User $user
 */
class Shops extends ActiveRecord
{
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%shops}}';
    }

    const SCENARIO_DEFAULT = 'SCENARIO_DEFAULT';
    const SCENARIO_UPDATE = 'SCENARIO_UPDATE';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'category_id'], 'required'],
            [['user_id', 'category_id', 'created_at', 'updated_at', 'active'], 'integer'],
            [['title', 'alias', 'meta_d', 'meta_k', 'text', 'logo'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            [['logo'], 'safe'],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'on' => self::SCENARIO_DEFAULT],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'on' => self::SCENARIO_UPDATE],
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert) {
                $this->user_id  = Yii::$app->user->getId();
//                $this->alias    = HelperTrait::titleTranslate($this->title);
            }

            $image = Upload::image($this, 'image', "logos");
            if(!empty($image)) $this->logo = $image[0];

            return true;
        }
        return false;
    }

    /**
     * @return array|array[]
     */
    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Пользователь'),
            'category_id' => Yii::t('app', 'Категория'),
            'title' => Yii::t('app', 'Название'),
            'alias' => Yii::t('app', 'Латинское название магазина'),
            'meta_d' => Yii::t('app', 'Описание страницы'),
            'meta_k' => Yii::t('app', 'Ключевые слова'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата редактирования'),
            'active' => Yii::t('app', 'Активность'),
            'text' => Yii::t('app', 'Описание'),
            'logo' => Yii::t('app', 'Логотип'),
            'image' => Yii::t('app', 'Логотип'),
        ];
    }

    /**
     * Gets query for [[Baskets]].
     *
     * @return \yii\db\ActiveQuery|BasketQuery
     */
    public function getBaskets()
    {
        return $this->hasMany(Basket::className(), ['shop_id' => 'id']);
    }

    /**
     * Gets query for [[Baskets]].
     *
     * @return \yii\db\ActiveQuery|BasketQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['shop_id' => 'id']);
    }

    /**
     * Gets query for [[CategoriesToShops]].
     *
     * @return \yii\db\ActiveQuery|CategoriesToShop
     */
    public function getCategoriesToShops()
    {
        return $this->hasMany(CategoriesToShop::className(), ['shop_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|ProductsQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['shop_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|CategoriesQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param $id
     * @return int|null
     */
    public static function categoryShop($id)
    {
        $model = static::findOne($id);
        return $model->category_id ?? null;
    }

    /**
     * {@inheritdoc}
     * @return ShopsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShopsQuery(get_called_class());
    }
}
