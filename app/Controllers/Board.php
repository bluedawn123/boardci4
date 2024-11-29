<?php
namespace App\Controllers;
use App\Models\BoardModel;
use App\Models\FileModel;
use CodeIgniter\Pager\Pager;


class Board extends BaseController
{
    public function list(): string
    {
        /*
        $db = db_connect();
        $sql = "SELECT * FROM board ORDER BY bid DESC";
        $result = $db->query($sql);        
        $data['list'] = $result->getResult();//조회결과를 data에 할당
        */
        $boardModel = new BoardModel();
        $page = $this->request->getVar('page') ?? 1;
        $perPage = 10;
        $startLimit = ($page -1) * $perPage;

        $query = $boardModel->select('board.*')
            ->where('1=1')
            ->orderBy('bid','desc')
            ->limit($perPage, $startLimit)
            ->findAll($perPage, $startLimit);

        $total = $boardModel->countAllResults(); //전체 게시글 수

        $pager = service('pager'); //페이지네이션 초기화

        $pager_links = $pager->makeLinks($page, $perPage, $total,'my-pagination');

        $data = [
            'list' => $query,
            'total' => $total,
            'page'=> $page,
            'perPage'=>$perPage,
            'pager_links' => $pager_links,
        ];
        //$data['pager_links'] = $pager_links;
        // $data['list'] = $boardModel->orderBy('bid', 'desc')->findAll();

        // return view('board_list');
        return render('board_list',$data);        
    }
    public function view($bid=null): string
    { 
        $boardModel = new BoardModel();
        $fileModel = new FileModel();

        /*
        $data['view'] = $boardModel->where('bid', $bid)->first();

        $data['file_view'] = $fileModel->where('type', 'board')->where('bid', $bid)->first();
        */
        $data['view'] = $boardModel->select('b.*,group_concat(DISTINCT f.filename) as fs')
                                ->from('board b')
                                ->join('file_table f', 'f.bid=b.bid', 'left')
                                ->where('b.bid',$bid)
                                ->first();
 
        return render('board_view',$data);        
    }
    public function modify($bid=null): string
    {  
  
        $boardModel = new BoardModel();
        $post = $boardModel->find($bid);

        if($post && session('userid') == $post->userid){
            $data['view'] = $post;
            return render('board_write',$data);        
        } else{
            return redirect()->to('/login')->with('alert', '본인글만 수정할 수 있습니다.');
        }
 
    }
    public function delete($bid=null)
    {    
        $boardModel = new BoardModel();
        $fileModel = new FileModel();

        $post = $boardModel->find($bid);

        if($post && session('userid') == $post->userid){

            $boardModel->delete($bid);  

            $files = $fileModel->where('type','board')->where('bid',$bid)->findAll();
            foreach($files as $file){
                unlink('uploads/'.$file->filename);
            }     
            $fileModel->where('type','board')->where('bid',$bid)->delete();        

            return redirect()->to('/board');
        } else{
            return redirect()->to('/login')->with('alert', '본인글만 삭제할 수 있습니다.');
        }
 
    }
    public function write()
    {
        if(!isset($_SESSION['userid'])){
            return redirect()->to('/login')->with('alert', '로그인해주세요');
        }    
        // return view('board_write');
        return render('board_write');
    }
    public function save()
    {
        $boardModel = new BoardModel();
        $fileModel = new FileModel();

        $data = [
            // 'userid' => 'admin',
            'userid' => $_SESSION['userid'],
            'subject'    => $this->request->getVar('subject'),
            'content'    => $this->request->getVar('content')
        ];
        $bid = $this->request->getVar('bid');
        // $file = $this->request->getFile('upfile');
        $files = $this->request->getFileMultiple('upfile');
        $filePath = array();

        $db = db_connect();

        foreach($files as $file){

            if($file->getName()) { //첨부파일이 있으면
                // $filename = $file->getName(); //파일명
                $newName = $file->getRandomName();//서버에 저장할 파일명 생성
                $filePath[] = $file->store('board/',$newName);
            }
        }


        if($bid){ //기존글 수정
            $post = $boardModel->find($bid);
            if($post && session('userid') == $post->userid){
                $boardModel->update($bid, $data);
                return $this->response->redirect(site_url('/boardView/'.$bid));     
            } else{
                return redirect()->to('/login')->with('alert', '본인글만 수정할 수 있습니다.');
            }
            

        }else{ //새글 입력
            $boardModel->insert($data);
            $insertId = $db->insertID(); //board 테이블에 새글 입력시 자동으로 생성되는 bid


            foreach($filePath as $fp){
                $fileData = [
                    // 'userid' => 'admin',
                    'bid' => $insertId,
                    'userid' => $_SESSION['userid'],
                    'filename'    => $fp,
                    'type'    => 'board'
                ];
                $fileModel->insert($fileData);
            }


            return $this->response->redirect(site_url('/board'));
        }

    } 
}
