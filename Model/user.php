<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/15
 * Time: 下午12:42
 */
class user
{
    private $username;
    private $email;
    private $password;
    private $create_time;
    private $user_id;
    private $school;
    private $sex;
    private $education_id;
    private $avatar;
    private $introduction;

    public function __construct($username,$email,$password,$create_time,$user_id,$school,$sex,$education_id,$avatar,$introduction)
    {
        $this->password=$password;
        $this->avatar=$avatar;
        $this->create_time=$create_time;
        $this->education_id=$education_id;
        $this->email=$email;
        $this->introduction=$introduction;
        $this->school=$school;
        $this->sex=$sex;
        $this->user_id=$user_id;
        $this->username=$username;
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