<?php
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/21
 * Time: 下午1:24
 */
header("Content-type:text/json; charset=UTF-8");
include "../Service/userService.php";
$user_care=$_POST['user_care'];
$user_be_cared=$_POST['user_be_cared'];
$userService=new userService();
echo json_encode(array ('state'=>$userService->cancelCareUser($user_care,$user_be_cared),'token'=>' '));
?>