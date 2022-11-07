<?php
namespace App\Controllers;


class TestController extends Controller
{
    public function index()
    {
        $this->render('test/index');
    }

    public function test()
    {
        $test="Bonjour je suis un test devant classe";
        $this->render('test/test',compact('test'));
    }
}