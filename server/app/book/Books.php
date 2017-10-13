<?php

class Books
{

    protected $bookSql;

    public function __construct()
    {
        $this->bookSql = new BookSql();
    }

    public function getBook($params = false)
    {
        if($params == false)
        {
            $result = $this->bookSql->getAllBooks();
        }
        return $result;
    }

    public function postBook($params)
    {
//        var_dump(json_decode($_POST['genres']));
        if($params == false )
        {
            $name = json_decode($_POST['name']);
            $price = json_decode($_POST['price']);
            $description = json_decode($_POST['description']);
            $discount = json_decode($_POST['discount']);
            $result = $this->bookSql->addBook($name,$price,$description,$discount);
            $bookId = $result;
            if($result !== 'error' && $result !== false)
            {
                $genres = json_decode($_POST['genres']);
                $result = $this->bookSql->addBookGenre($bookId,$genres);
            } else {
                $result = 'error';
            }

            if($result !== 'error' && $result !== false)
            {
                $authors = json_decode($_POST['authors']);
                $result = $this->bookSql->addBookAuthor($bookId,$authors);
            } else {
                $result = 'error';
            }

        }
        return $result;
    }

    public function putBook($params)
    {
        if($params == false )
        {
            $putStr = file_get_contents('php://input');
            $generatePutData = new GenerateData();
            $putData = $generatePutData->generatePutData($putStr);

//            var_dump($putData);

            $oldCount = count($putData['oldGenres']);
            $newCount = count($putData['newGenres']);
//            var_dump($putData['oldGenres']);
//            foreach($putData['oldGenres'] as $val)
//            {
//                $x[] = $val;
//            }
//            var_dump($x);
            $result = $this->bookSql->getBookGenreId('1',$putData['oldGenres']);
            var_dump($result);
//            var_dump($oldCount,$newCount);
            if($oldCount > $newCount)
            {
                $deletedKeys = array_rand($putData['oldGenres'],$oldCount-$newCount);
                var_dump($deletedKeys);
                echo 'нужно удалить какое-то количество с базы и сделать апдейт оставшихся';
            }
            if($oldCount < $newCount)
            {
                echo 'нужно апдейтнуть старые и добавить новые';
            }
//            $result = $this->bookSql->updateBook($putData['id'],$putData['name'],$putData['price'],$putData['description'],
//                $putData['discount']);
        }

//        return $result;
    }
}
