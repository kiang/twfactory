<div id="TagsAdminView">
    <h3><?php echo __('View 標籤', true); ?></h3><hr />
    <div class="col-md-12">

        <div class="col-md-2">上</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Tag']['parent_id']) {

                echo $this->data['Tag']['parent_id'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">名稱</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Tag']['name']) {

                echo $this->data['Tag']['name'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">左</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Tag']['lft']) {

                echo $this->data['Tag']['lft'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">右</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Tag']['rght']) {

                echo $this->data['Tag']['rght'];
            }
?>&nbsp;
        </div>
    </div>
    <hr />
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Tag.id')), null, __('Delete the item, sure?', true)); ?></li>
            <li><?php echo $this->Html->link(__('標籤 List', true), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('View Related 工廠', true), array('controller' => 'factories', 'action' => 'index', 'Tag', $this->data['Tag']['id']), array('class' => 'TagsAdminViewControl')); ?></li>
            <li><?php echo $this->Html->link(__('Set Related 工廠', true), array('controller' => 'factories', 'action' => 'index', 'Tag', $this->data['Tag']['id'], 'set'), array('class' => 'TagsAdminViewControl')); ?></li>
        </ul>
    </div>
    <div id="TagsAdminViewPanel"></div>
<?php
echo $this->Html->scriptBlock('

');
?>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('a.TagsAdminViewControl').click(function() {
                $('#TagsAdminViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>