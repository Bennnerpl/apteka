<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

//class RegisterForm extends Model
//{
//    public $username;
//    public $email;
//    public $password;
//    public $repPass;
//

//
//
//    /**
//     * @return array the validation rules.
//     */
//    public function rules()
//    {
//        return [
//            // username and password are both required
//            [['fio', 'password','repPass','email'], 'required'],
//            // rememberMe must be a boolean value
//            // password is validated by validatePassword()
//            ['password', 'validatePassword'],
//        ];
//    }
//
//    /**
//     * Validates the password.
//     * This method serves as the inline validation for password.
//     *
//     * @param string $attribute the attribute currently being validated
//     * @param array $params the additional name-value pairs given in the rule
//     */
//    public function validatePassword($attribute, $params)
//    {
//        if (!$this->hasErrors()) {
//
//            if ($this->password != $this->repPass) {
//                $this->addError($attribute, 'Incorrect password.');
//            }
//        }
//    }
//    public function register()
//    {
//        if ($this->validate()) {
//            $user = new Users();
//            $user->email = $this->email;
//            $user->password = $user->setPassword($this->password);
//            $user->role = Users::ROLE_USER;
//            if ($user->save()) {
//                Yii::$app->getSession()->setFlash('success', 'successfully got on to the payment page');
//                return true;
//            }
//            return false;
//        }
//        return false;
//    }
//
//    /**
//     * Finds user by [[email]]
//     *
//     * @return Users|null
//     */
//    public function getUser()
//    {
//        if ($this->_user === false) {
//            $this->_user = Users::find()->where(['email' => $this->email])->one();
//        }
//        return $this->_user;
//    }
//
//}
class RegisterForm extends ActiveRecord
{

    public function rules(){
        return [
            [['fio', 'email'], 'required'],
            [['fio', 'email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 40],
        ];

    }

    public static function tableName()
    {
        return 'users';
    }
        public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::find()->where(['email' => $this->email])->one();
        }
        return $this->_user;
    }
}