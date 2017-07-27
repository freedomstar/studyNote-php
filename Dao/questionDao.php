<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/15
 * Time: 下午1:06
 */
class questionDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function release()
    {
        parent::release();
    }

    public function getQuestion($question_id)
    {
        $sql="select * from question WHERE question_id='$question_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $rs=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $rs;
        }
    }

    public function getQuestionByUserID($user_id,$page)
    {
        $pages=$this->page($page);
        $sql="select * from question WHERE creator_id='$user_id' ORDER BY create_time $pages";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $list=array();
            while ($rs=mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                $list[]=$rs;
            }
            return $list;
        }
    }

    public function searchQuestion($keyWord,$page,$order,$finshed,$education)
    {
        $pages=$this->page($page);
        if ($education==0)
        {
            $education=1;
        }
        else
        {
            $education="education_id = $education";
        }
        if ($finshed==1)
        {
            $finshed="state=0";
        }
        else if ($finshed==2)
        {
            $finshed="state=1";
        }
        else
        {
            $finshed="1";
        }
        if ($order==0) {
            $sql = "select * from question WHERE (title LIKE '%$keyWord%' OR content LIKE '%$keyWord%' ) AND $finshed AND $education ORDER BY create_time DESC $pages";
            if ($this->_con != null) {
                $query = mysqli_query($this->_con, $sql) or die(json_encode(array('state' => 100)));
                $list = array();
                while ($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    $list[] = $rs;
                }
                return $list;
            }
        }
        else
        {
            $sql = "select question.*,(SELECT DISTINCT count(question_id) FROM answer WHERE question.question_id=answer.question_id) as likeCount from question WHERE (question.title LIKE '%$keyWord%' OR question.content LIKE '%$keyWord%') AND $finshed ORDER BY likeCount DESC $pages";
            if ($this->_con != null) {
                $query = mysqli_query($this->_con, $sql) or die(json_encode(array('state' => 100)));
                $list = array();
                while ($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    $list[] = $rs;
                }
                return $list;
            }
        }
    }

    public function addQuestion($user_id,$content,$education_id,$title,$introduction,$cover)
    {
        $sql="insert into question(creator_id,content,education_id,title,state,introduction,cover) VALUES ('$user_id','$content','$education_id','$title',1,'$introduction','$cover')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
//            mysqli_query($this->_con,$sql);
            return 200;
        }
    }

    public function updateQuestions($question_id,$content,$education_id,$title,$introduction,$cover)
    {
        $sql="update question set content='$content',education_id='$education_id',title='$title',introduction='$introduction',cover='$cover' WHERE question_id='$question_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function deleteQuestions($question_id)
    {
        $sql="delete from question WHERE question_id='$question_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function reportQuestions($question_id,$user_id,$content)
    {
        $sql="insert into be_report_question(question_id,user_id,content) VALUES ('$question_id','$user_id','$content')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function closeQuestions($question_id)
    {
        $sql="update question set state=0 WHERE question_id='$question_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function getUserQuestionCount($user_id)
    {
        $sql="select count(*) from question WHERE creator_id='$user_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $result["count(*)"];
        }
    }
}
?>