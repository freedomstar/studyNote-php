<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/15
 * Time: 下午12:45
 */
class question
{
    private $question_id;
    private $create_time;
    private $creator_id;
    private $content;
    private $state;
    private $education_id;
    private $title;

    public function __construct($question_id,$create_time,$creator_id,$content,$state,$education_id,$title)
    {
        $this->question_id=$question_id;
        $this->create_time=$create_time;
        $this->creator_id=creator_id;
        $this->content=$content;
        $this->state=$state;
        $this->education_id=$education_id;
        $this->title=$title;
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