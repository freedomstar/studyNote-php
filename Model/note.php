<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/15
 * Time: 上午11:55
 */
class note
{
    private $note_id;
    private $content;
    private $create_time;
    private $creator_id;
    private $category_id;
    private $title;
    private $public;
    private $education_id;
    private $introduction;
    private $cover;
    private $hot;

    public function __construct($note_id,$content,$create_time,$creator_id,$category_id,$title,$public,$education_id,$introduction,$cover,$hot)
    {
        $this->note_id=$note_id;
        $this->content=$content;
        $this->create_time=$create_time;
        $this->creator_id=$creator_id;
        $this->category_id=$category_id;
        $this->title=$title;
        $this->public=$public;
        $this->education_id=$education_id;
        $this->introduction=$introduction;
        $this->cover=$cover;
        $this->hot=$hot;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
}
?>