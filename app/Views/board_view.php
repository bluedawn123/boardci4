<h1>글 상세</h1>
<?php
  print_r($view);
?>
<article>
  <h3><?= $view->subject; ?></h3>
  <p>작성일: <?= $view->regdate; ?> / 작성자: <?= $view->userid; ?></p>
  <h4>본문</h4>
  <p>
  <?= $view->content; ?>
  </p>
  <?php
    if(isset($view->fs)){
      $fsArr = explode(',',$view->fs);
      foreach($fsArr as $img){      
  ?> 
    <img src="<?php echo base_url('/uploads/'.$img); ?>" width="100%" alt="">
  <?php   
    }
   }
  ?>
</article>
<hr>
<div class="controls">
  <?php
    //if(isset($_SESSION['userid']))
    if(session('userid') === $view->userid){
  ?>  
  <a href="/modify/<?= $view->bid; ?>" class="btn btn-secondary sm">수정</a>
  <a href="/delete/<?= $view->bid; ?>" class="btn btn-danger sm">삭제</a>
  <?php
    }
  ?>
</div>
<a href="/board/">목록</a>
<a href="/board/write">글쓰기</a>
  