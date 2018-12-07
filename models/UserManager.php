<?php

declare (strict_types = 1);

class UserManager{
    private $_db;

    /**
     * constructor method
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }   

    /**
     * function Add user in database
     *
     * @param User $user
     * @return void
     */
    public function addUser(User $user){
        $req = $this->getDb()->prepare('INSERT INTO users(name, email, pass) VALUE (:name, :email, :pass)');
        $req->bindValue(':name', $user->getName(), PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':pass', $user->getPass(), PDO::PARAM_STR);
        $req->execute();
    }

    public function getObjectUserByEmail(User $user){
        $req = $this->getDb()->prepare('SELECT * FROM users WHERE email = :email');
        $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $req->execute();
        $data_user = $req->fetch(PDO::FETCH_ASSOC);
        $object_data_user = new User($data_user);
        return $object_data_user;
    }

    public function getUserByEmail($email)
    {
        $req = $this->getDb()->prepare('SELECT * FROM users WHERE email = :email');
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();
        $data_user = $req->fetch(PDO::FETCH_ASSOC);
        return $data_user;
    }
    /**
     * Get the value of _db
     */ 
    public function getDb()
    {
        return $this->_db;
    }

    /**
     * Set the value of _db
     *
     * @return  self
     */ 
    public function setDb($db)
    {
        $this->_db = $db;

        return $this;
    }
}