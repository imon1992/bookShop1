<?php

class Orders
{

    protected $orderSql;

    public function __construct()
    {
        $this->orderSql = new OrderSql();
    }

    public function postOrder($params)
    {
        if($params == false)
        {
            $userId = json_decode($_POST['userId']);
            $paymentSystemId = json_decode($_POST['paymentId']);
            $totalPrice = json_decode($_POST['totalPrice']);
            //return $userId;

            $bagSql = new BagSql();
            $userBag = $bagSql->getUserBag($userId);

            $clientDiscount = $userBag[0]['clientDiscount'];
           // var_dump($clientDiscount);
            $statusId = 1;
            date_default_timezone_set('Europe/Kiev');
            $dateCreate = date('Y-m-d-G-i-s');

            foreach($userBag as $key=>$val)
            {
                    unset($userBag[$key]['clientDiscount']);
                    unset($userBag[$key]['name']);
                    unset($userBag[$key]['posNumber']);
            }
            $result = $this->orderSql->addOrder($paymentSystemId,$statusId,$dateCreate,$totalPrice,$clientDiscount,$userId);

            if($result !== 'error' && $result !== false)
            {
                $result = $this->orderSql->addOrderPart($userId,$userBag,$result);
                if($result !== 'error' && $result !== false)
                {
                    $bagSql->clearUserDag($userId);
                }
            }
        }

        return $result;

    }

    public function getOrder($params = false)
    {
        $params = explode('/',$params);
//        var_dump($params);
        $countParams = count($params);
        if($params == false)
        {
            $result = $this->orderSql->getPaymentSystems();
        } else
        {
            if($countParams == 1)
            {
                $result = $this->orderSql->getOrdersInfoForUser($params[0]);
            } elseif ($countParams == 2)
            {
                $result = $this->orderSql->getAdditionalOrdersInfoForUser($params[0],$params[1]);
            }
        }

        return $result;
    }


}
