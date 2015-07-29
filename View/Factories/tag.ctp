<?php
if (!isset($url)) {
    $url = array();
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo $tag['Tag']['name']; ?></h1>
    <ol class="breadcrumb">
        <?php
        foreach ($parents AS $parent) {
            echo '<li>' . $this->Html->link($parent['Tag']['name'], '/factories/tag/' . $parent['Tag']['id']) . '</li>';
        }
        ?>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div>
        <?php
        if (!empty($children)) {
            echo '<h4>子分類</h4>';
            foreach ($children AS $child) {
                echo $this->Html->link($child['Tag']['name'], '/factories/tag/' . $child['Tag']['id'], array('class' => 'btn btn-default'));
            }
            echo '<div class="clearfix"><br /></div>';
        }
        ?>
    </div>
    <div id="FactoriesIndex" class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <?php echo $this->element('paginator'); ?>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="FactoriesIndexTable">
                        <thead>
                            <tr>
                                <th>名稱</th>
                                <th>住址</th>
                                <th>負責人</th>
                                <th>公司統編</th>
                                <th><?php echo $this->Paginator->sort('Factory.date_approved', '審核日期', array('url' => $url)); ?></th>
                                <th><?php echo $this->Paginator->sort('Factory.date_registered', '登記日期', array('url' => $url)); ?></th>
                                <th>狀態</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($items as $item) {
                                ?>
                                <tr>
                                    <td><?php echo $this->Html->link($item['Factory']['name'], array('action' => 'view', $item['Factory']['id'])); ?></td>
                                    <td><?php echo $item['Factory']['address']; ?></td>
                                    <td><?php echo $item['Factory']['owner']; ?></td>
                                    <td><?php echo $item['Factory']['company_id']; ?></td>
                                    <td><?php echo $item['Factory']['date_approved']; ?></td>
                                    <td><?php echo $item['Factory']['date_registered']; ?></td>
                                    <td><?php echo $item['Factory']['status']; ?></td>
                                </tr>
                            <?php }; // End of foreach ($items as $item) {  ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <?php echo $this->element('paginator'); ?>
                </div>
            </div>
        </div>
        <div id="FactoriesIndexPanel"></div>
    </div>
</section><!-- /.content -->