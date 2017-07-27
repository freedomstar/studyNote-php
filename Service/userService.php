<?php
include "../Dao/user_careDao.php";
include "../Dao/userDao.php";
include "../Model/modelFactory.php";
include "../Dao/noteDao.php";
include "../Dao/questionDao.php";
include "../Dao/answerDao.php";
/**
 * Created by PhpStorm.
 * User: huizai
 * Date: 2017/3/16
 * Time: 上午8:37
 */
class userService
{
    public function getUser($user_id,$loginUser)
    {
        $userDao=new userDao();
        $noteDao=new noteDao();
        $userCareDao=new user_CareDao();
        $questionDao=new questionDao();
        $answerDao=new answerDao();
        $user=modelFactory::getUserByUser_id($user_id,$userDao);
        $noteCount=$noteDao->getNotesCountByUserID($user_id);
        $careUsersCount=$userCareDao->getUserCareCOUNT($user_id);
        $fansCount=$userCareDao->getUserFansCOUNT($user_id);
        $questionCount=$questionDao->getUserQuestionCount($user_id);
        $answerCount=$answerDao->getUserAnswerCount($user_id);
        $isCare=$userCareDao->isCare($user_id,$loginUser);
        $userDao->release();
        $noteDao->release();
        $userCareDao->release();
        $questionDao->release();
        $answerDao->release();
        return array('isCare'=>$isCare,'answerCount'=>$answerCount,'questionCount'=>$questionCount,'fansCount'=>$fansCount,'careUsersCount'=>$careUsersCount,'noteCount'=>$noteCount,'username'=>$user->username,'email'=>$user->email,'password'=>$user->password,'create_time'=>$user->create_time,'user_id'=>$user->user_id,'school'=>$user->school,'sex'=>$user->sex,'education_id'=>$user->education_id,'avatar'=>$user->avatar,'introduction'=>$user->introduction);
    }

    public function updateUser($username,$user_id,$school,$sex,$education_id,$avatar,$introduction)
    {
        $userDao=new userDao();
        $result=$userDao->updateUser($username,$user_id,$school,$sex,$education_id,$avatar,$introduction) or die(200);
        $userDao->release();
        return $result;
    }

    public function updateUserPassword($newPassword, $user_id,$password)
    {
        $userDao = new userDao();
        $user=modelFactory::getUserByUser_id($user_id,$userDao);
        $oldPassword=$user->password;
        if ($oldPassword==$password)
        {
            $result = $userDao->updateUserPassword($newPassword, $user_id);
            $userDao->release();
            return $result;
        }
        else
        {
            $userDao->release();
            return 300;
        }

    }

    public function login($password,$email)
    {
        $userDao = new userDao();
        $user=modelFactory::getUserByEmail($email,$userDao);
        $oldPassword=$user->password;
        $data=array();
        if ($oldPassword==$password && $oldPassword!=null)
        {
            $userData=array();
            $userData['avatar']=$user->avatar;
            $userData['user_id']=$user->user_id;
            $userData['username']=$user->username;
            $userDao->release();
            $data['data']=$userData;
            $data['state']=200;
            return $data;
        }
        else
        {
            $data['state']=100;
            $userDao->release();
            return $data;
        }
    }

    public function register($email,$password,$education_id,$username)
    {
        $userDao = new userDao();
        $userDao->addUser($email,$password,$education_id,$username);
        $userDao->release();
        return 200;
    }

    public function getUserFans($user_id,$page)
    {
        $userList=array();
        $userCareDao=new user_CareDao();
        $list=$userCareDao->getUserFans($user_id,$page);
        $userDao=new userDao();
        $num = count($list);
        for($i=0;$i<$num;++$i){
            $user=$userDao->getUserByUser_id($list[$i]['user_care']);
            $userList[]=$user;
        }
        $userDao->release();
        $userCareDao->release();
        return $userList;
    }

    public function getCareUser($user_id,$page)
    {
        $userList=array();
        $userCareDao=new user_CareDao();
        $list=$userCareDao->getUserCare($user_id,$page);
        $userDao=new userDao();
        $num = count($list);
        for($i=0;$i<$num;++$i){
            $user=$userDao->getUserByUser_id($list[$i]['user_be_cared']);
            unset($user['password']);
            $userList[]=$user;
        }
        $userDao->release();
        $userCareDao->release();
        return $userList;
    }

    public function searchUser($key,$page)
    {
        $userDao=new userDao();
        $userList=$userDao->searchUser($key,$page);
        $userDao->release();
        return $userList;
    }

    public function careUser($user_care,$user_be_cared)
    {
        $userCareDao=new user_CareDao();
        $rs=$userCareDao->careUser($user_care,$user_be_cared);
        $userCareDao->release();
        return $rs;
    }

    public function cancelCareUser($user_care,$user_be_cared)
    {
        $userCareDao=new user_CareDao();
        $rs=$userCareDao->cancelCareUser($user_care,$user_be_cared);
        $userCareDao->release();
        return $rs;
    }

}
?>