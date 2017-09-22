<div class="container px-0">
    <div class="row">
        <div class="col-md-12">
            <h1 class="bold">EASYCAKE</h1>
            <h1>About this framework</h1>
            <p class="text-justify">
                THIS IS REAL, THE EASYCAKE MVC HAS BEEN DONE.<br />
                IT IS READY FOR REALY LIFE OUT THERE.<br />
                IT IS WORKING, SAFE, SECURE, SIMPLE AND SEXY.<br />
                USE IT WITH CAUTION, DO NOT DIVISE BY 0.<br />
                <br />
                This barebone framework is based on <a href="https://github.com/panique/mini">MINI</a> and is
                <strong>MVC</strong> structured.<br />
                It is meant to simplify a developers' job when creating a website and not have to reinvent
                the wheel everytime.<br />
                It supports a few features out-of-the-box:<br />
                <ul>
                    <li>extremely simple, easy to understand</li>
                    <li>simple but clean structure</li>
                    <li>makes "beautiful" clean URLs</li>
                    <li>demo CRUD actions: Create, Read, Update and Delete database entries easily</li>
                    <li>demo AJAX call</li>
                    <li>tries to follow PSR 1/2 coding guidelines</li>
                    <li>uses PDO for any database requests, comes with an additional PDO debug tool to emulate your SQL
                        statements</li>
                    <li>commented code</li>
                    <li>uses only native PHP code, so people don't have to learn a framework</li>
                </ul>
            Some features have been added by Paul R. De Buck with much generosity.
            </p>
            <h1>Goodies</h1>
            <p class="text-jsutify">
                <strong>Variables Sanitizer</strong><br />
                Added by Paul this MVC comes with an easy variables sanitizer for showing in HTML from PHP.<br />
                It will escape any variables from the user to be shown in PHP without risks.<br />
                Use it this way:
            </p>
            <pre>
    echo Helper::sanitize($varToSanitize);
            </pre>
            <p class="text-justify">
                <strong>PDO Debugger</strong><br />
                MINI comes with a little customized PDO debugger tool (find the code in application/libs/helper.php),
                trying to emulate your PDO-SQL statements.
                <br />It's extremely easy to use:
            </p>
            <pre>
    $sql = "SELECT id, artist, track, link FROM song WHERE id = :song_id LIMIT 1";
    $query = $this->db->prepare($sql);
    $parameters = array(':song_id' => $song_id);

    echo Helper::debugPDO($sql, $parameters);

    $query->execute($parameters);
            </pre>
            <p class="text-justify">
                <strong>Alert Manager</strong><br />
                Added by Paul this MVC comes with a tool to show 'alerts' with predefined color background very simply across pages.<br />
                Here is how to create an alert to display to the user:
            </p>
            <pre>
    AlertManager::add("New user correctly created", AlertManager::SUCCESS);
            </pre>
            <p class="text-justify">
                You can choose between: <code>PRIMARY, SECONDARY, SUCCESS, DANGER, WARNING, INFO.</code>
                And on the next page here is how to show the alert:<br />
            </p>
            <pre>
    echo AlertManager::show();
            </pre>
            <p class="text-justify">
                Which will show this:
            </p>
            <?php AlertManager::add("New user correctly created", AlertManager::SUCCESS); ?>
            <?php echo AlertManager::show(); ?>
            <h1>Quick-start</h1>
            <p class="text-justify">
                <strong>The structure in general</strong><br />
                The application's URL-path translates directly to the controllers (=files) and their methods inside
                application/controllers.<br />
                <br />
                <code>example.com/home/exampleOne</code> will do what the exampleOne() method in
                application/controllers/home.php says.<br />
                <br />
                <code>example.com/home</code> will do what the index() method in application/controllers/home.php says.<br />
                <br />
                <code>example.com</code> will do what the index() method in application/controllers/home.php says (default fallback).<br />
                <br />
                <code>example.com/songs</code> will do what the index() method in application/controllers/songs.php says.<br />
                <br />
                <code>example.com/users/edit/17</code> will do what the edit() method in application/controllers/users.php
                says and will pass 17 as a parameter to it.<br />
                <br />
                Self-explaining, right ?
            </p>
            <p class="text-justify">
                <strong>Showing a view</strong><br />
                Let's look at the exampleOne()-method in the home-controller (application/controllers/home.php):<br />
                This simply shows the header, footer and the example_one.php page (in views/home/).<br />
                By intention as simple and native as possible.
            </p>
            <pre>
    public function exampleOne()
    {
        // load view
        require APP . 'views/_templates/header.php';
        require APP . 'views/home/example_one.php';
        require APP . 'views/_templates/footer.php';
    }
            </pre>
            <p class="text-justify">
                <strong>Working with data</strong><br />
                Let's look into the index()-method in the home-controller (application/controllers/home.php):<br />
                Similar to exampleOne, but here we also request data.<br />
                Again, everything is extremely reduced and simple:<br />
                <code>$this->model->getAll(new User())</code> simply calls the getAll()-method in
                application/model/model.php, with a User() class as parameter.
            </p>
            <pre>
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $users = $this->model->getAll(new User());
        if(is_null($users))
            header('Location: ' . APP . 'home/index');

        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }
            </pre>
        </div>
    </div>
</div>