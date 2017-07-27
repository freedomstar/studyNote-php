<?php
include "../Dao/user_careDao.php";
include "../Dao/userDao.php";
include "../Dao/noteDao.php";
include "../Dao/note_commentDao.php";
include "../Model/modelFactory.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/21
 * Time: 下午2:39
 */
class noteService
{
    public function getNoteByID($note_id)
    {
        $noteDao=new noteDao();
        $note=modelFactory::getNoteByID($note_id,$noteDao);
        $userDao = new userDao();
        $author=modelFactory::getUserByUser_id($note->creator_id,$userDao);
        $category=$noteDao->getNoteCategory($note->category_id);
        $jsonNote=array("note_id"=>$note->note_id,"content"=>$note->content,"create_time"=>$note->create_time,"author_name"=>$author->username,"author_avatar"=>$author->avatar,"author_id"=>$note->creator_id,"category_id"=>$note->category_id,"category"=>$category["name"],"title"=>$note->title,"note_id"=>$note->note_id,"public"=>$note->public,"education_id"=>$note->education_id,"introduction"=>$note->introduction,"cover"=>$note->cover,"hot"=>$note->hot);
        $noteDao->release();
        $userDao->release();
        return $jsonNote;
    }

    public function getNotesByUserID($user_id,$page)
    {
        $noteDao=new noteDao();
        $note=$noteDao->getNotesByUserID($user_id,$page);
        for ($i=0;$i<count($note);$i++)
        {
            $note[$i]['category']=$noteDao->getCategoryName($note[$i]['category_id']);
        }
        $noteDao->release();
        return $note;
    }

    public function getNotesByOtherUserID($user_id,$page)
    {
        $noteDao=new noteDao();
        $note=$noteDao->getNotesByOtherUserID($user_id,$page);
        for ($i=0;$i<count($note);$i++)
        {
            $note[$i]['category']=$noteDao->getCategoryName($note[$i]['category_id']);
        }
        $noteDao->release();
        return $note;
    }

    public function addNote($content,$creator_id,$title,$public,$education_id,$introduction,$cover,$category)
    {
        $noteDao=new noteDao();
        $category_id=$noteDao->checkCategory($category);
        if ($category_id==false)
        {
            $rs=$noteDao->addNoteCategory($category);
            if ($rs==200)
            {
                $category_id=$noteDao->getCategoryID($category);
            }
        }
        $note=$noteDao->addNote($content,$creator_id,$category_id,$title,$public,$education_id,$introduction,$cover);
        $noteDao->release();
        return $note;
    }

    public function deleteNote($note_id)
    {
        $noteDao=new noteDao();
        $note=$noteDao->deleteNote($note_id);
        $noteDao->release();
        return $note;
    }

    public function updateNotes($note_id,$content,$category_id,$title,$public,$education_id,$introduction,$cover)
    {
        $noteDao=new noteDao();
        $category_idd=$noteDao->checkCategory($category_id);
        if ($category_idd==false)
        {
            $rs=$noteDao->addNoteCategory($category_id);
            if ($rs==200)
            {
                $category_idd=$noteDao->getCategoryID($category_id);
            }
        }
        $rs=$noteDao->updateNotes($note_id,$content,$category_idd,$title,$public,$education_id,$introduction,$cover);
        $noteDao->release();
        return $rs;
    }

    public function searchNote($keyWord,$page,$order,$education)
    {
        $userDao=new userDao();
        $noteDao=new noteDao();
        $noteList=$noteDao->searchNote($keyWord,$page,$order,$education);
//        $category_id=$noteDao
        for ($i=0;$i<count($noteList);$i++)
        {
            $user=modelFactory::getUserByUser_id($noteList[$i]['creator_id'],$userDao);
            $noteList[$i]['commentCount']=$noteDao->getNoteCommentCount($noteList[$i]['note_id']);
            $noteList[$i]['categoryName']=$noteDao->getCategoryName($noteList[$i]['category_id']);
            $noteList[$i]['username']=$user->username;
            $noteList[$i]['avatar']=$user->avatar;
            $noteList[$i]['likeCount']=$noteDao->getNoteLikeCount($noteList[$i]['note_id']);
        }
        $userDao->release();
        $noteDao->release();
        return $noteList;
    }

    public function likeNote($note_id,$user_id)
    {
        $noteDao=new noteDao();
        $rs=$noteDao->likeNote($note_id,$user_id);
        $noteDao->addNoteHot($note_id,5);
        $noteDao->release();
        return $rs;
    }

    public function unLikeNote($note_id,$user_id)
    {
        $noteDao=new noteDao();
        $rs=$noteDao->unLikeNote($note_id,$user_id);
        $noteDao->addNoteHot($note_id,-5);
        $noteDao->release();
        return $rs;
    }

    public function getTopNote($page)
    {
        $noteDao=new noteDao();
        $userDao=new userDao();
        $note_commentDao=new note_commentDao();
        $noteList=$noteDao->getTopNote($page);
        FOR($i=0;$i<count($noteList);$i++)
        {
            $user=modelFactory::getUserByUser_id($noteList[$i]['creator_id'],$userDao);
            $noteList[$i]['commentCount']=$noteDao->getNoteCommentCount($noteList[$i]['note_id']);
            $noteList[$i]['categoryName']=$noteDao->getCategoryName($noteList[$i]['category_id']);
            $noteList[$i]['username']=$user->username;
            $noteList[$i]['avatar']=$user->avatar;
            $noteList[$i]['likeCount']=$noteDao->getNoteLikeCount($noteList[$i]['note_id']);
        }
        $note_commentDao->release();
        $userDao->release();
        $noteDao->release();
        return $noteList;
    }

    public function collectionNote($user_id,$note_id)
    {
        $noteDao=new noteDao();
        $rs=$noteDao->collectionNote($user_id,$note_id);
        $noteDao->addNoteHot($note_id,5);
        $noteDao->release();
        return $rs;
    }

    public function unCollectionNote($user_id,$note_id)
    {
        $noteDao=new noteDao();
        $rs=$noteDao->unCollectionNote($user_id,$note_id);
        $noteDao->addNoteHot($note_id,-5);
        $noteDao->release();
        return $rs;
    }

    public function isLikeNote($note_id,$user_id)
    {
        $noteDao=new noteDao();
        $rs=$noteDao->isLikeNote($note_id,$user_id);
        $noteDao->release();
        return $rs;
    }



    public function isCollection($note_id,$user_id)
    {
        $noteDao=new noteDao();
        $rs=$noteDao->isCollection($note_id,$user_id);
        $noteDao->release();
        return $rs;
    }

    public function getCollectionNote($user_id,$page)
    {
        $noteDao=new noteDao();
        $rs=$noteDao->getCollectionNote($user_id,$page);
        $noteDao->release();
        return $rs;
    }

    public function reportNote($note_id,$user_id,$content)
    {
        $noteDao=new noteDao();
        $rs=$noteDao->reportNote($note_id,$user_id,$content);
        $noteDao->release();
        return $rs;
    }

    public function getNoteComments($note_id,$user_id,$page)
    {
        $note_commentDao=new note_commentDao();
        $userDao=new userDao();
        $rs=$note_commentDao->getNoteComments($note_id,$page);
        for ($i=0;$i<count($rs);$i++)
        {
            $user=modelFactory::getUserByUser_id($rs[$i]['user_id'],$userDao);
            $rs[$i]['username']=$user->username;
            $rs[$i]['avatar']=$user->avatar;
            if ($rs[$i]['user_id']==$user_id)
            {
                $rs[$i]['self']=true;
            }
            else
            {
                $rs[$i]['self']=false;
            }
        }
        $note_commentDao->release();
        $userDao->release();
        return $rs;
    }

    public function addNoteComment($content,$note_id,$user_id)
    {
        $noteDao=new noteDao();
        $note_commentDao=new note_commentDao();
        $rs=$note_commentDao->addNoteComment($content,$note_id,$user_id);
        $noteDao->addNoteHot($note_id,2);
        $note_commentDao->release();
        $noteDao->release();
        return $rs;
    }

    public function deleteNoteComment($note_comment_id)
    {
        $note_commentDao=new note_commentDao();
        $rs=$note_commentDao->deleteNoteComment($note_comment_id);
        $note_commentDao->release();
        return $rs;
    }

    public function getCategoryName($ID)
    {
        $noteDao=new noteDao();
        $rs=$noteDao->getCategoryName($ID);
        $noteDao->release();
        return $rs;
    }

    public function getTopCategory()
    {
        $noteDao=new noteDao();
        $rs=$noteDao->getTopCategory();
        $noteDao->release();
        return $rs;
    }

    public function getTopCoverNote()
    {
        $noteDao=new noteDao();
        $userDao=new userDao();
        $note_commentDao=new note_commentDao();
        $noteList=$noteDao->getTopCoverNote();
        FOR($i=0;$i<count($noteList);$i++)
        {
            $user=modelFactory::getUserByUser_id($noteList[$i]['creator_id'],$userDao);
            $noteList[$i]['commentCount']=$noteDao->getNoteCommentCount($noteList[$i]['note_id']);
            $noteList[$i]['categoryName']=$noteDao->getCategoryName($noteList[$i]['category_id']);
            $noteList[$i]['username']=$user->username;
            $noteList[$i]['avatar']=$user->avatar;
            $noteList[$i]['likeCount']=$noteDao->getNoteLikeCount($noteList[$i]['note_id']);
        }
        $note_commentDao->release();
        $userDao->release();
        $noteDao->release();
        return $noteList;
    }

}