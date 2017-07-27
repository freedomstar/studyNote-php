<?php
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/21
 * Time: 下午12:53
 */
header("Content-type:text/json; charset=UTF-8");
include "../Service/userService.php";
$user_care=$_POST['user_care'];
$user_be_cared=$_POST['user_be_cared'];
$userService=new userService();
echo json_encode(array ('state'=>$userService->careUser($user_care,$user_be_cared),'token'=>' '));
?>