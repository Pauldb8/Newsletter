<div class="container px-0">
    <div class="row">
        <div class="col-md-12">
            <h1>Newsletter system</h1>
            <p>List of all users</p>
            <?php echo AlertManager::show(); ?>
            <table class="table table-hover">
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
                        <td><?php echo Helper::sanitize($user->getId()); ?></td>
                        <td>
                            <a href="<?php echo URL . 'users/view/' . Helper::sanitize($user->getId()); ?>">
                                <?php echo Helper::sanitize($user->getName()); ?>
                            </a>
                        </td>
                        <td><?php echo Helper::sanitize($user->getLogin()); ?></td>
                        <td>
                            <a href="<?php echo URL . 'users/edit/' . Helper::sanitize($user->getId()); ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="<?php echo URL . 'users/remove/' . Helper::sanitize($user->getId()); ?>"
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
<a href="https://seal.beyondsecurity.com/vulnerability-scanner-verification/newsletter.onetec.eu"><img src="https://seal.beyondsecurity.com/verification-images/newsletter.onetec.eu/vulnerability-scanner-2.gif" alt="Website Security Test" border="0" /></a>