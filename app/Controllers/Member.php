<?php
namespace App\Controllers;
use App\Models\MemberModel;

class Member extends BaseController
{
    public function login() 
    {
        return render('login');
    } 
    public function logout() 
    {
        $this->session->destroy();
        return redirect()->to('/board');
    } 
    public function loginok() 
    {
        $db = db_connect();
        $userid=$this->request->getVar('userid');
        $passwd=hash('sha512',$this->request->getVar('passwd'));

        $sql="SELECT * FROM members WHERE userid=? AND passwd = ?";
        $rs = $db->query($sql, [$userid, $passwd]);
        if($rs->getNumRows() > 0) {
            $user = $rs->getRow();
            $data = [
                'userid' => $user->userid,
                'username' => $user->username,
                'email' => $user->email,
            ];
            
            $this->session->set($data);
            return redirect()->to('/board');
        } else{
            return redirect()->to('/login');
        }
    } 
}
