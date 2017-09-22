# EASYCAKE
## About this framework

THIS IS REAL, THE EASYCAKE MVC HAS BEEN DONE.<br>
IT IS READY FOR REALY LIFE OUT THERE.<br>
IT IS WORKING, SAFE, SECURE, SIMPLE AND SEXY.<br>
USE IT WITH CAUTION, DO NOT DIVISE BY 0.<br>

This barebone framework is based on MINI and is MVC structured.<br>
It is meant to simplify a developers' job when creating a website and not have to reinvent the wheel everytime.<br>
It supports a few features out-of-the-box:
- extremely simple, easy to understand
- simple but clean structure
- makes "beautiful" clean URLs
- demo CRUD actions: Create, Read, Update and Delete database entries easily
- demo AJAX call
- tries to follow PSR 1/2 coding guidelines
- uses PDO for any database requests, comes with an additional PDO debug tool to emulate your SQL statements
- commented code
- uses only native PHP code, so people don't have to learn a framework
Some features have been added by Paul R. De Buck with much generosity.

## Goodies
### Variables Sanitizer
Added by Paul this MVC comes with an easy variables sanitizer for showing in HTML from PHP.<br>
It will escape any variables from the user to be shown in PHP without risks.<br>
Use it this way:

```php
echo Helper::sanitize($varToSanitize);
```

### PDO Debugger
MINI comes with a little customized PDO debugger tool (find the code in application/libs/helper.php), trying to emulate 
your PDO-SQL statements.<br> 
It's extremely easy to use:

```php
$sql = "SELECT id, artist, track, link FROM song WHERE id = :song_id LIMIT 1";
$query = $this->db->prepare($sql);
$parameters = array(':song_id' => $song_id);

echo Helper::debugPDO($sql, $parameters);

$query->execute($parameters);
```

### Alert Manager
Added by Paul this MVC comes with a tool to show 'alerts' with predefined color background very simply across pages.<br>
Here is how to create an alert to display to the user:

```php
AlertManager::add("New user correctly created", AlertManager::SUCCESS);
```

You can choose between: PRIMARY, SECONDARY, SUCCESS, DANGER, WARNING, INFO. And on the next page here is how to show the
 alert:
```php
echo AlertManager::show();
```

## Quick-start
### The structure in general
The application's URL-path translates directly to the controllers (=files) and their methods inside application/controllers.

`example.com/home/exampleOne` will do what the exampleOne() method in application/controllers/home.php says.

`example.com/home` will do what the index() method in application/controllers/home.php says.

`example.com will` do what the index() method in application/controllers/home.php says (default fallback).

`example.com/songs` will do what the index() method in application/controllers/songs.php says.

`example.com/users/edit/17` will do what the edit() method in application/controllers/users.php says and will pass 17 as a parameter to it.

Self-explaining, right ?

### Showing a view
Let's look at the exampleOne()-method in the home-controller (application/controllers/home.php):<br>
This simply shows the header, footer and the example_one.php page (in views/home/).<br>
By intention as simple and native as possible.

```php
public function exampleOne()
    {
        // load view
        require APP . 'views/_templates/header.php';
        require APP . 'views/home/example_one.php';
        require APP . 'views/_templates/footer.php';
    }
```

### Working with data
Let's look into the index()-method in the home-controller (application/controllers/home.php):<br>
Similar to exampleOne, but here we also request data.<br>
Again, everything is extremely reduced and simple:<br>
`$this->model->getAll(new User())` simply calls the getAll()-method in application/model/model.php, with a User() class as parameter.

```php
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
```