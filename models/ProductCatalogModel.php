<?php

require_once APP_PATH . "/../application/Model.php";
require_once APP_PATH . "/../entity/ProductCatalog.php";

class ProductCatalogModel extends Model
{

    const TABLE_NAME = 'producto_catologo';

    public function findOneById($id)
    {
        $object = null;
        $sql = 'SELECT * FROM '. self::TABLE_NAME .' WHERE id = "' . $id . '"';

        $result = mysqli_query($this->_db, $sql);

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {
                $object = new ProductCatalog;
                $object->setId($row["id"]);
                $object->setDescripcion($row["descripcion"]);
                $object->setMarca($row["marca"]);
                $object->setTipo($row["tipo"]);
            }
        }

        mysqli_close($this->_db);

        return $object;
    }

    public function findAll()
    {
        $out = [];
        $sql = 'SELECT * FROM '. self::TABLE_NAME .' ORDER BY id DESC';

        $result = mysqli_query($this->_db, $sql);

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {
                $object = new ProductCatalog;
                $object->setId($row["id"]);
                $object->setDescripcion($row["descripcion"]);
                $object->setMarca($row["marca"]);
                $object->setTipo($row["tipo"]);

                $out[] = $object;
            }
        }

        mysqli_close($this->_db);

        return $out;
    }

}