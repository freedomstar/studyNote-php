<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/userService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/21
 * Time: 上午10:27
 */
$user_id=$_POST['user_id'];
$page=$_POST['page'];
$userService=new userService();
$userList=$userService->getCareUser($user_id,$page);
echo json_encode(array('data'=>$userList,'token'=>' '));
?>