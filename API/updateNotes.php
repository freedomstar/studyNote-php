<?php
header("Content-type:text/json; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/22
 * Time: 上午10:33
 */
include "../Service/noteService.php";

$note_id=$_POST['note_id'];
$content=$_POST['content'];
$category_id=$_POST['category'];
$title=$_POST['title'];
$public=$_POST['public'];
$education_id=$_POST['education_id'];
$introduction=$_POST['introduction'];
$cover=$_POST['cover'];

$noteService=new noteService();
echo json_encode(array('state'=>$noteService->updateNotes($note_id,$content,$category_id,$title,$public,$education_id,$introduction,$cover),'token'=>' '));
?>