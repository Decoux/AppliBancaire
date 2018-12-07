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

    /**
     * Add accout in database
     *
     * @param Account $account
     * @return void
     */
    public function addAccount(Account $account){
        $req = $this-> getDb()->prepare('INSERT INTO accounts(name, balance, iduser) VALUES (:name, :balance, :iduser)');
        $req->bindValue(':name', $account->getName(), PDO::PARAM_STR);
        $req->bindValue(':balance', $account->getBalance(), PDO::PARAM_STR);
        $req->bindValue(':iduser', $_SESSION['id'], PDO::PARAM_STR);


        $req->execute();
    }

    /**
     * Get all accout from database
     *
     * @return void
     */
    public function getAccountsByIdUser(){
        $arrayOfAccount = [];
        $req = $this->getDb()->prepare('SELECT * FROM accounts WHERE iduser = :iduser');
        $req->bindValue(':iduser', $_SESSION['id'], PDO::PARAM_STR);
        $req->execute();

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

    /**
     * function dept foudns, calcul and update in database
     *
     * @param Account $account
     * @param integer $balancePost
     * @return void
     */
    public function deptFounds(Account $account, $balancePost)
    {
        $req = $this->getDb()->prepare('UPDATE accounts SET balance = balance - :balance WHERE id = :id');
        $req->bindValue(':balance', $balancePost, PDO::PARAM_INT);
        $req->bindValue(':id', $account->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    /**
     * Function get account by id in database
     *
     * @param string $name
     * @return void
     */
    public function getAccountByName(Account $account)
    {
        $req = $this->getDb()->prepare('SELECT * FROM accounts WHERE name = :name AND iduser = :iduser');
        $req->bindValue(':name', $account->getName(), PDO::PARAM_STR);
        $req->bindValue(':iduser', $account->getIduser(), PDO::PARAM_STR);

        $req->execute();
        $data_account = $req->fetch();
        return $data_account;

    }

     /**
      * function dept fouds for transfer founds and update in database
      *
      * @param Account $account
      * @param integer $balancePost
      * @return void
      */
    public function transferDeptFounds(Account $account, int $balancePost){
        $req = $this->getDb()->prepare('UPDATE accounts SET balance = balance - :balance WHERE id = :id');
        $req->bindValue(':balance', $balancePost, PDO::PARAM_INT);
        $req->bindValue(':id', $account->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    /**
     * function credit founds after transfer and update in database
     *
     * @param Account $account
     * @param integer $balancePost
     * @return void
     */
    public function tranferCreditFounds(Account $account, int $balancePost){
        $req = $this->getDb()->prepare('UPDATE accounts SET balance = balance + :balance WHERE id = :id');
        $req->bindValue(':balance', $balancePost, PDO::PARAM_INT);
        $req->bindValue(':id', $account->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    /**
     * function delete account in database
     *
     * @param Account $account
     * @return void
     */
    public function deleteAccount(Account $account){
        $req = $this->getDb()->prepare('DELETE FROM accounts WHERE id = :id');
        $req->bindValue(':id', $account->getId() , PDO::PARAM_INT);
        $req->execute();

    }
    
    public function getAccountByIdUser($id_user){
        $req = $this->getDb()->prepare('SELECT * FROM accounts WHERE iduser = :iduser');
        $req->bindValue(':id', $account->getId(), PDO::PARAM_INT);
        
    }

}
