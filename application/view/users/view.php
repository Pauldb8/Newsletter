<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Newsletter for <?php echo Helper::sanitize($user->getName()); ?></h1>
            <p>List of all newsletters</p>
            <a href="<?php echo URL . "newsletters/new/" . Helper::sanitize($user->getId()); ?>"
               class="btn btn-black">
                NEW
            </a>
            <?php echo AlertManager::show(); ?>
            <table class="table table-hovered">
                <thead>
                <tr>
                    <td>id</td>
                    <td>title</td>
                    <td>date</td>
                    <td>url</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                <?php
                if(count($newsletters) > 0){
                    foreach($newsletters as $newsletter){
                        ?>
                        <tr>
                            <td><?php echo Helper::sanitize($newsletter->getId()); ?></td>
                            <td>
                                <a href="<?php echo URL . "newsletters/view/" . Helper::sanitize($user->getId()) . "/"
                                    . Helper::sanitize($newsletter->getId()); ?>">
                                    <?php echo Helper::sanitize($newsletter->getTitle()); ?>
                                </a>
                            </td>
                            <td><?php echo Helper::sanitize($newsletter->getDate()); ?></td>
                            <td><a  href="<?php echo URL . "newsletters/preview/" . Helper::sanitize($newsletter->getId()); ?>"
                                    target="_blank">
                                    <?php echo URL . "newsletters/preview/" . Helper::sanitize($newsletter->getId()); ?>
                                </a></td>
                            <td>
                                <a href="<?php echo URL . 'newsletters/edit/' . Helper::sanitize($user->getId()) . '/'
                                    . Helper::sanitize($newsletter->getId()); ?>"
                                   class="text-primary">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="<?php echo URL . 'newsletters/remove/' . Helper::sanitize($user->getId()) . '/'
                                    . Helper::sanitize($newsletter->getId()); ?>"
                                   class="text-danger confirm">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                ?>
                    <tr>
                        <td colspan="100" class="text-center"><em>No news found.</em></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <p>
                <br />
                <br />
                <br />
                <a href="<?php echo URL . "home"; ?>"
                   class="btn btn-black">
                    Go back
                </a>
            </p>
        </div>
    </div>
</div>
