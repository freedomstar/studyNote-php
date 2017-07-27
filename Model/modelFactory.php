<?php
include "user.php";
include "note.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/16
 * Time: 上午8:37
 */
class modelFactory
{

    public static function getUserByUser_id($user_id,$userDao)
    {
        $userQuery=$userDao->getUserByUser_id($user_id);
        $user=new user($userQuery["username"],$userQuery["email"],$userQuery["password"],$userQuery["create_time"],$userQuery["user_id"],$userQuery["school"],$userQuery["sex"],$userQuery["education_id"],$userQuery["avatar"],$userQuery["introduction"]);
        return $user;
    }

    public static function getUserByEmail($Email,$userDao)
    {
        $userQuery=$userDao->getUserByEmail($Email);
        $user=new user($userQuery["username"],$userQuery["email"],$userQuery["password"],$userQuery["create_time"],$userQuery["user_id"],$userQuery["school"],$userQuery["sex"],$userQuery["education_id"],$userQuery["avatar"],$userQuery["introduction"]);
        return $user;
    }

    public static function getNoteByID($note_id,$noteDao)
    {
        $userQuery=$noteDao->getNoteByID($note_id);
        $note=new note($userQuery["note_id"],$userQuery["content"],$userQuery["create_time"],$userQuery["creator_id"],$userQuery["category_id"],$userQuery["title"],$userQuery["public"],$userQuery["education_id"],$userQuery["introduction"],$userQuery["cover"],$userQuery["hot"]);
        return $note;
    }

}
?>