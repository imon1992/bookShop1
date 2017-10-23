<?php


class GetHashForrTest
{

    private $dbConnect;

    public function __construct()
    {
        $baseAndHostDbName = MY_SQL_DB . ':host=' . MY_SQL_HOST . '; dbname=' . MY_SQL_DB_NAME;
        try {
            $this->dbConnect = new PDO($baseAndHostDbName, MY_SQL_USER, MY_SQL_PASSWORD);
            $this->dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->dbConect = 'connect error';
        }
    }

    public function getHash()
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT hash from client where role = \'admin\' limit 1');
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else
        {
            $result = 'error';
        }

        return $result;
    }


}


//config
define("MY_SQL_DB",     "mysql");
define("MY_SQL_HOST",     "localhost");
define("MY_SQL_DB_NAME",     "BookShop");
//define("MY_SQL_DB_NAME",     "user14");
define("MY_SQL_USER",     "user14");
define("MY_SQL_PASSWORD",     "tuser14");