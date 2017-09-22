<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 9/18/2017
 * Time: 11:34 AM
 */

class Song implements Table
{
    protected $id;
    protected $artist;
    protected $track;
    protected $link;

    const TABLE_NAME = "song";

    public function __construct()
    {
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getArtist()
    {
        return $this->artist;
    }
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }
    public function getTrack()
    {
        return $this->track;
    }
    public function setTrack($track)
    {
        $this->track = $track;
    }
    public function getLink()
    {
        return $this->link;
    }
    public function setLink($link)
    {
        $this->link = $link;
    }
    public function getAttributes()
    {
        return get_object_vars($this);
    }
}