<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/15
 * Time: 下午12:51
 */
class answer_comment
{

    private $answer_comment_id;
    private $answer_id;
    private $content;
    private $user_id;
    private $create_time;

    public function __construct($answer_comment_id,$answer_id,$content,$user_id,$create_time)
    {
        $this->answer_comment_id=$answer_comment_id;
        $this->content=$content;
        $this->create_time=$create_time;
        $this->answer_id=$answer_id;
        $this->user_id=$user_id;
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