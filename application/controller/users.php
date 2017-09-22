<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 9/18/2017
 * Time: 3:55 PM
 */

class users extends Controller
{
    public function index(){
        header('Location: ' . APP . 'home/index');
    }

    /**
     * PAGE: /user/view/$user_id
     * This method returns all of the users newsletters
     */
    public function view($user_id){
        if(isset($user_id)){
            /* generating empty class with only some attribute for the SELECT query */
            $newsToGet = new Newsletter();
            $newsToGet->setFkUserId($user_id);
            $userToGet = new User();
            $userToGet->setId($user_id);

            $user = $this->model->get($userToGet)[0];
            $newsletters = $this->model->get($newsToGet);

            if(is_null($user) || is_null($newsletters))
                header('Location: ' . APP . 'home/index');

            require APP . 'view/_templates/header.php';
            require APP . 'view/users/view.php';
            require APP . 'view/_templates/footer.php';
        }else{
            header('Location: ' . APP . 'home/index');
        }
    }

    /**
     * PAGE: /users/add
     * This method show/add new user
     */
    public function add(){
            require APP . 'view/_templates/header.php';
            require APP . 'view/users/new.php';
            require APP . 'view/_templates/footer.php';
    }

    /**
     * PAGE: /users/edit
     * This method show the edit user
     */
    public function edit($user_id){
        if(isset($user_id)) {
            $userToGet = new User();
            $userToGet->setId($user_id);

            $user = $this->model->get($userToGet)[0];

            require APP . 'view/_templates/header.php';
            require APP . 'view/users/edit.php';
            require APP . 'view/_templates/footer.php';
        }else{
            header('Location: ' . URL . 'home/');
        }
    }

    /**
     * This method adds a new user to the DB from the $_POST[] info
     */
    public function addUser(){
        if(isset($_POST['easy_submit'])){
            $user_name = $_POST['easy_name'];
            $user_login = $_POST['easy_login'];
            $user_password = $_POST['easy_password'];

            $new_user = new User();
            $new_user->setName($user_name);
            $new_user->setLogin($user_login);
            $new_user->setPassword($user_password);

            $query = $this->model->add($new_user);
            if($query){
                AlertManager::add(EASY_NEW_USER_ADDED, AlertManager::SUCCESS);
                header('Location: ' . URL . 'home/');
            }else{
                AlertManager::add($query, AlertManager::DANGER);
                header('Location: ' . URL . 'home/');
            }
        }else{
            header('Location: ' . URL . 'home/');
        }
    }

    public function update($user_id){
        if(isset($user_id) && isset($_POST['easy_submit'])){
            /* Getting user first */
            $userToGet = new User();
            $userToGet->setId($user_id);
            $user = $this->model->get($userToGet)[0];

            /* Updating user with new information */
            $user->setName(Helper::sanitize($_POST['easy_name']));
            $user->setLogin(Helper::sanitize($_POST['easy_login']));
            $user->setPassword(Helper::sanitize($_POST['easy_password']));

            $query = $this->model->update($user);
            if($query){
                AlertManager::add(EASY_USER_CORRECTLY_UPDATED, AlertManager::SUCCESS);
                header('Location: ' . URL . 'home/');
            }else{
                AlertManager::add($query, AlertManager::DANGER);
                header('Location: ' . URL . 'home/');
            }

        }else{
            header('Location: ' . URL . 'home/');
        }
    }

    public function remove($user_id){
        if(isset($user_id)){
            $userToRemove = new User();
            $userToRemove->setId($user_id);

            $query = $this->model->remove($userToRemove);

            if($query === true){
                AlertManager::add(EASY_USER_REMOVED, AlertManager::INFO);
                header('Location: ' . URL . 'home/');
            }else{
                AlertManager::add(PDO_ERRORS[$query], AlertManager::DANGER);
                header('Location: ' . URL . 'home/');
            }
        }else{
            header('Location: ' . URL . 'home/');
        }
    }
}