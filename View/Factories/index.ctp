<?php
if (!isset($url)) {
    $url = array();
}
?>
<div id="FactoriesIndex">
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="FactoriesIndexTable">
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
            $i = 0;
            foreach ($items as $item) {
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr<?php echo $class; ?>>
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
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="FactoriesIndexPanel"></div>
</div>