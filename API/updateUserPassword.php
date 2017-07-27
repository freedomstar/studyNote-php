<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/16
 * Time: 上午9:10
 */

include "../Service/userService.php";

$newPassword=$_POST['newPassword'];
$password=$_POST['password'];
$user_id=$_POST['user_id'];
$userService=new userService();
echo json_encode(array ('state'=>$userService->updateUserPassword($newPassword,$user_id,$password),'token'=>' '));
?>