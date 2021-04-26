<?php
namespace common\models\user;

use common\models\user\address\UserAddress;
use common\traits\HelperTrait;
use voskobovich\linker\LinkerBehavior;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $phone Номер телефона
 * @property string|null $email E-mail
 * @property int|null $type Тип пользователя
 * @property string|null $image Изображение
 * @property string|null $auth_key Токен
 * @property string|null $verification_token Токен верифликации
 * @property string|null $password_hash Пароль
 * @property string|null $password_reset_token Ключ восстановления пароля
 * @property int $status Статус пользователя
 * @property int $created_at Дата регистрации
 * @property int $updated_at Дата обновлении
 *
 * @property UsersInd[] $usersInds
 * @property UsersLeg[] $usersLegs
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED  = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE   = 10;
    const STATUS_BAN      = 20;

    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_UPDATE = 'update';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => LinkerBehavior::className(),
                'relations' => [
                    'user_id' => ['ind', 'leg'],
//                    'user_id' => 'leg'
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
//            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            [['phone', 'type', 'image'], 'safe', 'on' => self::SCENARIO_UPDATE],
            [['phone', 'type'], 'required', 'on' => self::SCENARIO_DEFAULT],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED, self::STATUS_BAN]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Номер телефона',
            'email' => 'E-mail',
            'type' => 'Тип пользователя',
            'region_id' => 'Регион',
            'city_id' => 'Город',
            'comment' => 'Комментарий',
            'image' => 'Изображение',
            'auth_key' => 'Токен',
            'verification_token' => 'Токен верифликации',
            'password_hash' => 'Пароль',
            'password_reset_token' => 'Ключ восстановления пароля',
            'status' => 'Статус пользователя',
            'created_at' => 'Дата регистрации',
            'updated_at' => 'Дата обновлении',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Поиск существуюшего email
     * @param $email
     * @return User|null
     */
    public static function findEmail($email): ?User
    {
        $model = static::find()->where(['email' => $email]);
        if(Yii::$app->user->getId()) {
            $model->andWhere(['!=', 'id', Yii::$app->user->identity->getId()]);
        }
        return $model->one();
    }

    /**
     * Поиск по номеру телефона
     * @param string $phone
     * @return User|null
     */
    public static function findPhone(string $phone): ?User
    {
        $model = static::find()->where(['phone' => HelperTrait::clearPhone($phone)]);
        if(Yii::$app->user->getId()) {
            $model->andWhere(['!=', 'id', Yii::$app->user->identity->getId()]);
        }
        return $model->one();
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by phone
     *
     * @param string $phone
     * @return static|null
     */
    public static function findByPhone($phone)
    {
        return static::findOne(['phone' => HelperTrait::clearPhone($phone)]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->type == 1
            ? $this->getFio()
            : $this->leg->org_name;
    }

    public function getFio()
    {
        return "{$this->ind->firstname} {$this->ind->name} {$this->ind->lastname}";
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


    /**
     * Gets query for [[UsersInds]].
     *
     */
    public function getInd()
    {
        return $this->hasOne(UsersInd::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UsersLegs]].
     *
     */
    public function getLeg()
    {
        return $this->hasOne(UsersLeg::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserAddress]].
     * @return @return \yii\db\ActiveQuery|UserAddressQuery
     */
    public function getAddress()
    {
        return $this->hasOne(UserAddress::className(), ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
