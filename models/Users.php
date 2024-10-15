<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $fio Имя пользователя
 * @property string $email Почта
 * @property string|null $password Пароль
 * @property int $role Роль
 *
 * @property Orders[] $orders
 * @property mixed|null $users
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public const ROLE_GUEST = 0;
    public const ROLE_USER = 1;
    public const ROLE_ADMIN = 2;
    public $authKey;
    public $accessToken;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function setPassword($password)
    {

        return sha1($password);
    }

    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }


    public static function findByEmail($email)
    {
        return static::find()->where('email=:email', [":email" => $email])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'email', 'role'], 'required'],
            [['role'], 'integer'],
            ['rememberMe', 'boolean'],
            [['fio', 'email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
            'rememberMe' => 'Remember Me',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    public static function findByFio($fio)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['fio'], $fio) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['user_id' => 'id']);
    }

}
