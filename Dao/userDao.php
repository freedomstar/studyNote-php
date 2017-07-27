<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/16
 * Time: 上午8:34
 */
class userDao extends BaseDao
{

    public function __construct()
    {
       parent::__construct();
    }

    public function release()
    {
        parent::release();
    }

    public function updateUser($username,$user_id,$school,$sex,$education_id,$avatar,$introduction)
    {
        $sql="update user set username='$username',school='$school',sex='$sex',education_id='$education_id',avatar='$avatar',introduction='$introduction' WHERE user_id='$user_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function updateUserPassword($password,$user_id)
    {
        $sql="update user set password='$password' WHERE user_id='$user_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function addUser($email,$password,$education_id,$username)
    {
        $sql="insert into user(password,email,education_id,username,avatar) VALUES ('$password','$email','$education_id','$username','http://192.168.2.1/t.jpg')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function getUserByUser_id($user_id)
    {
        $sql="select * from user WHERE user_id='$user_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $result;
        }
    }

    public function getUserByEmail($email)
    {
        $sql="select * from user WHERE email='$email'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $result=mysqli_fetch_array($query);
            return $result;
        }
    }

    public function searchUser($key,$page)
    {
//        $lastCount=10*$page;
//        $count=10*($page-1);
        $pages=$this->page($page);
//        $sql="select * from user WHERE username LIKE '%$key%' ORDER BY user_id LIMIT $count,$lastCount";
        $sql="select * from user WHERE username LIKE '%$key%' ORDER BY user_id $pages ";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $list=array();
            while ($rs=mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                $list[]=$rs;
            }
            return $list;
        }
    }
}
?>