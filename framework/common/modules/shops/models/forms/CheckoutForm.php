<?php


namespace common\modules\shops\models\forms;


use common\models\orders\OrderItems;
use common\models\orders\Orders;
use common\models\user\address\UserAddress;
use common\models\user\User;
use common\models\user\UsersInd;
use common\traits\HelperTrait;

class CheckoutForm extends \yii\base\Model
{
    public $first_name;
    public $last_name;
    public $country;
    public $region;
    public $city;
    public $address;
    public $email;
    public $phone;
    public $password;
    public $repassword;
    public $post_code;
    public $is_create_account;
    public $order_note;
    public $delivery;
    public $payment;

    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_REGISTER = 'registration';

    public function rules()
    {
        return [
            [[
                'first_name', 'last_name',  'city',
                'address', 'email', 'phone'
            ], 'required', 'on' => self::SCENARIO_DEFAULT ],
            [[
                'first_name', 'last_name',  'city',
                'address', 'email', 'phone',
                'password', 'repassword'
            ], 'required', 'on' => self::SCENARIO_REGISTER ],
            [[
                'first_name', 'last_name', 'address',
                'email', 'phone', 'order_note'
            ], 'string', 'max' => 255],
            [['post_code'], 'string', 'max' => 16],
            [['country', 'city', 'region'], 'integer'],
            [['is_create_account'], 'string'],
            [['repassword', 'password'], 'string', 'min' => 6, 'max' => 32],
            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают', 'on' => self::SCENARIO_REGISTER],
            [['delivery', 'payment', 'country', 'region'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'first_name' => 'Фамилия',
            'last_name'  => 'Имя',
            'country'   => 'Страна',
            'city'      => 'Город/Село',
            'region'    => 'Регион',
            'address'   => 'Адресс',
            'email'     => 'E-mail',
            'phone'     => 'Телефон',
            'order_note' => 'Комментарий к заказу',
            'delivery'  => 'Доставка',
            'payment'   => 'Оплата',
            'post_code'  => 'Почтовый индекс',
            'is_create_account' => '',
            'password' => 'Пароль',
            'repassword' => 'Подтвердить пароль',
        ];
    }

    public function __construct($config = [], User $user = null)
    {
        parent::__construct($config);
        if($user) {
           $this->first_name = $user->ind->firstname;
           $this->last_name  = $user->ind->name;
           $this->phone     = $user->phone;
           $this->email     = $user->email;
           $this->city      = $user->address->city_id;
           $this->region    = $user->address->region_id;
           $this->address   = $user->address->address;
           $this->address   = $user->address->address;
           $this->post_code  = $user->address->post_code;
        }
    }

    private static function userObject()
    {
        if(\Yii::$app->user->isGuest && !HelperTrait::userId()) return new User();
        return User::find()
            ->with(['ind', 'leg', 'address'])
            ->where(['id' => HelperTrait::userId()])
            ->one();
    }

    public static function getModel()
    {
        return new static([], self::userObject());
    }

    /**
     * Инициализация данных
     * @param $user
     * @return UsersInd
     */
    private function userSubDataTable($user)
    {
        if($user->ind) {
            $user->ind->firstname = $this->first_name;
            $user->ind->name      = $this->last_name;
            return $user->ind;
        } else {
            $user = new UsersInd();
            $user->firstname = $this->first_name;
            $user->name = $this->last_name;
            return $user;
        }
    }

    /**
     * Инициализация адреса пользователя
     * @param $user
     * @return UserAddress
     */
    private function userAddress($user)
    {
        if($user->address) {
            $user->address->city_id     = $this->city;
            $user->address->region_id   = $this->region;
            $user->address->address     = $this->address;
            $user->address->address     = $this->address;
            $user->address->post_code   = $this->post_code;
            return $user->address;
        } else {
            $user = new UserAddress();
            $user->city_id     = $this->city;
            $user->region_id   = $this->region;
            $user->address     = $this->address;
            $user->address     = $this->address;
            $user->post_code   = $this->post_code;
            return $user;
        }
    }

    /**
     * Сохранение данных поьлзователя
     * @return array|User
     */
    private function userObjectData()
    {
        $user = self::userObject();
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->type = 1; //TODO: Потом поменять
        if(!$user->save()) {
            return $user->errors;
        }
        HelperTrait::getSetCookie('user_id', $user->id);
        $user->link('ind',      $this->userSubDataTable($user));
        $user->link('address',  $this->userAddress($user));
        return $user;
    }

    private function orderSave(int $userId)
    {
        $order = new Orders();
        $order->user_id = $userId;
        return $order->save() ? $order : null;
    }

    private function orderItems($order)
    {
        if(!$_SESSION['cart']['items']) return [];
        $itemsList = [];
        foreach ($_SESSION['cart']['items'] as $item) {
            $orderItems             = new OrderItems();
            $orderItems->status_id  = 1;
            $orderItems->product_id = $item['id'];
            $orderItems->shop_id    = $item['shop_id'];
            $orderItems->price      = $item['sum'];
            $orderItems->qty        = $item['qty'];
            $orderItems->order_id   = $order->id;
            $orderItems->title      = $item['title'];
            $orderItems->image      = $item['img'];
//            $itemsList[] = $orderItems;
            if(!$orderItems->save()) {
                $itemsList[] = $orderItems->errors;
            }
        }
        return $itemsList;
    }

    public function save()
    {
        if(!$this->validate()) return false;
        $user = $this->userObjectData();
        $order = new Orders();
        $order->user_id = $user->id;
        $order->save();
        $this->orderItems($order);
        return $order->id;
    }
}