<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/16
 * Time: 上午8:55
 */
include "../Service/userService.php";
$username=$_POST['username'];
$school=$_POST['school'];
$sex=$_POST['sex'];
$education_id=$_POST['education_id'];
$avatar=$_POST['avatar'];
$introduction=$_POST['introduction'];
$user_id=$_POST['user_id'];
$userService=new userService();
echo json_encode(array ('state'=>$userService->updateUser($username,$user_id,$school,$sex,$education_id,$avatar,$introduction),'token'=>' '));
?>