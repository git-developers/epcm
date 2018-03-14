<?php

require_once APP_PATH . "/../application/Model.php";
require_once APP_PATH . "/../entity/OrderDetail.php";

class OrderDetailModel extends Model
{

    const TABLE_NAME = 'pedido_detalle';

    public function findAllById($id)
    {
        $out = [];
        $sql = 'SELECT * FROM '. self::TABLE_NAME .' WHERE pedido="' . $id . '" ORDER BY id DESC';

        $result = mysqli_query($this->_db, $sql);

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {
                $object = new OrderDetail;
                $object->setId($row["id"]);
                $object->setProducto($row["producto"]);
                $object->setPedido($row["pedido"]);
                $object->setCantidad($row["cantidad"]);

                $out[] = $object;
            }
        }

        mysqli_close($this->_db);

        return $out;
    }

    public function create($orderId, \stdClass $data)
    {
        $result = [];

        $products = $data->product;
        $quantity = array_filter($data->product->quantity);
        $quantity = array_values($quantity);

        foreach ($products->id as $key => $productId){

            if(is_null($productId)){
                continue;
            }

            $sql = 'INSERT INTO '. self::TABLE_NAME .' 
                (pedido, producto, cantidad) 
                VALUES 
                ("'. $orderId .'", "'. $productId.'", "'. $quantity[$key] .'")';

            $result[] = mysqli_query($this->_db, $sql);
        }

        mysqli_close($this->_db);

        return true;
    }

    public function edit($orderId, \stdClass $data)
    {
        $this->delete($orderId);

        $this->create($orderId, $data);
    }

    public function delete($orderId)
    {
        $sql = 'DELETE FROM '. self::TABLE_NAME .' 
                WHERE 
                pedido="'. $orderId .'" ';

        $result = mysqli_query($this->_db, $sql);

//        mysqli_close($this->_db);

        return $result;
    }


}