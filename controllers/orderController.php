<?php

require_once APP_PATH . "/../application/Controller.php";
require_once APP_PATH . "/../models/OrderModel.php";
require_once APP_PATH . "/../models/OrderDetailModel.php";
require_once APP_PATH . "/../models/ProductCatalogModel.php";
require_once APP_PATH . "/../entity/Order.php";
require_once APP_PATH . "/../entity/OrderDetail.php";

class orderController extends Controller
{

    public function __construct() {
        parent::__construct();

        $this->_view->setJs(['jquery.min']);
        $this->_view->setCss(['main']);
    }

    public function index()
    {
        $model = new OrderModel();
        $this->_view->objects = $model->findAll();

        $this->_view->render("index");
    }

    public function create()
    {

        if($_POST){

            $data = json_decode(json_encode($_POST));

            $object = new Order;
            $object->setFechaPedido($data->fechaPedido);
            $object->setUsuario($data->usuario);

            $model = new OrderModel();
            $id = $model->create($object);

            $model = new OrderDetailModel();
            echo $model->create($id, $data);

            return;
        }

        $model = new ProductCatalogModel();
        $this->_view->objects = $model->findAll();

        $this->_view->render("create");
    }

    public function edit()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if($_POST){

            $data = json_decode(json_encode($_POST));

            $object = new Order;
            $object->setId($_POST["id"]);
            $object->setFechaPedido($data->fechaPedido);
            $object->setUsuario($data->usuario);

            $model = new OrderModel();
            $model->edit($object);

            $model = new OrderDetailModel();
            echo $model->edit($_POST["id"], $data);

            return;
        }

        $model = new OrderModel();
        $this->_view->object = $model->findOneById($id);

        if(empty($this->_view->object)){
            $this->redirect('index.php?url=order');
        }

        $model = new OrderDetailModel();
        $this->_view->detail = $model->findAllById($id);

        $model = new ProductCatalogModel();
        $this->_view->objects = $model->findAll();

        $this->_view->render("edit");
    }

    public function delete()
    {
        if($_POST){
            $object = new Order;
            $object->setId($_POST["id"]);

            $model = new OrderModel();
            echo $model->delete($object);
            return;
        }

        return false;
    }
}