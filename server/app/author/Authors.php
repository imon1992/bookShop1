<?php

class Authors
{

    protected $authorSql;

    public function __construct()
    {
        $this->authorSql = new AuthorSql();
    }

    public function getAuthor($params = false)
    {
        if($params == false)
        {
            $result = $this->authorSql->getAllAuthors();
        }
        return $result;
    }

    public function postAuthor($params)
    {
        if($params == false )
        {
            $name = json_decode($_POST['name']);
            $surname = json_decode($_POST['surname']);
            $result = $this->authorSql->addAuthor($name,$surname);
        }
        return $result;
    }

    public function putAuthor($params)
    {
        if($params == false )
        {
            $putStr = file_get_contents('php://input');
            $generatePutData = new GenerateData();
            $putData = $generatePutData->generatePutData($putStr);

            $result = $this->authorSql->updateAuthor($putData['id'],$putData['name'],$putData['surname']);
        }

        return $result;
    }

    public function deleteAuthor($id = false)
    {
        if($id != false)
        {
            $result = $this->authorSql->deleteBookAuthor($id);
            if($result !== 'error' && $result !== false)
            {
                $result = $this->authorSql->deleteAuthor($id);
            } else {
                $result = 'error';
            }
        }
        return $result;
    }
}
