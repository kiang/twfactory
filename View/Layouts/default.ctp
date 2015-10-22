<?php
if (!isset($cleanKeyword)) {
    $cleanKeyword = '';
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?>工廠公示資料查詢</title><?php
        $trailDesc = '提供簡單的介面檢索國內有登記立案的工廠';
        if (!isset($desc_for_layout)) {
            $desc_for_layout = $trailDesc;
        } else {
            $desc_for_layout .= $trailDesc;
        }
        echo $this->Html->meta('description', $desc_for_layout);
        echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'));
        echo $this->Html->meta('icon');
        echo $this->Html->css('jquery-ui');
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('default');
        ?>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php echo $this->Html->link('工廠公示資料查詢系統', '/', array('class' => 'navbar-brand')); ?>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="./">首頁</a></li>
                    </ul>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input type="text" id="keyword" class="form-control" placeholder="搜尋…" value="<?php echo $cleanKeyword; ?>" autofocus>
                        </div>
                        <button type="submit" class="btn btn-info btn-factory">找工廠</button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="container">
            <div id="content" class="row">
                <div class="col-md-12">
                    <?php echo $this->Session->flash(); ?>
                    <div id="viewContent"><?php echo $content_for_layout; ?></div>
                </div>
            </div>
            <p>&nbsp;</p>
            <div id="footer" class="row">
                <div class="col-md-12">
                    <div class="btn-group pull-right">
                        <?php if ($this->Session->read('Auth.User.id')): ?>
                            <?php echo $this->Html->link('工廠', '/admin/factories', array('class' => 'btn btn-default')); ?>
                            <?php echo $this->Html->link('標籤', '/admin/tags', array('class' => 'btn btn-default')); ?>
                            <?php echo $this->Html->link('Members', '/admin/members', array('class' => 'btn btn-default')); ?>
                            <?php echo $this->Html->link('Groups', '/admin/groups', array('class' => 'btn btn-default')); ?>
                            <?php echo $this->Html->link('Logout', '/members/logout', array('class' => 'btn btn-default')); ?>
                        <?php else: ?>
                            <?php echo $this->Html->link('Login', '/members/login', array('class' => 'btn btn-default')); ?>
                        <?php endif; ?>
                        <?php
                        if (!empty($actions_for_layout)) {
                            foreach ($actions_for_layout as $title => $url) {
                                echo $this->Html->link($title, $url, array('class' => 'btn btn-default'));
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo $this->Html->script('jquery');
        echo $this->Html->script('jquery-ui');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('olc');
        echo $scripts_for_layout;
        ?>
        <script>
            $(function () {
                $('form').on('submit', function (e) {
                    var keyword = $('#keyword').val();
                    if (keyword !== '') {
                    <?php if ($this->params->params['action'] !== 'tag') { ?>
                            location.href = '<?php echo $this->Html->url('/factories/index/'); ?>' + encodeURIComponent(keyword);
                    <?php } else { ?>
                            location.href = '<?php echo $this->Html->url('/factories/tag/' . $tag['Tag']['id']); ?>/' + encodeURIComponent(keyword);
                    <?php } ?>
                    } else {
                        $('.navbar-form .btn-factory').removeClass('btn-info').addClass('btn-danger');
                        $('.navbar-form .form-group').addClass('has-error').one('keydown change', function () {
                            $(this).removeClass('has-error');
                            $('.navbar-form .btn-factory').removeClass('btn-danger').addClass('btn-info');
                        });
                    }
                    e.preventDefault();
                });
            });
        </script>
    </body>
</html>