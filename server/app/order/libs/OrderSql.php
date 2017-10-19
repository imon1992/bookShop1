<?php
//include('../../config.php');

class OrderSql
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

   public function addOrder($paymentId,$statusId,$dateCreate,$totalPrice,$userDisc)
   {
       if($this->dbConnect !== 'connect error')
       {
           $stmt =$this->dbConnect->prepare('
                INSERT INTO userOrder(payment_id,status_id,createDate,totalPrice,userDiscount)
                VALUES(:payment,:status,:createDate,:totalPrice,:userDiscount)
                ');

               $stmt->bindParam(':payment',$paymentId);
               $stmt->bindParam(':status',$statusId);
               $stmt->bindParam(':createDate',$dateCreate);
               $stmt->bindParam(':totalPrice',$totalPrice);
               $stmt->bindParam(':userDiscount',$userDisc);
               $result = $stmt->execute();
           $result = $this->dbConnect->lastInsertId();
       }else
       {
           $result = 'error';
       }

       return $result;
   }

    public function addOrderPart($userId,$params,$orderId)
    {
//        var_dump($params);
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('
                INSERT INTO orderPart(book_id,user_id,count,bookPrice,bookDiscount,order_id)
                VALUES(:bookId,:userId,:count,:bookPrice,:bookDiscount,:orderId)
                ');
            foreach($params as &$orderParam)
            {
                $stmt->bindParam(':bookId',$orderParam['id']);
                $stmt->bindParam(':userId',$userId);
                $stmt->bindParam(':count',$orderParam['count']);
                $stmt->bindParam(':bookPrice',$orderParam['price']);
                $stmt->bindParam(':bookDiscount',$orderParam['bookDiscount']);
                $stmt->bindParam(':orderId',$orderId);
                $result = $stmt->execute();
            }
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function getOrdersInfoForUser($userId)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('
            SELECT uo.id,uo.createDate,uo.totalPrice,s.name
            FROM userOrder as uo
            INNER JOIN StatusOrder as s on s.id = uo.payment_id
            WHERE uo.user_id = :userId
            ');
            $stmt->bindParam(':userId',$userId);
            $stmt->execute();

            while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $result[] = $assocRow;
            }
        }else
        {
            $result = 'error';
        }

        return $result;
    }

    public function getAdditionalOrdersInfoForUser($userId,$orderId)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('
            SELECT op.count,op.bookPrice,op.bookDiscount,b.name
            FROM orderPart as op
            INNER JOIN Book as b on b.id = op.book_id
            WHERE op.user_id = :userId AND op.order_id = :orderId
            ');
            $stmt->bindParam(':userId',$userId);
            $stmt->bindParam(':orderId',$orderId);
            $stmt->execute();

            while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $result[] = $assocRow;
            }
        }else
        {
            $result = 'error';
        }

        return $result;
    }
}