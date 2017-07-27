<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/15
 * Time: 下午12:47
 */
class answer
{

    private $answer_id;
    private $question_id;
    private $content;
    private $answerer_id;
    private $create_time;
    private $introduction;


    public function __construct($answer_id,$question_id,$content,$answerer_id,$create_time,$introduction)
    {
        $this->answer_id=$answer_id;
        $this->content=$content;
        $this->create_time=$create_time;
        $this->question_id=$question_id;
        $this->answerer_id=$answerer_id;
        $this->introduction=$introduction;
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