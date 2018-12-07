<?php

declare(strict_types = 1);

class Account
{
    protected   $id,
                $name,
                $iduser,
                $balance;

    /**
     * constructor function
     *
     * @param array $array
     */
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
    public function setName(string $name)
    {
    $this->name = $name;

    return $this;
    }

    /**
     * Get the value of balance
     */ 
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set the value of balance
     *
     * @return  self
     */ 
    public function setBalance($balance)
    {
        $balance = intval($balance);
        $this->balance = $balance;

        return $this;
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
        $id = intval($id);
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of iduser
     */ 
    public function getIduser()
    {
            return $this->iduser;
    }

    /**
     * Set the value of iduser
     *
     * @return  self
     */ 
    public function setIduser($iduser)
    {
            $this->iduser = $iduser;

            return $this;
    }
}
