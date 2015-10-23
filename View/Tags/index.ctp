<div id="TagsIndex">
    <h2><?php echo __('標籤', true); ?></h2>
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
    <div class="paginator-wrapper"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="TagsIndexTable">
        <thead>
            <tr>

                <th><?php echo $this->Paginator->sort('Tag.parent_id', '上', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Tag.name', '名稱', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Tag.lft', '左', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Tag.rght', '右', array('url' => $url)); ?></th>
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
                    echo $item['Tag']['parent_id'];
                    ?></td>
                    <td><?php
                    echo $item['Tag']['name'];
                    ?></td>
                    <td><?php
                    echo $item['Tag']['lft'];
                    ?></td>
                    <td><?php
                    echo $item['Tag']['rght'];
                    ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Tag']['id']), array('class' => 'TagsIndexControl')); ?>
                    </td>
                </tr>
            <?php }; // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paginator-wrapper"><?php echo $this->element('paginator'); ?></div>
    <div id="TagsIndexPanel"></div>
    <script>
        $(function() {
            $('#TagsIndexTable th a, div.paging a, a.TagsIndexControl').on('click', function (e) {
                $('#TagsIndex').parent().load(this.href);
                e.preventDafault();
            });
        });
    </script>
</div>