<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/answerService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/31
 * Time: 下午12:47
 */
$answer_id=$_POST['answer_id'];
$content=$_POST['content'];
$introduction=$_POST['introduction'];
$cover=$_POST['cover'];
$answerService=new answerService();
echo json_encode(array('state'=>$answerService->updateAnswer($answer_id,$content,$introduction,$cover),'token'=>' '));
?>

