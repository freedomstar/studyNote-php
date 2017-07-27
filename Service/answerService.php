<?php
include "../Dao/user_careDao.php";
include "../Dao/userDao.php";
include "../Model/modelFactory.php";
include "../Dao/questionDao.php";
include "../Dao/answerDao.php";
include "../Dao/answer_commentDao.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/30
 * Time: 上午8:52
 */
class answerService
{
    public function getAnswer($answer_id,$user_id)
    {
        $questionDao=new questionDao();
        $answerDao=new answerDao();
        $userDao = new userDao();
        $rs=$answerDao->getAnswer($answer_id);
        $rs['isLike']=$answerDao->isLikeAnswer($answer_id,$user_id);
        $user=modelFactory::getUserByUser_id($rs['answerer_id'],$userDao);
        $rs['username']=$user->username;
        $rs['avatar']=$user->avatar;
        $question=$questionDao->getQuestion($rs['question_id']);
        $rs['questionTitle']=$question['title'];
        $questionDao->release();
        $userDao->release();
        $answerDao->release();
        return $rs;
    }

    public function getAnswersByUserID($user_id,$page)
    {
        $answerDao=new answerDao();
        $rs=$answerDao->getAnswersByUserID($user_id,$page);
        $questionDao=new questionDao();
        FOR($i=0;$i<count($rs);$i++)
        {
            $question=$questionDao->getQuestion($rs[$i]['question_id']);
            $answerList[$i]['title']=$question['title'];
        }
        $questionDao->release();
        $answerDao->release();
        return $rs;
    }

    public function getAnswersByQuestionID($question_id,$page)
    {
        $answerDao=new answerDao();
        $userDao=new  userDao();
        $answerList=$answerDao->getAnswersByQuestionID($question_id,$page);
        FOR($i=0;$i<count($answerList);$i++)
        {
            $user=modelFactory::getUserByUser_id($answerList[$i]['answerer_id'],$userDao);
            $answerList[$i]['commentCount']=$answerDao->getAnswerCommentCount($answerList[$i]['answer_id']);
            $answerList[$i]['username']=$user->username;
            $answerList[$i]['avatar']=$user->avatar;
            $answerList[$i]['likeCount']=$answerDao->getAnswerLikeCount($answerList[$i]['answer_id']);
        }
        $userDao->release();
        $answerDao->release();
        return $answerList;
    }

    public function addAnswer($question_id,$content,$answerer_id,$introduction,$cover)
    {
        $answerDao=new answerDao();
        $rs=$answerDao->addAnswer($question_id,$content,$answerer_id,$introduction,$cover);
        $answerDao->release();
        return $rs;
    }

    public function deleteAnswer($answer_id)
    {
        $answerDao=new answerDao();
        $rs=$answerDao->deleteAnswer($answer_id);
        $answerDao->release();
        return $rs;
    }

    public function updateAnswer($answer_id,$content,$introduction,$cover)
    {
        $answerDao=new answerDao();
        $rs=$answerDao->updateAnswer($answer_id,$content,$introduction,$cover);
        $answerDao->release();
        return $rs;
    }

    public function likeAnswers($answer_id,$user_id)
    {
        $answerDao=new answerDao();
        $rs=$answerDao->likeAnswers($answer_id,$user_id);
        $answerDao->addAnswerHot($answer_id,5);
        $answerDao->release();
        return $rs;
    }

    public function unLikeAnswers($answer_id,$user_id)
    {
        $answerDao=new answerDao();
        $rs=$answerDao->unLikeAnswers($answer_id,$user_id);
        $answerDao->addAnswerHot($answer_id,-5);
        $answerDao->release();
        return $rs;
    }

    public function reportAnswers($answer_id,$user_id,$content)
    {
        $answerDao=new answerDao();
        $rs=$answerDao->reportAnswers($answer_id,$user_id,$content);
        $answerDao->release();
        return $rs;
    }

    public function addAnswerComment($answer_id,$user_id,$content)
    {
        $answerDao=new answerDao();
        $answer_commentDao=new answer_commentDao();
        $rs=$answer_commentDao->addAnswerComment($answer_id,$user_id,$content);
        $answerDao->addAnswerHot($answer_id,10);
        $answerDao->release();
        $answer_commentDao->release();
        return $rs;
    }

    public function deleteAnswerComment($answer_comment_id)
    {
        $answer_commentDao=new answer_commentDao();
        $rs=$answer_commentDao->deleteAnswerComment($answer_comment_id);
        $answer_commentDao->release();
        return $rs;
    }

    public function getAnswerComments($answer_id,$page,$user_id)
    {
        $userDao=new userDao();
        $answer_commentDao=new answer_commentDao();
        $rs=$answer_commentDao->getAnswerComments($answer_id,$page);
        for ($i=0;$i<count($rs);$i++)
        {
            $user=modelFactory::getUserByUser_id($rs[$i]['user_id'],$userDao);
            $rs[$i]['avatar']=$user->avatar;
            $rs[$i]['username']=$user->username;
            if ($rs[$i]['user_id']==$user_id)
            {
                $rs[$i]['self']=true;
            }
            else
            {
                $rs[$i]['self']=false;
            }
        }
        $userDao->release();
        $answer_commentDao->release();
        return $rs;
    }

    public function getTopAnswer($page)
    {
        $userDao=new userDao();
        $answerDao=new answerDao();
        $questionDao=new questionDao();
        $answerList=$answerDao->getTopAnswer($page);
        FOR($i=0;$i<count($answerList);$i++)
        {
            $user=modelFactory::getUserByUser_id($answerList[$i]['answerer_id'],$userDao);
            $question=$questionDao->getQuestion($answerList[$i]['question_id']);
            $answerList[$i]['questionTitle']=$question['title'];
            $answerList[$i]['commentCount']=$answerDao->getAnswerCommentCount($answerList[$i]['answer_id']);
            $answerList[$i]['username']=$user->username;
            $answerList[$i]['avatar']=$user->avatar;
            $answerList[$i]['likeCount']=$answerDao->getAnswerLikeCount($answerList[$i]['answer_id']);
        }
        $questionDao->release();
        $answerDao->release();
        $userDao->release();
        return $answerList;
    }
}