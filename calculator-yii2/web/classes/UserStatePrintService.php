<?php


class UserStatePrintService 
{
    private $separator;
    public function __construct(string $separator)
    {
        $this->separator = $separator;
    }
    public function printState($users)
    {
       foreach ($users as $user)
       {    echo '<pre>';
            echo 'ID пользователя: ' . $user->getId() . $this->separator;
            echo 'Имя пользователя: ' . $user->getName() . $this->separator;
            echo 'Возвраст пользователя: ' . $user->getAge() . $this->separator;
            echo 'Позиция пользователя: ' . $user->getPosition() . $this->separator;
            echo '=====================================================' . $this->separator;
       }
    
    }
}