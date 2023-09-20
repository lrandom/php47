<?php

$dir = __DIR__; ///Library/WebServer/Documents/php47/controllers/
require_once $dir . '/Controller.php'; //tương đối -> tuyệt đối

class HomeController extends Controller
{
    //home
    public function index()
    {
        echo "Home Controller";
    }


    //about
    public function about()
    {
        $this->view('fe/about');
    }

    public function contact()
    {
        echo "Contact Controller";
    }
}
