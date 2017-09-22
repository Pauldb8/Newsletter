<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $users = $this->model->getAll(new User());
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * Viewing newsletter for this user, if id is defined
     */
    public function newsletter($user_id)
    {
//        if(isset($user_id)) {
//            /* load newsletters from this user */
//            $newsToGet = new Newsletter();
//            $newsToGet.setFkUserId()
//            $newsletters = $this->model->get()
//            // load views
//            require APP . 'view/_templates/header.php';
//            require APP . 'view/home/newsletter.php';
//            require APP . 'view/_templates/footer.php';
//        }else{
//            header('Location: ' . URL . 'home/index');
//        }
    }
}
