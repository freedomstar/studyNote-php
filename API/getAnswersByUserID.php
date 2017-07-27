<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/answerService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/30
 * Time: 上午9:15
 */
$user_id=$_POST['user_id'];
$page=$_POST['page'];
$answerService=new answerService();
echo json_encode(array('data'=>$answerService->getAnswersByUserID($user_id,$page),'token'=>' '));
?>