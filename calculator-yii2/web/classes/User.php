<?php




class User
{
    private $id;
    private $name;
    private $posotion;
    private $age;
    public function __construct(string $name,string $positin, int $age){
        $this->name = $name;
        $this-> position = $positin;
        $this-> age = $age;
        $this -> initId();

    }
    public function initId(): void
    {
        $this->id = md5( $this->age. ':' . $this->name. ':' . $this->position);
    }
    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    public function getPosition()
    {
        return $this->position;
    }
    public function getAge()
    {
        return $this->age;
    }

   
}