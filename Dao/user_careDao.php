<?php
include "BaseDao.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/16
 * Time: 上午8:33
 */
class user_CareDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function release()
    {
        parent::release();
    }

    public function isCare($user_id,$loginUser)
    {
        $sql="select 1 from user_care WHERE user_be_cared='$user_id' AND user_care='$loginUser'";
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

    public function getUserFans($user_id,$page)
    {
        $pages=$this->page($page);
        $sql="select user_care from user_care WHERE user_be_cared='$user_id' ORDER BY iduser_care $pages";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $list=array();
            while ($rs=mysqli_fetch_array($query))
            {
                $list[]=$rs;
            }
            return $list;
        }
    }


    public function getUserCare($user_id,$page)
    {
        $pages=$this->page($page);
        $sql="select user_be_cared from user_care WHERE user_care='$user_id' ORDER BY iduser_care $pages";
        if ($this->_con!=null)
        {
           $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
           $list=array();
           while ($rs=mysqli_fetch_array($query))
           {
               $list[]=$rs;
           }
           return $list;
        }
    }

    public function getUserCareCOUNT($user_id)
    {
        $sql="select COUNT(*) from user_care WHERE user_care='$user_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $rs=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $rs['COUNT(*)'];
        }
    }

    public function getUserFansCOUNT($user_id)
    {
        $sql="select COUNT(*) from user_care WHERE user_be_cared='$user_id'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            $rs=mysqli_fetch_array($query,MYSQLI_ASSOC);
            return $rs['COUNT(*)'];
        }
    }

    public function careUser($user_care,$user_be_cared)
    {
        $sql="insert into user_care(user_care,user_be_cared) VALUES ('$user_care','$user_be_cared')";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }


    
    public function cancelCareUser($user_care,$user_be_cared)
    {
        $sql="DELETE FROM user_care WHERE user_care='$user_care' AND user_be_cared='$user_be_cared'";
        if ($this->_con!=null)
        {
            $query=mysqli_query($this->_con,$sql) or die(json_encode(array ('state'=>100)));
            return 200;
        }
    }

}
?>