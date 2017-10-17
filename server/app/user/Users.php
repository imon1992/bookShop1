<?php

class Users
{
    protected $authSql;

    public function __construct()
    {
        $this->userSql = new UserSql();
    }



    public function getUser($params)
    {
        if($params == false)
        {
            $result = $this->userSql->getUsers();
        }else
        {
            $result = false;
        }
        return $result;
    }

    public function putUser($params)
    {
        if($params == false)
        {
            $putStr = file_get_contents('php://input');
            $generatePutData = new GenerateData();
            $putData = $generatePutData->generatePutData($putStr);

            if($putData['password'] != null)
            {
                $putData['password'] = md5(md5($putData['password']));
            }

            $result = $this->userSql->updateUser($putData);
        }

        return $result;
    }
}
