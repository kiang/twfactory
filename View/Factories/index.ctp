<div id="FactoriesIndex">
    <h2><?php echo __('工廠', true); ?></h2>
    <div class="clear actions">
        <ul>
        </ul>
    </div>
    <p>
        <?php
        $url = array();

        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></p>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="FactoriesIndexTable">
        <thead>
            <tr>

                <th><?php echo $this->Paginator->sort('Factory.name', '名稱', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Factory.license_no', '工廠設立許可案號', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Factory.address', '住址', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Factory.longitude', '經度', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Factory.latitude', '緯度', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Factory.cunli', '村里', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Factory.owner', '負責人', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Factory.company_id', '公司統編', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Factory.type', '類型', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Factory.date_approved', '審核日期', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Factory.date_registered', '登記日期', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Factory.status', '狀態', array('url' => $url)); ?></th>
                <th class="actions"><?php echo __('Action', true); ?></th>
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

                    <td><?php
                    echo $item['Factory']['name'];
                    ?></td>
                    <td><?php
                    echo $item['Factory']['license_no'];
                    ?></td>
                    <td><?php
                    echo $item['Factory']['address'];
                    ?></td>
                    <td><?php
                    echo $item['Factory']['longitude'];
                    ?></td>
                    <td><?php
                    echo $item['Factory']['latitude'];
                    ?></td>
                    <td><?php
                    echo $item['Factory']['cunli'];
                    ?></td>
                    <td><?php
                    echo $item['Factory']['owner'];
                    ?></td>
                    <td><?php
                    echo $item['Factory']['company_id'];
                    ?></td>
                    <td><?php
                    echo $item['Factory']['type'];
                    ?></td>
                    <td><?php
                    echo $item['Factory']['date_approved'];
                    ?></td>
                    <td><?php
                    echo $item['Factory']['date_registered'];
                    ?></td>
                    <td><?php
                    echo $item['Factory']['status'];
                    ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Factory']['id']), array('class' => 'FactoriesIndexControl')); ?>
                    </td>
                </tr>
            <?php }; // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="FactoriesIndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#FactoriesIndexTable th a, div.paging a, a.FactoriesIndexControl').click(function() {
                $('#FactoriesIndex').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>