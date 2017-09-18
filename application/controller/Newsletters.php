<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 9/15/2017
 * Time: 4:35 PM
 */

class Newsletters extends Controller
{
    public function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/newsletters/index.php';
        require APP . 'view/_templates/footer.php';
    }
}