<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/20
 * Time: 上午11:27
 */
include "../Service/userService.php";
$email=$_POST['email'];
$password=$_POST['password'];
$userService=new userService();
$data=$userService->login($password,$email);
$data['token']=' ';
echo json_encode($data);
?>