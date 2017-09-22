<div class="container px-0">
    <form action="<?php echo URL . "newsletters/add/" . Helper::sanitize($user->getId()); ?>"
          method="post"
          id="uploadimage"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <h1>New newsletter</h1>
                <p>
                    For user
                    <strong>
                        <a href="<?php echo URL . 'users/view/' . Helper::sanitize($user->getId()); ?>">
                            <?php echo Helper::sanitize($user->getName()); ?>
                        </a>
                    </strong>
                </p>
                <table class="newsletter">
                    <tr>
                        <td>
                            <div class="form-group row mx-0 my-0">
                                <label for="easy_title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10 pr-0">
                                    <input type="text" class="form-control" name="easy_title" id="easy_title" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group row mx-0 my-0">
                                <label for="easy_file" class="col-sm-2 col-form-label"><?php echo EASY_NEWSLETTER_UPLOAD_FILE; ?></label>
                                <div class="col-sm-10 pr-0">
                                    <input type="file" name="easy_file" id="easy_file" class="form-control" required />
                                </div>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td id="image_preview">
                            <img id="previewing"
                                src="http://via.placeholder.com/700x250"
                                alt="NOT FOUND" />
                        </td>
                    </tr>
                    <tr>
                        <td id="loading">
                            Loading...
                        </td>
                    </tr>
                    <tr>
                        <td id="message">

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="easy_content"></textarea>
                        </td>

                    </tr>
                </table>
            </div>
            <div class="col-md-4">
                <p>
                    <br />
                    <br />
                    <a href="<?php echo URL . "users/view/" . Helper::sanitize($user->getId()); ?>"
                       class="btn btn-black">
                        GO BACK
                    </a>
                </p>
            </div>
            <div class="col-md-4">
                <p class="text-center">
                    <br />
                    <br />
                    <button type="submit" class="btn btn-black" name="easy_submit">CREATE</button>
                </p>
            </div>
        </div>
    </form>
</div>