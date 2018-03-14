<?php

require_once APP_PATH . "/../application/Model.php";
require_once APP_PATH . "/../entity/Order.php";

class OrderModel extends Model
{

    const TABLE_NAME = 'pedido';
    const TABLE_DETAIL = 'pedido_detalle';

    public function findOneById($id)
    {
        $out = null;
        $sql = 'SELECT 
                t1.*
                FROM '. self::TABLE_NAME .' AS t1
                WHERE t1.id = "' . $id . '"
                ';

        $result = mysqli_query($this->_db, $sql);

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {
                $object = new Order;
                $object->setId($row["id"]);
                $object->setFechaPedido($row["fecha_pedido"]);
                $object->setUsuario($row["usuario"]);

                $out = $object;
            }
        }

        mysqli_close($this->_db);

        return $out;
    }

    public function findAll()
    {
        $out = [];
        $sql = 'SELECT * FROM '. self::TABLE_NAME .' ORDER BY id DESC';

        $result = mysqli_query($this->_db, $sql);

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {
                $object = new Order;
                $object->setId($row["id"]);
                $object->setFechaPedido($row["fecha_pedido"]);
                $object->setUsuario($row["usuario"]);

                $out[] = $object;
            }
        }

        mysqli_close($this->_db);

        return $out;
    }

    public function create(Order $order)
    {
        $sql = 'INSERT INTO '. self::TABLE_NAME .' 
                (fecha_pedido, usuario) 
                VALUES 
                ("'. $order->getFechaPedido().'", "'. $order->getUsuario().'")';

        mysqli_query($this->_db, $sql);

        $lastId = $this->_db->insert_id;

        mysqli_close($this->_db);

        return $lastId;
    }

    public function edit(Order $order)
    {
        $sql = 'UPDATE '. self::TABLE_NAME .' 
                SET fecha_pedido="'. $order->getFechaPedido().'", 
                    usuario="'. $order->getUsuario().'"
                 WHERE id="'. $order->getId().'"';

        mysqli_query($this->_db, $sql);

        $lastId = $this->_db->insert_id;

        mysqli_close($this->_db);

        return $lastId;
    }

    public function delete(Order $order)
    {
        $sql = 'DELETE FROM '. self::TABLE_NAME .' WHERE id = "' . $order->getId() . '"';

        $result = mysqli_query($this->_db, $sql);

        mysqli_close($this->_db);

        return $result;
    }

}