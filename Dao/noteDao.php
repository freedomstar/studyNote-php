<?php

/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/16
 * Time: 上午8:35
 */
class noteDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function release()
    {
        parent::release();
    }

    public function getNoteByID($note_id)
    {
        $sql="select * from note WHERE note_id='$note_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $result;
        }
    }


    public function getNoteCommentCount($note_id)
    {
        $sql="select count(*) from note_comment WHERE note_id='$note_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $result['count(*)'];
        }
    }

    public function getNoteLikeCount($note_id)
    {
        $sql="select count(*) from user_like_note WHERE note_id='$note_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $result['count(*)'];
        }
    }

    public function getNotesByUserID($user_id,$page)
    {
        $pages=$this->page($page);
        $sql="select * from note WHERE creator_id='$user_id' ORDER BY note_id $pages";
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

    public function getNotesCountByUserID($user_id)
    {
        $sql="select count(*) from note WHERE creator_id='$user_id' AND PUBLIC=1";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $result["count(*)"];
        }
    }


    public function getNotesByOtherUserID($user_id,$page)
    {
        $pages=$this->page($page);
        $sql="select * from note WHERE creator_id='$user_id' AND PUBLIC=1 ORDER BY note_id $pages";
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

    public function getNoteCategory($Category_id)
    {
        $sql="select name from note_category WHERE category_id='$Category_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $result=mysqli_fetch_array($query);
            return $result;
        }
    }

    public function addNote($content,$creator_id,$category_id,$title,$public,$education_id,$introduction,$cover)
    {
        $sql="insert into note(content,creator_id,category_id,title,public,education_id,introduction,cover) VALUES ('$content','$creator_id','$category_id','$title','$public','$education_id','$introduction','$cover')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100))) ;
            return 200;
        }
    }

    public function deleteNote($note_id)
    {
        $sql="delete from note where note_id='$note_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100))) ;
            return 200;
        }
    }

    public function updateNotes($note_id,$content,$category_id,$title,$public,$education_id,$introduction,$cover)
    {
        $sql="update note set content='$content',category_id='$category_id',title='$title',public='$public',education_id='$education_id',introduction='$introduction',cover='$cover' where note_id='$note_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100))) ;
            return 200;
        }
    }


//    public function searchCategory($category_id)
//    {
//        $sql="select name from note_category where category_id = '$category_id' limit 1";
//        if ($this->_con!=null)
//        {
//            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
//            if ($query==null){
//                return false;
//            }
//            else
//            {
//                $rs=mysqli_fetch_array($query,MYSQLI_ASSOC);
//                return $rs['name'];
//            }
//        }
//    }

    public function searchNote($keyWord,$page,$order,$education)
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

        if ($order==0) {
            $sql = "select * from note WHERE (title LIKE '%$keyWord%' OR content LIKE '%$keyWord%' OR exists (SELECT category_id FROM note_category WHERE note_category.name LIKE '%$keyWord%' AND note.category_id=note_category.category_id)) AND PUBLIC=1 AND $education ORDER BY create_time $pages";
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
            $sql = "select * from note WHERE (note.title LIKE '%$keyWord%' OR note.content LIKE '%$keyWord%' OR exists (SELECT category_id FROM note_category WHERE note_category.name LIKE '%$keyWord%' AND note.category_id=note_category.category_id)) AND PUBLIC=1 AND $education ORDER BY hot DESC $pages";
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

    public function likeNote($note_id,$user_id)
    {
        $sql="insert into user_like_note(note_id,user_id) VALUES ('$note_id','$user_id')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100))) ;
            return 200;
        }
    }

    public function unLikeNote($note_id,$user_id)
    {
        $sql="delete from user_like_note WHERE note_id='$note_id' AND user_id='$user_id' ";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100))) ;
            return 200;
        }
    }

    public function getTopNote($page)
    {
        $pages=$this->page($page);
        $sql = "select * from note where DATE_SUB(CURDATE(), INTERVAL 100 DAY) <= date(create_time) AND PUBLIC=1 ORDER BY hot DESC $pages";
        if ($this->_con != null) {
            $query = mysqli_query($this->_con, $sql) or die(json_encode(array('state' => 100)));
            $list = array();
            while ($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $list[] = $rs;
            }
            return $list;
        }
    }

    public function getTopCoverNote()
    {
        $sql = "select * from note where DATE_SUB(CURDATE(), INTERVAL 100 DAY) <= date(create_time) AND PUBLIC=1 AND cover!='' ORDER BY hot DESC LIMIT 0,4";
        if ($this->_con != null) {
            $query = mysqli_query($this->_con, $sql) or die(json_encode(array('state' => 100)));
            $list = array();
            while ($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $list[] = $rs;
            }
            return $list;
        }
    }

    public function collectionNote($user_id,$note_id)
    {
        $sql="insert into user_collection_note(note_id,user_id) VALUES ('$note_id','$user_id')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100))) ;
            return 200;
        }
    }

    public function unCollectionNote($user_id,$note_id)
    {
        $sql="delete from user_collection_note WHERE note_id='$note_id' AND user_id='$user_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100))) ;
            return 200;
        }
    }

    public function isLikeNote($note_id,$user_id)
    {
        $sql="select 1 from user_like_note where note_id = '$note_id' AND user_id = '$user_id' limit 1";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100))) ;
            $rs=mysqli_fetch_array($query,MYSQLI_ASSOC);
            if ($rs==null){
                return false;
            }
            else
            {
                return true;
            }
        }
    }

    public  function isCollection($note_id,$user_id)
    {
        $sql="select 1 from user_collection_note where note_id = '$note_id' AND user_id = '$user_id' limit 1";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100))) ;
            $rs=mysqli_fetch_array($query,MYSQLI_ASSOC);
            if ($rs==null){
                return false;
            }
            else
            {
                return true;
            }
        }
    }

    public function getCollectionNote($user_id,$page)
    {
        $pages=$this->page($page);
        $sql="select note_id from user_collection_note WHERE user_id='$user_id' ORDER BY collection_id DESC $pages";
        if ($this->_con!=null)
        {
            $noteList=array();
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            while ($rs=mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                $noteList[]=$this->getNoteByID($rs['note_id']);
            }
            return $noteList;
        }
    }

    public function reportNote($note_id,$user_id,$content)
    {
        $sql="insert into be_report_note(note_id,user_id,content) VALUES('$note_id','$user_id','$content')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function getCategoryName($ID)
    {
        $sql="select NAME from note_category where category_id = '$ID'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $rs=mysqli_fetch_array($query);
            return $rs[0];
        }
    }

    public function getCategoryID($name)
    {
        $sql="select category_id from note_category where name = '$name'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $rs=mysqli_fetch_array($query);
            return $rs[0];
        }
    }

    public function addNoteCategory($name)
    {
        $sql="insert into note_category(name) VALUES('$name')";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

    public function getTopCategory()
    {
        $sql="select * from note_category ORDER BY search_times DESC limit 0,5";
        if ($this->_con!=null)
        {
            $list=array();
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            while ($rs=mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                $list[]=$rs;
            }
            return $list;
        }
    }

    public function searchCategory($category_id)
    {
        $sql="select name from note_category where category_id = '$category_id' limit 1";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            if ($query==null){
                return false;
            }
            else
            {
                $rs=mysqli_fetch_array($query,MYSQLI_ASSOC);
                return $rs['name'];
            }
        }
    }

    public function checkCategory($category)
    {
        $sql="select category_id from note_category where name = '$category' limit 1";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            if ($query==null){
                return false;
            }
            else
            {
                $rs=mysqli_fetch_array($query,MYSQLI_ASSOC);
                return $rs['category_id'];
            }
        }
    }

    public function addNoteHot($note_id,$hotCount)
    {
        $sql="update note set hot=hot+$hotCount where note_id = '$note_id'";
        if ($this->_con!=null)
        {
            mysqli_query($this->_con,$sql) or die();
        }
    }
}
?>