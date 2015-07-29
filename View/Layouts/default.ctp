<?php
if (!isset($cleanKeyword)) {
    $cleanKeyword = '';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-TW">
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
        echo $this->Html->meta('icon');
        echo $this->Html->css('jquery-ui');
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('default');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('jquery');
        echo $this->Html->script('jquery-ui');
        echo $this->Html->script('olc');
        echo $scripts_for_layout;
        ?>
    </head>
    <body>
        <div class="container">
            <div id="header">
                <h1><?php echo $this->Html->link('工廠公示資料查詢系統', '/'); ?></h1>
                <div class="pull-right">
                    <input type="text" id="keyword" value="<?php echo $cleanKeyword; ?>" />
                    <div class="btn-group">
                        <a href="#" class="btn btn-default btn-factory">找工廠</a>
                    </div>
                </div>
            </div>
            <div id="content">
                <?php echo $this->Session->flash(); ?>
                <div id="viewContent"><?php echo $content_for_layout; ?></div>
            </div>
            <div id="footer">
                <div class="btn-group">
                    <?php if ($this->Session->read('Auth.User.id')): ?>
                        <?php echo $this->Html->link('工廠', '/admin/factories', array('class' => 'btn')); ?>
                        <?php echo $this->Html->link('標籤', '/admin/tags', array('class' => 'btn')); ?>
                        <?php echo $this->Html->link('Members', '/admin/members', array('class' => 'btn')); ?>
                        <?php echo $this->Html->link('Groups', '/admin/groups', array('class' => 'btn')); ?>
                        <?php echo $this->Html->link('Logout', '/members/logout', array('class' => 'btn')); ?>
                    <?php else: ?>
                        <?php echo $this->Html->link('Login', '/members/login', array('class' => 'btn')); ?>
                    <?php endif; ?>
                    <?php
                    if (!empty($actions_for_layout)) {
                        foreach ($actions_for_layout as $title => $url) {
                            echo $this->Html->link($title, $url, array('class' => 'btn'));
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        echo $this->element('sql_dump');
        ?>
        <script type="text/javascript">
            //<![CDATA[
            $(function () {
                $('a.btn-factory').click(function () {
                    var keyword = $('input#keyword').val();
                    if (keyword !== '') {
<?php if ($this->params->params['action'] !== 'tag') { ?>
                            location.href = '<?php echo $this->Html->url('/factories/index/'); ?>' + encodeURIComponent(keyword);
<?php } else { ?>
                            location.href = '<?php echo $this->Html->url('/factories/tag/' . $tag['Tag']['id']); ?>/' + encodeURIComponent(keyword);
<?php } ?>
                    }
                    return false;
                });
            });
            //]]>
        </script>
    </body>
</html>