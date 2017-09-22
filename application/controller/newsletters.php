<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 9/15/2017
 * Time: 4:35 PM
 */

class newsletters extends Controller
{
    public function index()
    {
        header('Location: ' . APP . 'home/index');
    }

    /**
     * PAGE: /newsletter/view/$newsletter_id
     * This method returns all of the users newsletters
     */
    public function view($user_id, $newsletter_id){
        if(isset($newsletter_id)){
            /* generating empty class with only some attribute for the SELECT query */
            $newsToGet = new Newsletter();
            $newsToGet->setId($newsletter_id);
            $userToGet = new User();
            $userToGet->setId($user_id);

            $user = $this->model->get($userToGet);
            $newsletter = $this->model->get($newsToGet);

            if(is_null($user) || is_null($newsletter))
                header('Location: ' . APP . 'home/index');

            require APP . 'view/_templates/header.php';
            require APP . 'view/newsletters/view.php';
            require APP . 'view/_templates/footer.php';
        }else{
            header('Location: ' . APP . 'home/index');
        }
    }

    public function preview($newsletter_id){
        if(isset($newsletter_id)){
            $newsToGet = new Newsletter();
            $newsToGet->setId($newsletter_id);

            $newsletter = $this->model->get($newsToGet);

            if(is_null($newsletter))
                header('Location: ' . APP . 'home/index');

            require APP . 'view/newsletters/preview.php';
        }else{
            header('Location: ' . APP . 'home/index');
        }
    }

    /**
     * PAGE : /newsletters/remove/$user_id/$newsletter_id
     * @param $user_id
     * @param $newsletter_id
     * We need the $user_id to redirect to the user page
     */
    public function remove($user_id, $newsletter_id){
        if(isset($newsletter_id)){
            $newsletterToRemove = new Newsletter();
            $newsletterToRemove->setId($newsletter_id);

            $query = $this->model->remove($newsletterToRemove);
            if($query){
                AlertManager::add(EASY_NEWSLETTER_REMOVED, AlertManager::INFO);
                header('Location: ' . URL . 'users/view/' . Helper::sanitize($user_id));
            }else{
                AlertManager::add($query, AlertManager::DANGER);
                header('Location: ' . URL . 'users/view/' . Helper::sanitize($user_id));
            }
        }else{
            header('Locaiton: ' . URL . 'home/');
        }
    }

    /**
     * PAGE: /newsletters/new/$user_id
     * @param $user_id
     * We show the new newsletter page for the selected user
     */
    public function new($user_id){
        if(isset($user_id)){
            $userToGet = new User();
            $userToGet->setId($user_id);
            $user = $this->model->get($userToGet);

            if(is_null($user))
                header('Location: ' . APP . 'home/index');

            require APP. 'view/_templates/header.php';
            require APP. 'view/newsletters/new.php';
            require APP. 'view/_templates/footer.php';
        }else{
            header('Location: ' . URL . 'home/');
        }
    }

    /**
     * PAGE: /newsletters/add/$user_id
     * @param $user_id
     * This will create a new newsletter for this $user_id
     */
    public function add($user_id){
        if(isset($user_id) && isset($_POST['easy_submit'])){
            /* Generating the newsletter to add */
            $newsletterToAdd = new Newsletter();
            $newsletterToAdd->setTitle(Helper::sanitize($_POST['easy_title']));
            $newsletterToAdd->setContent($_POST['easy_content']); /* we do not sanitize as it is pure HTML content */
            $newsletterToAdd->setFkUserId(Helper::sanitize($user_id));

            /* Uploading picture */
            if(isset($_FILES["easy_file"]["type"]))
            {
                /**
                 * For how to use this class.upload() class, check:
                 * https://github.com/verot/class.upload.php/blob/master/README.md
                 */
                require APP . '/model/Upload.php';
                $handle = new upload($_FILES['easy_file']);

                if($handle->uploaded){
                    $handle->image_resize = true;
                    $handle->image_x = 700;
                    $handle->image_ratio_y = true;
                    $handle->rewrite = true;
                    $handle->process(ROOT . '/public/img/');
                    if($handle->processed){
                        $newsletterToAdd->setBannerUrl(Helper::sanitize($_FILES["easy_file"]["name"]));
                        $handle->clean();
                    }else{
                        echo $handle->error;
                        $error = "Couldn't upload.";
                        AlertManager::add($error, AlertManager::DANGER);
                    }
                }
            }else{
                $error = "No file received.";
                AlertManager::add($error, AlertManager::DANGER);
            }

            /* adding newsletter to database */
            $query = $this->model->add($newsletterToAdd);

            /* Redirecting */
            if($query){
                AlertManager::add(EASY_NEWSLETTER_CREATED_CORRECTLY, AlertManager::SUCCESS);
                header('Location: ' . URL . 'users/view/' . Helper::sanitize($user_id));
            }else{
                AlertManager::add($query, AlertManager::DANGER);
                header('Location: ' . URL . 'users/view/' . Helper::sanitize($user_id));
            }

        }else{
            header('Location: ' . URL . 'home/');
        }
    }

    /**
     * PAGE: /newsletters/edit/$user_id/$newsletter_id
     * @param $user_id
     * @param $newsletter_id
     * We show the page for editing a newsletter
     */
    public function edit($user_id, $newsletter_id){
        if(isset($user_id) && isset($newsletter_id)){
            $userToGet = new User();
            $userToGet->setId($user_id);

            $newsToGet = new Newsletter();
            $newsToGet->setId($newsletter_id);

            $user = $this->model->get($userToGet);
            $newsletter = $this->model->get($newsToGet);

            if(is_null($user) || is_null($newsletter))
                header('Location: ' . APP . 'home/index');

            require APP . 'view/_templates/header.php';
            require APP . 'view/newsletters/edit.php';
            require APP . 'view/_templates/footer.php';
        }else{
                header('Location: ' . URL . 'home/');
        }
    }

    public function update ($user_id, $newsletter_id){
        if(isset($user_id) && isset($newsletter_id) && isset($_POST['easy_submit'])){
            /* We get the user and the newsletter */
            $userToGet = new User();
            $userToGet->setId($user_id);

            $newsToGet = new Newsletter();
            $newsToGet->setId($newsletter_id);

            $user = $this->model->get($userToGet);
            $newsletterToUpdate = $this->model->get($newsToGet);

            if(is_null($user) || is_null($newsletterToUpdate))
                header('Location: ' . APP . 'home/index');

            /* We now update the newsletter with the new information */
            $newsletterToUpdate->setTitle(Helper::sanitize($_POST['easy_title']));
            $newsletterToUpdate->setContent($_POST['easy_content']); /* we do not sanitize as it is pure HTML content */

            /* Upload picture if needed */
            if(isset($_FILES["easy_file"]["type"]))
            {
                /**
                 * For how to use this class.upload() class, check:
                 * https://github.com/verot/class.upload.php/blob/master/README.md
                 */
                require APP . '/model/Upload.php';
                $handle = new upload($_FILES['easy_file']);

                if($handle->uploaded){
                    $handle->image_resize = true;
                    $handle->image_x = 700;
                    $handle->image_ratio_y = true;
                    $handle->file_overwrite = true;
                    $handle->process(ROOT . '/public/img/');
                    if($handle->processed){
                        $newsletterToUpdate->setBannerUrl(Helper::sanitize($_FILES["easy_file"]["name"]));
                        $handle->clean();
                    }else{
                        $error = $handle->error;
                        AlertManager::add($error, AlertManager::DANGER);
                    }
                }
            }

            /* Updating the database with our new newsletter class */
            $query = $this->model->update($newsletterToUpdate);

            /* Redirecting */
            if($query){
                AlertManager::add(EASY_NEWSLETTER_UPDATED_CORRECTLY, AlertManager::SUCCESS);
                header('Location: ' . URL . 'users/view/' . Helper::sanitize($user_id));
            }else{
                AlertManager::add($query, AlertManager::DANGER);
                header('Location: ' . URL . 'users/view/' . Helper::sanitize($user_id));
            }
        }else{
            header('Location: ' . URL . 'home/');
        }
    }
}