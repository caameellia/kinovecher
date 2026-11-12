<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required', 'message' => 'Заполните поле.'],
            [['username', 'email'], 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 32],
            ['username', 'match', 'pattern' => '/^[\p{L}\p{N}_-]+$/u', 'message' => 'Допустимы буквы, цифры, _ и -.'],
            ['email', 'email', 'message' => 'Некорректный email.'],
            ['email', 'string', 'max' => 255],
            ['password', 'string', 'min' => 8, 'max' => 128],
        ];
    }

    public function register()
    {
        if (!$this->validate()) return null;
        try {
            return User::createUser($this->username, $this->email, $this->password);
        } catch (\DomainException $e) {
            $this->addError('username', $e->getMessage());
            return null;
        }
    }
}
