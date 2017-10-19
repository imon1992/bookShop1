<?php
//include('../../config.php');

class BagSql
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

    public function addToBag($bookId,$clientId,$count)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('INSERT INTO Bag(book_id,client_id,count)
                                              VALUES(:bookId,:clientId,:count)');
            $stmt->bindParam(':bookId',$bookId);
            $stmt->bindParam(':clientId',$clientId);
            $stmt->bindParam(':count',$count);
            $result = $stmt->execute();
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function deleteFromBag($userId,$bookIds)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('
                DELETE
                FROM Bag
                WHERE book_id = :bookId AND client_id = :clientId
                ');
            foreach($bookIds as &$bookId)
            {
                $stmt->bindParam(':bookId',$bookId);
                $stmt->bindParam(':clientId',$userId);
                $result = $stmt->execute();
            }
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function getUserBag($id)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT b.id,g.count,b.name,b.price,b.discount as bookDiscount, c.discount as clientDiscount
                                             FROM Bag as g
                                             INNER join Book as b on b.id = g.book_id
                                             INNER JOIN Client as c on c.id = g.client_id
                                             Where client_id = :id
                                            ');
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            $i=1;
            while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $assocRow['posNumber'] = $i;
                $result[] = $assocRow;
                $i++;
            }

        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function clearUserDag($userId)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('
                DELETE
                FROM Bag
                WHERE client_id = :userId
                ');
                $stmt->bindParam(':userId',$userId);
                $result = $stmt->execute();
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function updateUserBag($bookId,$userId,$count)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('UPDATE Bag
                                            SET count = :count
                                            WHERE book_id = :bookId AND client_id = :clientId');
//            foreach($newGenres as $key=>&$genreId)
//            {
                $stmt->bindParam(':count',$count);
                $stmt->bindParam(':bookId',$bookId);
                $stmt->bindParam(':clientId',$userId);
                $result = $stmt->execute();
//            }
        }else
        {
            $result = 'error';
        }

        return $result;
    }


}
