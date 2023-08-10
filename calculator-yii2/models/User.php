<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\SignupForm;



class User extends ActiveRecord implements IdentityInterface
{
    
    

    public $password_repeat;
    public $authKey;
    public $plainPassword;

    public function __construct($config = [])
    {
    parent::__construct($config);
    }
    
    public static function tableName()
    {
        return 'user'; 
    }

    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['name'], 'match', 'pattern' => '/^[a-zA-Zа-яА-Я]+$/u', 'message' => 'Имя может содержать только буквы.'],
            [['email'], 'email', 'message' => 'Введите корректный адрес почты.'],
            [['password'], 'match', 'pattern' => '/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]+$/u', 'message' => 'Пароль должен содержать буквы и хотя бы 1 цифру.'],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают.'],
        ];
    }

    public function signup()
{
    if ($this->validate()) {
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->save(false);


        return $user;
    }

    return null;
}
public function login()
    {
       
     $user = User::findOne(['email' => $this->email]);
    if ($user && password_verify($this->password, $user->password_hash)) {
         Yii::$app->user->login($user);
        return true; 
    }
        

        return false; 
    }


public function setPassword($password)
{
    // $this->password = Yii::$app->security->generatePasswordHash($password);
    $this->password = $password;
}

    public function generateAuthKey()
    {
        $this->authKey = \Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->setPassword($this->password);
            }
            return true;
        }
        return false;
    }

    public function attributeLabels()
    {
        return[
            'name'=> 'Имя',
            'password'=> 'Пароль',
            'email'=> 'Электронная почта'
        ];
    }

  





    
    private static $users = [
        '100' => [
            'id' => '100',
            'name' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'name' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($name)
    {
        return static::findOne(['name' => $name]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    
}
