<h1>게시판 목록</h1>
<p>
    현재 페이지: <?= $page; ?>/<?= $total; ?>
    | 
    페이지당 게시물 수: <?= $perPage; ?>
</p>

<table class="table table-hover">
<thead>
    <tr>
    <th scope="col">번호</th>
    <th scope="col">글쓴이</th>
    <th scope="col">제목</th>
    <th scope="col">등록일</th>
    </tr>
</thead>
<tbody>
    <?php 
        foreach($list as $ls){
    ?>
    <tr>
        <th scope="row"><?= $ls->bid ?></th>
        <td><?= $ls->userid ?></td>
        <td><a href="/boardView/<?= $ls->bid ?>"><?= $ls->subject ?></a></td>
        <td><?= $ls->regdate ?></td>
    </tr>
    <?php 
        }
    ?>
</tbody>
</table>
<hr>
<div class="pagination">
    <?= $pager_links ?>
</div>
<a href="/board/write">글쓰기</a>
  