<?php

declare (strict_types = 1);

class User{
    protected $id,
              $name,
              $email,
              $pass;

    public function __construct(array $array)
    {
        $this->hydrate($array);
    }

    /**
     * hydrate function
     *
     * @param array $data
     * @return void
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
            return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
            $this->email = $email;

            return $this;
    }

    /**
     * Get the value of pass
     */ 
    public function getPass()
    {
            return $this->pass;
    }

    /**
     * Set the value of pass
     *
     * @return  self
     */ 
    public function setPass($pass)
    {
            $this->pass = $pass;

            return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
                return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
                $this->name = $name;

                return $this;
    }
}