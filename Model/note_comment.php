<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/15
 * Time: 下午12:49
 */
class note_comment
{

    private $note_comment_id;
    private $content;
    private $note_id;
    private $user_id;
    private $create_time;

    public function __construct($note_comment_id,$content,$note_id,$user_id,$create_time)
    {
        $this->note_comment_id=$note_comment_id;
        $this->content=$content;
        $this->note_id=$note_id;
        $this->user_id=$user_id;
        $this->create_time=$create_time;
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