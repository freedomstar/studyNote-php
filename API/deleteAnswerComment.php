<?php
header("Content-type:text/json; charset=UTF-8");
include "../Service/answerService.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/31
 * Time: 下午1:24
 */
$answer_comment_id=$_POST['answer_comment_id'];
$answerService=new answerService();
echo json_encode(array ('state'=>$answerService->deleteAnswerComment($answer_comment_id),'token'=>' '));
?>