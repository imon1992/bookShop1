<?php

class Genres
{

    protected $genreSql;

    public function __construct()
    {
        $this->genreSql = new GenreSql();
    }

    public function getGenre($params = false)
    {
        if($params == false)
        {
            $result = $this->genreSql->getAllGenres();
        }
        return $result;
    }

    public function postGenre($params)
    {
        if($params == false )
        {
            $name = json_decode($_POST['name']);
            $result = $this->genreSql->addGenre($name);
        }
        return $result;
    }

    public function putGenre($params)
    {
        if($params == false )
        {
            $putStr = file_get_contents('php://input');
            $generatePutData = new GenerateData();
            $putData = $generatePutData->generatePutData($putStr);

            $result = $this->genreSql->updateGenre($putData['id'],$putData['name']);
        }

        return $result;
    }

    public function deleteGenre($id = false)
    {
        if($id != false)
        {
            $result = $this->genreSql->deleteBookGenre($id);
            if($result !== 'error' && $result !== false)
            {
                $result = $this->genreSql->deleteGenre($id);
            } else {
                $result = 'error';
            }
        }
        return $result;
    }
}
