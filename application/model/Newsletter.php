<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 9/18/2017
 * Time: 3:42 PM
 */

class Newsletter implements Table
{
    protected $id;
    protected $title;
    protected $date;
    protected $banner_url;
    protected $content;
    protected $fk_user_id;

    const TABLE_NAME = 'Newsletters';

    public function __construct()
    {
    }

    public function getAttributes(){
        return get_object_vars($this);
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function getBannerUrl()
    {
        return $this->banner_url;
    }
    public function setBannerUrl($banner_url)
    {
        $this->banner_url = $banner_url;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function getFkUserId()
    {
        return $this->fk_user_id;
    }
    public function setFkUserId($fk_user_id)
    {
        $this->fk_user_id = $fk_user_id;
    }
}