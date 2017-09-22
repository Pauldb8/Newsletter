<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Newsletter system</h1>
            <p>List of all users</p>
            <?php echo AlertManager::show(); ?>
            <table class="table table-hovered">
                <thead>
                    <tr>
                    <?php
                    $header = new User();
                    foreach(($header->getAttributes()) as $key => $values){
                    ?>

                        <?php if($key != "password") { ?>
                        <td><?php echo Helper::sanitize($key); ?></td>
                        <?php } ?>

                    <?php
                    }
                    ?>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($users as $user){
                    ?>
                    <tr>
                        <td><?php echo Helper::sanitize($user->id); ?></td>
                        <td>
                            <a href="<?php echo URL . 'users/view/' . Helper::sanitize($user->id); ?>">
                                <?php echo Helper::sanitize($user->name); ?>
                            </a>
                        </td>
                        <td><?php echo Helper::sanitize($user->login); ?></td>
                        <td>
                            <a href="<?php echo URL . 'users/edit/' . Helper::sanitize($user->id); ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="<?php echo URL . 'users/remove/' . Helper::sanitize($user->id); ?>"
                                class="text-danger confirm">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
            <br />
            <br />
            <a href="<?php echo URL . 'users/add'; ?>"
               title="Create a new user"
               class="btn btn-black">NEW USER</a>
        </div>
    </div>
</div>
