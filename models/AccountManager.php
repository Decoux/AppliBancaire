<?php

declare(strict_types = 1);

class AccountManager
{

    private $_db;

    /**
     * Function contructor 
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->setDb($db);
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
    public function setDb(PDO $db)
    {
        $this->_db = $db;

        return $this;
    }

    public function addAccount(Account $account){
        $req = $this-> getDb()->prepare('INSERT INTO accounts(name, balance) VALUES (:name, :balance)');
        $req->bindValue(':name', $account->getName(), PDO::PARAM_STR);
        $req->bindValue(':balance', $account->getBalance(), PDO::PARAM_STR);
        $req->execute();
    }

    public function getAccounts(){
        $arrayOfAccount = [];
        $req = $this->getDb()->query('SELECT * FROM accounts');
        $data_accounts = $req->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($data_accounts)) {
            foreach ($data_accounts as $account) {
                $arrayOfAccount[]= new Account($account);
            }
            return $arrayOfAccount;
        }
    }

    /**
     * function getAccountById
     *
     * @param integer $id
     * @return void
     */
    public function getAccountById(int $id){
        $req = $this->getDb()->prepare('SELECT * FROM accounts WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        $dataAccount = $req ->fetch(PDO::FETCH_ASSOC);

        $objectAccount = new Account($dataAccount);
        return $objectAccount;

    }

    /**
     * function updateFounds on account
     *
     * @param integer $id
     * @param integer $balance
     * @return void
     */
    public function creditFounds(Account $account, int $balancePost){
        $req = $this->getDb()->prepare('UPDATE accounts SET balance = balance + :balance WHERE id = :id');
        $req->bindValue(':balance', $balancePost, PDO::PARAM_INT);
        $req->bindValue(':id', $account->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    public function deptFounds(Account $account, int $balancePost)
    {
        $req = $this->getDb()->prepare('UPDATE accounts SET balance = balance - :balance WHERE id = :id');
        $req->bindValue(':balance', $balancePost, PDO::PARAM_INT);
        $req->bindValue(':id', $account->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    public function getAccountByName(string $name)
    {
        $req = $this->getDb()->prepare('SELECT * FROM accounts WHERE name = :name');
        $req->bindValue(':name', $name, PDO::PARAM_STR);
        $req->execute();
        $data_account = $req->fetch();
        return $data_account;

    }

    public function transferDeptFounds(Account $account, int $balancePost){
        $req = $this->getDb()->prepare('UPDATE accounts SET balance = balance - :balance WHERE id = :id');
        $req->bindValue(':balance', $balancePost, PDO::PARAM_INT);
        $req->bindValue(':id', $account->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    public function tranferCreditFounds(Account $account, int $balancePost){
        $req = $this->getDb()->prepare('UPDATE accounts SET balance = balance + :balance WHERE id = :id');
        $req->bindValue(':balance', $balancePost, PDO::PARAM_INT);
        $req->bindValue(':id', $account->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    public function deleteAccount(Account $account){
        $req = $this->getDb()->prepare('DELETE FROM accounts WHERE id = :id');
        $req->bindValue(':id', $account->getId() , PDO::PARAM_INT);
        $req->execute();

    }


}
