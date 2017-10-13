<?php
//include('../../config.php');

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
            $stmt->execute();
            $result = $this->dbConnect->lastInsertId();
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function addBookGenre($bookId,$genres)
    {
        if($this->dbConnect !== 'connect error')
        {
            foreach($genres as &$genreId)
            {
                $stmt =$this->dbConnect->prepare('INSERT INTO BookGenre(book_id,genre_id)
                                                  VALUES(:bookId,:genreId)');
                $stmt->bindParam(':bookId',$bookId);
                $stmt->bindParam(':genreId',$genreId);
                $result = $stmt->execute();
            }
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function addBookAuthor($bookId,$authors)
    {
        if($this->dbConnect !== 'connect error')
        {
            foreach($authors as &$authorId)
            {
                $stmt =$this->dbConnect->prepare('INSERT INTO BookAuthor(book_id,author_id)
                                                  VALUES(:bookId,:authorId)');
                $stmt->bindParam(':bookId',$bookId);
                $stmt->bindParam(':authorId',$authorId);
                $result = $stmt->execute();
            }
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
            $stmt =$this->dbConnect->prepare('SELECT b.*,a.name as authorName,a.surname, a.id as authorId, g.name as genreName, g.id as genreId
                                                FROM Book as b
                                                INNER JOIN BookAuthor as ba on b.id =ba.book_id
                                                INNER JOIN Author as a on a.id = ba.author_id
                                                INNER JOIN BookGenre as bg on b.id =bg.book_id
                                                INNER JOIN Genre as g on g.id = bg.genre_id
                                            ');

            $stmt->execute();
            while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                if(array_key_exists($assocRow['id'],$result))
                {
                    if(!array_key_exists($assocRow['genreId'],$result[$assocRow['id']]['genres']))
                    {
                    $genre = ['id'=>$assocRow['genreId'],'name'=>$assocRow['genreName']];
                        $result[$assocRow['id']]['genres'][$assocRow['genreId']] = $genre;
                    }
                    if(!array_key_exists($assocRow['authorId'],$result[$assocRow['id']]['authors']))
                    {
                    $author = ['id'=>$assocRow['authorId'],'name'=>$assocRow['authorName'],
                        'surname'=>$assocRow['surname']];
                        $result[$assocRow['id']]['authors'][$assocRow['authorId']] = $author;
                    }
                } else
                {
                    $book['id'] = $assocRow['id'];
                    $book['name'] = $assocRow['name'];
                    $book['price'] = $assocRow['price'];
                    $book['description'] = $assocRow['description'];
                    $book['genres'][$assocRow['genreId']] = ['id'=>$assocRow['genreId'],'name'=>$assocRow['genreName']];
                    $book['authors'][$assocRow['authorId']] = ['id'=>$assocRow['authorId'],'name'=>$assocRow['authorName'],
                                    'surname'=>$assocRow['surname']];
                    $book['discount'] = $assocRow['discount'];
                    $result[$assocRow['id']] = $book;
                }
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

    public function updateBookAuthor($bookId,$newAuthors,$oldAuthors)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('UPDATE BookAuthor
                                            SET author_id = :name, price = :price, description=:description, discount=:discount
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

    public function updateBookGenres($bookId,$genres)
    {

    }

    public function getBookGenreId($bookId,$genres)
    {
//        var_dump($genres);
        foreach($genres as &$genre)
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT id
                                            FROM BookGenre
                                            WHERE book_id = :bookId AND genre_id = :genreId');
            $stmt->bindParam(':bookId',$bookId);
//            var_dump($genre['id']);
            $stmt->bindParam(':genreId',$genre['id']);
            $result = $stmt->execute();
            while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
//                $result1[] = $assocRow['id'];
                var_dump($assocRow['id']);
            }
        }else
        {
            $result = 'error';
        }

        return $result;
    }
}

//$c = new BookSql();
//$x = $c->getAllBooks();
//print_r($x);