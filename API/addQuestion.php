<?php
include "../Service/questionService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/28
 * Time: 上午10:31
 */
header("Content-type:text/json; charset=UTF-8");
$user_id=$_POST['user_id'];
$content=$_POST['content'];
$education_id=$_POST['education_id'];
$title=$_POST['title'];
$cover=$_POST['cover'];
$introduction=$_POST['introduction'];
$questionService=new questionService();
echo json_encode(array ('state'=>$questionService->addQuestion($user_id,$content,$education_id,$title,$introduction,$cover),'token'=>' '));
?>