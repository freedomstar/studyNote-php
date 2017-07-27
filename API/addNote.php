<?php
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/21
 * Time: 下午4:36
 */
header("Content-type:text/json; charset=UTF-8");
include "../Service/noteService.php";


$content=$_POST['content'];
$creator_id=$_POST['user_id'];
$title=$_POST['title'];
$public=$_POST['public'];
$education_id=$_POST['education_id'];
$introduction=$_POST['introduction'];
$cover=$_POST['cover'];
$category=$_POST['category'];

$noteService=new noteService();
echo json_encode(array ('state'=>$noteService->addNote($content,$creator_id,$title,$public,$education_id,$introduction,$cover,$category),'token'=>' '));
?>