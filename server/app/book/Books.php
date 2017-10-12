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
        if($params == false )
        {
            $name = json_decode($_POST['name']);
            $price = json_decode($_POST['price']);
            $description = json_decode($_POST['description']);
            $discount = json_decode($_POST['discount']);
            $result = $this->bookSql->addBook($name,$price,$description,$discount);
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

            $result = $this->bookSql->updateBook($putData['id'],$putData['name'],$putData['price'],$putData['description'],
                $putData['discount']);
        }

        return $result;
    }
}
