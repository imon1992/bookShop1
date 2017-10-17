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

            $oldAuthors = $putData['oldAuthors'];
            $newAuthors = $putData['newAuthors'];

            $oldGenres = $putData['oldGenres'];
            $newGenres = $putData['newGenres'];

//            var_dump($putData);
            $oldNewAuthors = $this->genresAuthors($oldAuthors,$newAuthors);
            $oldNewGenres = $this->genresAuthors($oldGenres,$newGenres);
//            var_dump($result);
            if(!empty($oldNewAuthors['insert']))
            {
                $result = $this->bookSql->addBookAuthor($putData['bookId'],$oldNewAuthors['insert']);
            } elseif(!empty($oldNewAuthors['delete']))
            {
                $result = $this->bookSql->deleteBookAuthor($putData['bookId'],$oldNewAuthors['delete']);
            } else {
                $result = $this->bookSql->updateBookAuthor($putData['bookId'],$oldNewAuthors['newArr'],$oldNewAuthors['oldArr']);
            }
//
            if($result !== 'error' && $result !== false)
            {
                if(!empty($oldNewGenres['insert']))
                {
                    $result = $this->bookSql->addBookGenre($putData['bookId'],$oldNewGenres['insert']);
                } elseif(!empty($oldNewGenres['delete']))
                {
                    $result = $this->bookSql->deleteBookGenre($putData['bookId'],$oldNewGenres['delete']);
                } else {
                    $result = $this->bookSql->updateBookGenres($putData['bookId'],$oldNewGenres['newArr'],$oldNewGenres['oldArr']);
                }
            } else
            {
                $result = 'error';
            }

            if($result !== 'error' && $result !== false)
            {
                $result = $this->bookSql->updateBook($putData['bookId'],$putData['name'],$putData['price'],$putData['description'],
                    $putData['discount']);
            } else
            {
                $result = 'error';
            }


            return $result;
//            var_dump($oldCount);
//            var_dump($newCount);
//                $insertAuthorArr = [];
//                $deleteAuthorArr = [];
//            if($oldCount > $newCount){
//                $diffArr =array_diff_key($oldAuthors, $newAuthors);
//                foreach($diffArr as $authorId=>$val)
//                {
//                    array_push($deleteAuthorArr, $authorId);
//
//                    //удаляем с базы данный элемент и при успехе удаляем с старого масива
//                    //затем делаем апдейт оставшихся записей
//                    unset($oldAuthors[$authorId]);
//                }
////                var_dump($diffArr);
//            } elseif($oldCount < $newCount)
//            {
//                $diffArr =array_diff_key($newAuthors,$oldAuthors);
//                foreach($diffArr as $authorId=>$val)
//                {
//                    array_push($insertAuthorArr, $authorId);
//                    //добавляем этот элемен и при упехе удаляем его с нового массива
//                    //делаем апдейт оставшиххся записей
//                    unset($newAuthors[$authorId]);
//                }
////                var_dump($diffArr);
//            }
//            var_dump($oldAuthors);
//            var_dump($insertAuthorArr);
//            var_dump($deleteAuthorArr);
//            var_dump($putData['oldGenres']);
//            foreach($putData['oldGenres'] as $val)
//            {
//                $x[] = $val;
//            }
//            var_dump($x);
//            $result = $this->bookSql->getBookGenreId('1',$putData['oldGenres']);
//            var_dump($result);
//            var_dump($oldCount,$newCount);
//            if($oldCount > $newCount)
//            {
//                $deletedKeys = array_rand($putData['oldGenres'],$oldCount-$newCount);
//                var_dump($deletedKeys);
//                echo 'нужно удалить какое-то количество с базы и сделать апдейт оставшихся';
//            }
//            if($oldCount < $newCount)
//            {
//                echo 'нужно апдейтнуть старые и добавить новые';
//            }
//            $result = $this->bookSql->updateBook($putData['id'],$putData['name'],$putData['price'],$putData['description'],
//                $putData['discount']);
        }

//        return $result;
    }

    private function genresAuthors($oldArr,$newArr)
    {
        $result = [];
        $insertArr = [];
        $deleteArr = [];
        $oldCount = count($oldArr);
        $newCount = count($newArr);
        if($oldCount > $newCount){
            $diffArr =array_diff_key($oldArr, $newArr);
            foreach($diffArr as $authorId=>$val)
            {
                array_push($deleteArr, $authorId);
                //удаляем с базы данный элемент и при успехе удаляем с старого масива
                //затем делаем апдейт оставшихся записей
//                unset($oldArr[$authorId]);
            }
//                var_dump($diffArr);
        } elseif($oldCount < $newCount)
        {
            $diffArr =array_diff_key($newArr,$oldArr);
            foreach($diffArr as $authorId=>$val)
            {
                array_push($insertArr, $authorId);
                //добавляем этот элемен и при упехе удаляем его с нового массива
                //делаем апдейт оставшиххся записей
//                unset($newArr[$authorId]);
            }
//                var_dump($diffArr);
        }
        $result['insert'] = $insertArr;
        $result['delete'] = $deleteArr;
        $result['oldArr'] = array_values($oldArr);
        $result['newArr'] = array_values($newArr);

        return $result;
    }
}
