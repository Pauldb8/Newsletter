<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 9/22/2017
 * Time: 1:48 PM
 */

class about extends Controller
{

    /**
     * PAGE: /about/index
     */
    public function index(){
        require APP . 'view/_templates/header.php';
        require APP . 'view/about/index.php';
        require APP . 'view/_templates/footer.php';
    }
}