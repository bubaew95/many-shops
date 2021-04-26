<?php

namespace common\models\products;

use common\components\Upload;
use common\models\basket\Basket;
use common\models\basket\BasketQuery;
use common\models\categories\Category;
use common\models\categories\CategoriesQuery;
use common\models\orders\OrderItems;
use common\models\orders\OrderItemsQuery;
use common\models\shops\Shops;
use common\models\shops\ShopsQuery;
use common\modules\eav\models\EavAttribute;
use common\modules\eav\models\EavAttributeValue;
use common\modules\eav\models\EavEntity;
use common\traits\HelperTrait;
use common\modules\eav\backend\EavBehavior;
use voskobovich\linker\LinkerBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property int $shop_id Магазин
 * @property int $category_id Категория
 * @property string $title Название
 * @property string $alias Алиас
 * @property string $img Картинка
 * @property string|null $meta_d Описание страницы
 * @property string|null $meta_k Ключевые слова
 * @property float $price Цена
 * @property int $created_at Дата создания
 * @property int $updated_at Дата редактирования
 * @property int|null $active Активность
 * @property string|null $text Описание
 * @property int|null $discount Скидка
 * @property string|null $specifications Характеристики
 * @property int|null $is_installment Рассрочка
 * @property float|null $pre_order_price Цена за предзаказ
 *
 * @property Basket[] $baskets
 * @property OrderItems[] $orderItems
 * @property ProductImages[] $productImages
 * @property Category $category
 * @property Shops $shop
 */
class Products extends \yii\db\ActiveRecord
{
    public $image;
    public $images;

    const SCENARIO_DEFAULT = 'SCENARIO_DEFAULT';
    const SCENARIO_UPDATE = 'SCENARIO_UPDATE';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * @return array|array[]
     */
    public function behaviors(){
        return [
            'eav' => [
                'class'      => EavBehavior::className(),
                'valueClass' => EavAttributeValue::className(),
            ],
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            [
                'class' => LinkerBehavior::class,
                'relations' => [
                    'eav_ids' => 'eavToProducts',
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'price', 'text', 'title'], 'required'],

            [['shop_id', 'category_id', 'created_at', 'updated_at', 'active', 'discount', 'is_installment'], 'integer'],
            [['price', 'pre_order_price'], 'number'],
            [['text', 'specifications', 'img'], 'string'],
            [['title', 'alias', 'meta_d', 'meta_k'], 'string', 'max' => 255],
            [['alias'], 'unique'],

            [['img'], 'safe'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shops::className(), 'targetAttribute' => ['shop_id' => 'id']],

            //images
            [['image'], 'file', 'skipOnEmpty' => true,  'extensions' => 'png, jpg, jpeg', 'on' => self::SCENARIO_DEFAULT],
            [['images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5, 'on' => self::SCENARIO_DEFAULT],

            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'on' => self::SCENARIO_UPDATE],
            [['images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5, 'on' => self::SCENARIO_UPDATE],

            [['eav_ids'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->shop_id = Yii::$app->request->get('shop_id');
            $this->alias   = HelperTrait::titleTranslate($this->title, (int) date('dYs'));
        }

        $this->image  = Upload::image($this, 'image', HelperTrait::productImagesPath());
        $this->images = Upload::image($this, 'images', HelperTrait::productImagesPath());

        if($this->scenario === self::SCENARIO_DEFAULT && !$this->image) {
            $this->addError('image', 'Необходимо добавить «Картинку».');
            return false;
        }
        $this->saveBaseImage($this->image);

        if($this->scenario === self::SCENARIO_UPDATE && $this->images) {
            if(count($this->productImages) > 4) {
                $this->addError('images',
                'Кол-во картинок товара должно быть не больше 5.'
                );
                return false;
            }
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub

        $this->saveMiniImages($this->images);
    }

    /**
     * Сохранить базовое изображение
     * @param ProductImages $imagesModule
     * @return bool
     */
    private function saveBaseImage($image)
    {
        if(!$image) return false;
        $this->img = $image[0];
        return $image;
    }

    /**
     * Загрузка изображений
     * @param ProductImages $imagesModule
     * @return bool
     */
    private function saveMiniImages($images)
    {
        if(!$images) return false;

        foreach ($images as $item) {
            $imagesModule = new ProductImages();
            $imagesModule->image = $item;
            $imagesModule->link('product', $this);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_id' => Yii::t('app', 'Магазин'),
            'category_id' => Yii::t('app', 'Категория'),
            'title' => Yii::t('app', 'Название'),
            'alias' => Yii::t('app', 'Алиас'),
            'meta_d' => Yii::t('app', 'Описание страницы'),
            'meta_k' => Yii::t('app', 'Ключевые слова'),
            'price' => Yii::t('app', 'Цена'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата редактирования'),
            'active' => Yii::t('app', 'Активен'),
            'text' => Yii::t('app', 'Описание'),
            'discount' => Yii::t('app', 'Скидка'),
            'specifications' => Yii::t('app', 'Характеристики'),
            'is_installment' => Yii::t('app', 'Рассрочка'),
            'pre_order_price' => Yii::t('app', 'Цена за предзаказ'),
            'img'       => 'Картинка',
            'image'     => 'Картинка',
            'images'    => 'Миниатюрки',
            'eav_ids'   => 'Аттрибуты',
        ];
    }

    /**
     * Gets query for [[Baskets]].
     *
     * @return \yii\db\ActiveQuery|BasketQuery
     */
    public function getBaskets()
    {
        return $this->hasMany(Basket::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|OrderItemsQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductImages]].
     *
     * @return \yii\db\ActiveQuery|ProductImagesQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImages::className(), ['product_id' => 'id']);
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
     * Gets query for [[Shop]].
     *
     * @return \yii\db\ActiveQuery| ShopsQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes($product_id = null)
    {
        $model = EavAttribute::find()
            ->joinWith('entity')
            ->where([
                EavEntity::tableName() . '.categoryId' => (int) HelperTrait::get('shop_id'), // isset()? $this->category->id: 0,
                'entityModel' => self::class
            ]);

        if(!is_null($product_id)){
            $model->joinWith('product')
                ->andWhere([EavToProducts::tableName() . '.product_id' => (int) $_GET['id']]);
        }

        return $model;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributes()
    {
        return EavAttribute::find()
            ->with(['eavOptions', 'eavType', 'attributeRule'])
            ->innerJoinWith(['product'])
            ->where([ 
                EavToProducts::tableName() . '.product_id' => (int) $this->id
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getEavToProducts()
    {
        return $this->hasMany(EavAttribute::className(), ['id' => 'atr_id'])
            ->viaTable(EavToProducts::tableName(), ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }
}
