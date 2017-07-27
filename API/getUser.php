<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/userService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/21
 * Time: 下午3:15
 */
$user_id=$_POST['user_id'];
$loginUser=$_POST['loginUser'];
$userService=new userService();
$user=$userService->getUser($user_id,$loginUser);
echo json_encode(array('data'=>$user,'token'=>' '));
?>