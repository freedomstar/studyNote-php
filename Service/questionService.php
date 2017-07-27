<?php
include "../Dao/user_careDao.php";
include "../Dao/userDao.php";
include "../Model/modelFactory.php";
include "../Dao/questionDao.php";
include "../Dao/answerDao.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/26
 * Time: 下午2:27
 */
class questionService
{
    public  function getQuestion($question_id)
    {
        $questionDao=new questionDao();
        $userDao=new  userDao();
        $rs=$questionDao->getQuestion($question_id);
        $user = modelFactory::getUserByUser_id($rs['creator_id'], $userDao);
        $rs['avatar'] = $user->avatar;
        $rs['username'] = $user->username;
        $questionDao->release();
        $userDao->release();
        return $rs;
    }

    public function getQuestionByUserID($user_id,$page)
    {
        $questionDao=new questionDao();
        $userDao=new userDao();
        $rs=$questionDao->getQuestionByUserID($user_id,$page);
        for ($i=0;$i<count($rs);$i++)
        {
            $user=modelFactory::getUserByUser_id($rs[$i]['creator_id'],$userDao);
            $rs[$i]['username']=$user->username;
            $rs[$i]['avatar']=$user->avatar;
            if ($rs[$i]['creator_id']==$user_id)
            {
                $rs[$i]['self']=true;
            }
            else
            {
                $rs[$i]['self']=false;
            }
        }
        $questionDao->release();
        $userDao->release();
        return $rs;
    }


    public function searchQuestion($keyWord,$page,$order,$finshed,$education)
    {
        $questionDao=new questionDao();
        $userDao=new userDao();
        $answerDao=new answerDao();
        $searchList=array();
        $questionLIST=$questionDao->searchQuestion($keyWord,$page,$order,$finshed,$education);
        FOR($i=0;$i<count($questionLIST);$i++)
        {
            $search=array();
            $answer=$answerDao->searchAnswersByQuestionID($questionLIST[$i]['question_id']);
            if ($answer!=null)
            {
                $user = modelFactory::getUserByUser_id($answer['answerer_id'], $userDao);
                $search['avatar'] = $user->avatar;
                $search['username'] = $user->username;
                $search['question_id'] = $questionLIST[$i]['question_id'];
                $search['title'] = $questionLIST[$i]['title'];
                $search['answer_id'] = $answer['answer_id'];
                $search['create_time'] = $answer['create_time'];
                $search['introduction'] = $answer['introduction'];
                $search['answerer_id'] = $answer['answerer_id'];
                $search['content'] = $answer['content'];
                $search['likeCount'] = $answerDao->getAnswerLikeCount($answer['answer_id']);
                $search['commentCount'] = $answerDao->getAnswerCommentCount($answer['answer_id']);
                $search['cover'] = $answer['cover'];
                $search['answer'] = true;
            }
            else
                {
                    $user = modelFactory::getUserByUser_id($questionLIST[$i]['creator_id'], $userDao);
                    $search['avatar'] = $user->avatar;
                    $search['username'] = $user->username;
                    $search['question_id'] = $questionLIST[$i]['question_id'];
                    $search['title'] = $questionLIST[$i]['title'];
                    $search['create_time'] = $questionLIST[$i]['create_time'];
                    $search['introduction'] = $questionLIST[$i]['introduction'];
                    $search['content'] = $questionLIST[$i]['content'];
                    $search['cover'] = $questionLIST[$i]['cover'];
                    $search['answer'] = false;
                }
            $searchList[]=$search;
        }
        $answerDao->release();
        $questionDao->release();
        $userDao->release();
        return $searchList;
    }


    public function addQuestion($user_id,$content,$education_id,$title,$introduction,$cover)
    {
        $questionDao=new questionDao();
        $rs=$questionDao->addQuestion($user_id,$content,$education_id,$title,$introduction,$cover);
        $questionDao->release();
        return $rs;
    }

    public function updateQuestions($question_id,$content,$education_id,$title,$introduction,$cover)
    {
        $questionDao=new questionDao();
        $rs=$questionDao->updateQuestions($question_id,$content,$education_id,$title,$introduction,$cover);
        $questionDao->release();
        return $rs;
    }

    public function deleteQuestions($question_id)
    {
        $questionDao=new questionDao();
        $rs=$questionDao->deleteQuestions($question_id);
        $questionDao->release();
        return $rs;
    }

    public function reportQuestions($question_id,$user_id,$content)
    {
        $questionDao=new questionDao();
        $rs=$questionDao->reportQuestions($question_id,$user_id,$content);
        $questionDao->release();
        return $rs;
    }

    public function closeQuestions($question_id)
    {
        $questionDao=new questionDao();
        $rs=$questionDao->closeQuestions($question_id);
        $questionDao->release();
        return $rs;
    }

}
?>