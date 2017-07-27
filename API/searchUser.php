<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/21
 * Time: 下午12:30
 */
include "../Service/userService.php";

$key=$_POST['keyWord'];
$page=$_POST['page'];
$userService=new userService();
echo json_encode(array('data'=>$userService->searchUser($key,$page),'token'=>' '));
?>