<?php

class Bags
{

    protected $bagSql;

    public function __construct()
    {
        $this->bagSql = new BagSql();
    }

    public function postBag($params)
    {
        if($params == false)
        {
            $bookId = json_decode($_POST['bookId']);
            $clientId = json_decode($_POST['clientId']);
            $count = json_decode($_POST['count']);
            $result = $this->bagSql->addToBag($bookId,$clientId,$count);
        }
        return $result;
    }

    public function deleteBag($params)
    {
        if($params == false)
        {
            $putStr = file_get_contents('php://input');
            $generatePutData = new GenerateData();
            $putData = $generatePutData->generatePutData($putStr);
            
            $count = count($putData);
            if($count == 2)
            {
                $result = $this->bagSql->deleteFromBag($putData['userId'],$putData['deleteArr']);
            }

            return $result;
        }
    }

    public function putBag($params)
    {
        if($params == false)
        {
            $putStr = file_get_contents('php://input');
            $generatePutData = new GenerateData();
            $putData = $generatePutData->generatePutData($putStr);
            $result = $this->bagSql->updateUserBag($putData['bookId'],$putData['userId'],$putData['count']);

        }
        return $result;

    }

    public function getBag($params)
    {
        if($params != false)
        {
            $result = $this->bagSql->getUserBag($params);
        }
        return $result;
    }

    public function deleteAuth()
    {
        $result = session_destroy();
        return $result;
    }


}

//$c = new Auth();
//$x = $c->getAuth();