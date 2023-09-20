`<?php

$dir = __DIR__; ///Library/WebServer/Documents/php47/controllers/
$dir = substr($dir, 0, strpos($dir, 'controllers'));///Library/WebServer/Documents/php47/
require_once $dir . 'controllers/Controller.php'; //tương đối -> tuyệt đối
require_once $dir . 'models/ProductDal.php';

class ProductController extends Controller
{
    //home
    public function list()
    {
        $productDal = new ProductDal();
        $list = $productDal->getAll();
        $this->view('fe/product/list',['list'=>$list,'title'=>'Danh sách sản phẩm']);
    }

}


