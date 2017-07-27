<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/questionService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/26
 * Time: 下午2:26
 */
$user_id=$_POST['user_id'];
$page=$_POST['page'];

$questionService=new questionService();
echo json_encode(array('data'=>$questionService->getQuestionByUserID($user_id,$page),'token'=>' '));
?>