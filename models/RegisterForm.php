<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Exception;
use app\models\Users;
class RegisterForm extends Model
{
    public $fio;
    public $email;
    public $password;
    public $repPass;
    public $role;
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['email', 'string', 'max' => 255],
            ['fio', 'string', 'max' => 255],
            [['email', 'password', 'repPass'], 'required'],
            ['email', 'unique', 'targetClass' => '\app\models\Users', 'message' => 'This email has already been taken.'],
            [['password'], 'string', 'max' => 40],
            [['role'], 'integer'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {

            if ($this->password != $this->repPass) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'fio' => 'имя',
            'email' => 'почта',
            'password' => 'пароль',
            'role' => 'роль',
        ];
    }
    public function registration()
    {
//        if ($this->validate()) {
//            $user = new Users();
//            $user->email = $this->email;
//            $user->password = $user->setPassword($this->password);
//            $user->role = Users::ROLE_USER;
//            $user->save();
//            if ($user->save()) {
//                \Yii::$app->user->login($this->getUser(), 3600*24*30);
//                \Yii::$app->getSession()->setFlash('success', 'Вы успешно зарегистрированы.');
//                return true;
//            }
//            return false;
//        }
//        return false;
        if (!$this->validate()) {
            return null;
        }

        $user = new Users();

        $user->fio = $this->fio;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->password = $this->password;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save();
    }

    /**
     * Finds user by [[email]]
     *
     * @return Users|array|ActiveRecord|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::find()->where(['email' => $this->email])->one();
        }
        return $this->_user;
    }
}
