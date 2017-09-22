<div class="container px-0">
    <div class="row">
        <div class="col-md-12">
            <h1>Add a new user</h1>
            <p>
                Enter the information of the new user<br />
                <br />
            </p>
            <form class="form-inline" action="<?php echo URL . 'users/addUser/'; ?>" method="post">
                <div class="form-group">
                    <label for="easy_name" class="sr-only">Name</label>
                    <input type="text" class="form-control" id="easy_name" name="easy_name" placeholder="Name">
                </div>
                <div class="form-group mx-sm-3">
                    <label for="easy_login" class="sr-only">Login</label>
                    <input type="text" class="form-control" id="easy_login" name="easy_login" placeholder="Login">
                </div>
                <div class="form-group mx-sm-3">
                    <label for="easy_password" class="sr-only">Login</label>
                    <input type="password" class="form-control" id="easy_password" name="easy_password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-black" name="easy_submit">ADD NEW USER</button>
            </form>
        </div>
        <div class="col-md-12">
            <p>
                <br />
                <br />
                <br />
                <a href="<?php echo URL . "home"; ?>" class="btn btn-black">Go back</a>
            </p>
        </div>
    </div>
</div>
