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
            $stmt =$this->dbConnect->prepare('
                INSERT INTO BookGenre(book_id,genre_id)
                VALUES(:bookId,:genreId)
                ');
            foreach($genres as &$genreId)
            {
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
            $stmt =$this->dbConnect->prepare('INSERT INTO BookAuthor(book_id,author_id)
                                              VALUES(:bookId,:authorId)');
            foreach($authors as &$authorId)
            {
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
//        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT b.*,a.name as authorName,a.surname, a.id as authorId, g.name as genreName, g.id as genreId
                                                FROM Book as b
                                                LEFT JOIN BookAuthor as ba on b.id =ba.book_id
                                                LEFT JOIN Author as a on a.id = ba.author_id
                                                LEFT JOIN BookGenre as bg on b.id =bg.book_id
                                                LEFT JOIN Genre as g on g.id = bg.genre_id
                                            ');

            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = [];
            foreach ($data as $val)
            {
//                var_dump($val);
                if (!isset($result[$val['id']]))
                {
                    $result[$val['id']] = $val;
                }
                if ($result[$val['id']]['id'] == $val['id'])
                {
                    $result[$val['id']]['authors'][$val['authorId']] = ['id'=>$val['authorId'], 'name'=>$val['authorName'],'surname'=>$val['surname']];
                    $result[$val['id']]['genres'][$val['genreId']] = ['id'=>$val['genreId'], 'name'=>$val['genreName']];
                    unset($result[$val['id']]['authorId']);
                    unset($result[$val['id']]['authorName']);
                    unset($result[$val['id']]['surname']);
                    unset($result[$val['id']]['genreId']);
                    unset($result[$val['id']]['genreName']);
                }
                //Remove duplicate elements of a multidimensional array
//                $result[$val['id']]['authors'] = array_map("unserialize", array_unique(array_map("serialize", $result[$val['id']]['authors'])));
//                $result[$val['id']]['genres'] = array_map("unserialize", array_unique(array_map("serialize", $result[$val['id']]['genres'])));
            }
            //Reindex arr
//            $result = array_values($result);
//            var_dump($result);
            return $result;
//            while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
//            {
//                if(array_key_exists($assocRow['id'],$result))
//                {
//                    if (!array_key_exists($assocRow['genreId'], $result[$assocRow['id']]['genres']))
//                    {
//                        $genre = ['id' => $assocRow['genreId'], 'name' => $assocRow['genreName']];
//                        $result[$assocRow['id']]['genres'][$assocRow['genreId']] = $genre;
//                    }
//                    if(!array_key_exists($assocRow['authorId'],$result[$assocRow['id']]['authors']))
//                    {
//                    $author = ['id'=>$assocRow['authorId'],'name'=>$assocRow['authorName'],
//                        'surname'=>$assocRow['surname']];
//                        $result[$assocRow['id']]['authors'][$assocRow['authorId']] = $author;
//                    }
//                } else
//                {
//                    $book['id'] = $assocRow['id'];
//                    $book['name'] = $assocRow['name'];
//                    $book['price'] = $assocRow['price'];
//                    $book['description'] = $assocRow['description'];
//                    $book['genres'][$assocRow['genreId']] = ['id'=>$assocRow['genreId'],'name'=>$assocRow['genreName']];
//                        $book['authors'][$assocRow['authorId']] = ['id'=>$assocRow['authorId'],'name'=>$assocRow['authorName'],
//                                    'surname'=>$assocRow['surname']];
//                    $book['discount'] = $assocRow['discount'];
//                    $result[$assocRow['id']] = $book;
//                }
//            }
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function getBookById($id)
    {
        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare("select Book.id,Book.name,Book.price,Book.description,Book.discount,
                    GROUP_CONCAT(DISTINCT Author.name,' ',Author.surname ORDER BY Author.name ASC SEPARATOR ', ')as authors,
                    GROUP_CONCAT(DISTINCT Genre.name ORDER BY Genre.name ASC SEPARATOR ', ') as genres
                    FROM Book LEFT JOIN BookAuthor ON Book.id=BookAuthor.book_id
                    LEFT JOIN BookGenre ON Book.id=BookGenre.book_id
                    LEFT JOIN Author ON Author.id=BookAuthor.author_id
                    LEFT JOIN Genre ON Genre.id=BookGenre.genre_id
                    WHERE Book.id = :id"
            );
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $result = $assocRow; 
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
                                            SET author_id = :newAuthorId
                                            WHERE book_id = :bookId AND author_id = :oldAuthorId');
            foreach($newAuthors as $key=>&$authorId)
            {
                $stmt->bindParam(':newAuthorId',$authorId['id']);
                $stmt->bindParam(':bookId',$bookId);
                $stmt->bindParam(':oldAuthorId',$oldAuthors[$key]['id']);
                $result = $stmt->execute();
            }
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function deleteBookGenre($bookId,$genres)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('
                DELETE
                FROM BookGenre
                WHERE book_id = :bookId AND genre_id = :genreId
                ');
            foreach($genres as &$genreId)
            {
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

    public function deleteBookAuthor($bookId,$authors)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('
                DELETE
                FROM BookAuthor
                WHERE book_id = :bookId AND author_id = :authorId
                ');
            foreach($authors as &$authorId)
            {
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

    public function updateBookGenres($bookId,$newGenres,$oldGenres)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('UPDATE BookGenre
                                            SET genre_id = :newGenreId
                                            WHERE book_id = :bookId AND genre_id = :oldGenreId');
            foreach($newGenres as $key=>&$genreId)
            {
                $stmt->bindParam(':newGenreId',$genreId['id']);
                $stmt->bindParam(':bookId',$bookId);
                $stmt->bindParam(':oldGenreId',$oldGenres[$key]['id']);
                $result = $stmt->execute();
            }
        }else
        {
            $result = 'error';
        }

        return $result;
    }
}

//$c = new BookSql();
//$c->getAllBooks();
