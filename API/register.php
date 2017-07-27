<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/20
 * Time: 下午1:24
 */
include "../Service/userService.php";

$password=$_POST['password'];
$email=$_POST['email'];
$username=$_POST['username'];
$education_id=$_POST['education_id'];
$userService=new userService();
echo json_encode(array ('state'=>$userService->register($email,$password,$education_id,$username),'token'=>' '));
?>