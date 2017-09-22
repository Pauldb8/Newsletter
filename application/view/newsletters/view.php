<div class="container px-0">
    <div class="row">
        <div class="col-md-12">
            <h1>Newsletter "<strong><?php echo Helper::sanitize($newsletter->getTitle()); ?></strong>"</h1>
            <p>Created by
                <strong>
                    <a href="<?php echo URL . 'users/view/' . Helper::sanitize($user->getId()); ?>">
                        <?php echo Helper::sanitize($user->getName()); ?>
                    </a>
                </strong>
                on
                <?php echo Helper::sanitize($newsletter->getDate()); ?><br /><br />
                <a href="<?php echo URL . 'newsletters/edit/' . Helper::sanitize($user->getId()) . '/'
                    . Helper::sanitize($newsletter->getId()); ?>" class="btn btn-black">Edit</a>
            </p>
            <table class="newsletter">
                <tr>
                    <td>
                        <?php
                        if(file_exists(ROOT . 'public/img/' . $newsletter->getBannerUrl())){
                        ?>
                        <img src="<?php echo URL . 'img/' . Helper::sanitize($newsletter->getBannerUrl()); ?>" alt="NOT FOUND" />
                        <?php
                        }else{
                        ?>
                        <img src="http://via.placeholder.com/700x250" alt="NOT FOUND" />
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if(!empty($newsletter->getContent())){
                        ?><br />
                        <?php echo $newsletter->getContent(); ?>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-12">
            <p>
                <br />
                <br />
                <br />
                <a href="<?php echo URL . "users/view/" . $user->getId(); ?>" class="btn btn-black">Go back</a>
            </p>
        </div>
    </div>
</div>
