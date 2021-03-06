<?php

class Model
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all from database, takes the class as input,
     * @returns Array($class) always
     */
    public function getAll($class)
    {
        /* building SQL query */
        $sql = 'SELECT * FROM ' . $class::TABLE_NAME . ' WHERE 1=1 ';
        foreach($class->getAttributes() as $key => $value){
            if($value != null){
                $sql .= " AND " . $key . " = '" . $value . "'";
            }
        }

        try {
            $query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $query->execute();

            if($query)
                return $query->fetchAll(PDO::FETCH_CLASS, get_class($class));
            else
                return null;
        }catch(PDOException $exception){
            return null;
        }
    }

    /**
     * Get from table, with parameter of value passed
     * @return $class if only 1 row
     * @return Array($class) if more than 1 row
     */
    public function get($class, $limit = 10000){
        /* building SQL query */
        $sql = 'SELECT TOP ' . $limit . ' * FROM ' . $class::TABLE_NAME . ' WHERE 1=1 ';
        foreach($class->getAttributes() as $key => $value){
            if($value != null){
                $sql .= " AND " . $key . " = '" . $value . "'";
            }
        }

        try {
            $query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $query->execute();

            if($query->rowCount() > 1)
                return $query->fetchAll(PDO::FETCH_CLASS, get_class($class));
            else if($query->rowCount() == 1)
                return $query->fetchAll(PDO::FETCH_CLASS, get_class($class))[0];
            else
                return null;
        }catch(PDOException $exception){
            return null;
        }
    }

    /**
     * This add a class to the database, all null values will be passed as such
     * This will generate this kind of request with a User class for example
     * INSERT INTO Users (name, password, login) VALUES ('Popol', 'popol', 'popol')
     */
    public function add($class){
        /* building SQL query */
        $sql = 'INSERT INTO ' . $class::TABLE_NAME;
        $columns = ' (';
        $replace = ' (';
        $values = Array();
        foreach($class->getAttributes() as $key => $value){
            if($value != null){
                $columns .= $key . ', ';
                $replace .= ':' . $key . ', ';
                array_push($values, $value);
            }
        }
        $columns = substr($columns, 0, -2); /* remove last ", " */
        $replace = substr($replace, 0, -2);

        $sql .= $columns . ') VALUES ' . $replace . ')';

        try{
            //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $values);  exit();
            $query = $this->db->prepare($sql);
            $query->execute($values);
            return true;
        }catch(PDOException $exception){
            return $exception->getMessage();
        }
    }

    public function update($class){
        /* Building SQL query */
        $sql = "UPDATE " . $class::TABLE_NAME . " SET ";
        $columns = "";
        $values = Array();

        /* Looping through all attributes */
        foreach($class->getAttributes() as $key => $value){
            if($value != null){
                if($key != 'id'){
                    $columns .= $key . ' = ';
                    $columns .= ':' . $key . ', ';
                    $values[':' . $key] = $value;
                }
            }
        }

        $columns = substr($columns, 0, -2); /* remove last ", " */
        $sql .= $columns . " WHERE id = " . $class->getId();

        $query = $this->db->prepare($sql);

        // useful for debugging: you can see the SQL behind above construction by using:
        /*echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $values);
        echo "<pre>";
        print_r ($values);
        echo "</pre>";
        //exit();*/

        try{
            $query->execute($values);
            return true;
        }catch(PDOException $exception){
            return $exception->getMessage();
        }
    }

    /**
     * @param $class: it will use the ID of the class to know where to delete from
     */
    public function remove($class)
    {
        $sql = "DELETE FROM " . $class::TABLE_NAME . "  WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $class->getId());
        try{
            // useful for debugging: you can see the SQL behind above construction by using:
            //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);

            if($query->execute($parameters))
                return $query;
            else
                return $query->errorInfo();
        }catch(PDOException $exception){
            return $exception->getCode();
            die();
        }
    }



    /**
     * Add a song to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     */
    public function addSong($artist, $track, $link)
    {
        $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a song in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $song_id Id of song
     */
    public function deleteSong($song_id)
    {
        $sql = "DELETE FROM song WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a song from database
     */
    public function getSong($song_id)
    {
        $sql = "SELECT TOP 1 id, artist, track, link FROM song WHERE id = :song_id ORDER BY id ASC";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a song in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     * @param int $song_id Id
     */
    public function updateSong($artist, $track, $link, $song_id)
    {
        $sql = "UPDATE song SET artist = :artist, track = :track, link = :link WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link, ':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/songs.php for more)
     */
    public function getAmountOfSongs()
    {
        $sql = "SELECT COUNT(id) AS amount_of_songs FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }
}
