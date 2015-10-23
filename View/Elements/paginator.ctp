<ul class="pagination">
    <?php
    if (!isset($url)) {
        $url = array();
    }
    $currentPage = isset($this->request->params['paging'][key($this->request->params['paging'])]['page']) ? $this->request->params['paging'][key($this->request->params['paging'])]['page'] : 1;
    if ($currentPage > 1) {
        echo $this->Paginator->prev('<span class="fui-arrow-left"></span> 上一頁', array('url' => $url, 'tag' => 'li', 'class' => 'previous', 'escape' => false));
    }
    echo $this->Paginator->numbers(array('url' => $url, 'tag' => 'li', 'separator' => '', 'currentTag' => 'a', 'currentClass' => 'active'));
    echo $this->Paginator->next('下一頁 <span class="fui-arrow-right"></span>', array('url' => $url, 'tag' => 'li', 'class' => 'next', 'escape' => false));
    ?>    
</ul>