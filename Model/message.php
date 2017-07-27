<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/15
 * Time: 下午12:53
 */
class message
{

    private $message_id;
    private $content;
    private $message_category_name;
    private $receiver_id;
    private $sender_id;
    private $create_time;

    public function __construct($message_id,$content,$message_category_name,$receiver_id,$sender_id,$create_time)
    {
        $this->message_id=$message_id;
        $this->content=$content;
        $this->create_time=$create_time;
        $this->message_category_name=$message_category_name;
        $this->receiver_id=$receiver_id;
        $this->sender_id=$sender_id;
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