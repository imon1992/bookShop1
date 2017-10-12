<?php
//include('config.php');

class BookSql
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

    public function addBook($name,$price,$description,$discount)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('INSERT INTO Book(name,price,description,discount)
                                              VALUES(:name,:price,:description,:discount)');
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':price',$price);
            $stmt->bindParam(':description',$description);
            $stmt->bindParam(':discount',$discount);
            $result = $stmt->execute();
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function getAllBooks()
    {
        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT *
                                            FROM Book
                                            ');

            $stmt->execute();
            while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $result[$assocRow['id']]=$assocRow;
            }
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function updateBook($id,$name,$price,$description,$discount)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('UPDATE Book
                                            SET name = :name, price = :price, description=:description, discount=:discount
                                            WHERE id = :id');
            $stmt->bindParam(':id',$id);
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':price',$price);
            $stmt->bindParam(':description',$description);
            $stmt->bindParam(':discount',$discount);
            $result = $stmt->execute();
        }else
        {
            $result = 'error';
        }

        return $result;
    }
}