<?php
//include('config.php');

class AuthorSql
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

    public function addAuthor($name,$surname)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('INSERT INTO Author(name,surname)
                                              VALUES(:name,:surname)');
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':surname',$surname);
            $result = $stmt->execute();
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function updateAuthor($id,$name,$surname)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('UPDATE Author
                                            SET name = :name,surname=:surname
                                            WHERE id = :id');
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':surname',$surname);
            $stmt->bindParam(':id',$id);
            $result = $stmt->execute();
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function getAllAuthors()
    {
        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT *
                                            FROM Author
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

//    public function getAuthorById($id)
//    {
//        $result = [];
//        if($this->dbConnect !== 'connect error')
//        {
//            $stmt =$this->dbConnect->prepare('SELECT *
//                                            FROM Author
//                                            WHERE id = :id
//                                            ');
//            $stmt->bindParam(':id',$id);
//            $stmt->execute();
//            while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
//            {
//                $result[]=$assocRow;
//            }
//        }else
//        {
//            $result = 'error';
//        }
//
//        return $result;
//    }

    public function deleteAuthor($id)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('DELETE
                                            FROM Author
                                            WHERE id = :id');
            $stmt->bindParam(':id',$id);
            $result = $stmt->execute();
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function deleteBookAuthor($id)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('DELETE
                                            FROM BookAuthor
                                            WHERE author_id = :id');
            $stmt->bindParam(':id',$id);
            $result = $stmt->execute();
        }else
        {
            $result = 'error';
        }

        return $result;
    }
}