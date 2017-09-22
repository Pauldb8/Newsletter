<?php

class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $model = null;

    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModel();
        $this->loadLanguage();
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
            $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        }else{
            $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        }

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':Server=' . DB_HOST . ';Database=' . DB_NAME . ';ConnectionPooling=0;', DB_USER, DB_PASS, $options);
    }

    /**
     * Loads the "model".
     * @return object model
     */
    public function loadModel()
    {
        function loadClass($classname)
        {
            require APP . 'model/' . $classname . '.php';
        }
        spl_autoload_register('loadClass');

        require APP . 'model/Model.php';
        // create new "model" (and pass the database connection)
        $this->model = new model($this->db);
    }

    public function loadLanguage(){
        if(isset($_SESSION['easy_language'])){
            require APP . 'model/Strings.' . $_SESSION['easy_language'] . '.php';
        }else{
            $_SESSION['easy_language'] = 'eng';
            require APP . 'model/Strings.' . $_SESSION['easy_language'] . '.php';
        }
    }
}
