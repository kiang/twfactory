<div id="FactoriesAdminView">
    <h3><?php echo __('View 工廠', true); ?></h3><hr />
    <div class="col-md-12">

        <div class="col-md-2">名稱</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Factory']['name']) {

                echo $this->data['Factory']['name'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">工廠設立許可案號</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Factory']['license_no']) {

                echo $this->data['Factory']['license_no'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">住址</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Factory']['address']) {

                echo $this->data['Factory']['address'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">經度</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Factory']['longitude']) {

                echo $this->data['Factory']['longitude'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">緯度</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Factory']['latitude']) {

                echo $this->data['Factory']['latitude'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">村里</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Factory']['cunli']) {

                echo $this->data['Factory']['cunli'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">負責人</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Factory']['owner']) {

                echo $this->data['Factory']['owner'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">公司統編</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Factory']['company_id']) {

                echo $this->data['Factory']['company_id'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">類型</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Factory']['type']) {

                echo $this->data['Factory']['type'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">審核日期</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Factory']['date_approved']) {

                echo $this->data['Factory']['date_approved'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">登記日期</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Factory']['date_registered']) {

                echo $this->data['Factory']['date_registered'];
            }
?>&nbsp;
        </div>
        <div class="col-md-2">狀態</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Factory']['status']) {

                echo $this->data['Factory']['status'];
            }
?>&nbsp;
        </div>
    </div>
    <hr />
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Factory.id')), null, __('Delete the item, sure?', true)); ?></li>
            <li><?php echo $this->Html->link(__('工廠 List', true), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('View Related 標籤', true), array('controller' => 'tags', 'action' => 'index', 'Factory', $this->data['Factory']['id']), array('class' => 'FactoriesAdminViewControl')); ?></li>
            <li><?php echo $this->Html->link(__('Set Related 標籤', true), array('controller' => 'tags', 'action' => 'index', 'Factory', $this->data['Factory']['id'], 'set'), array('class' => 'FactoriesAdminViewControl')); ?></li>
        </ul>
    </div>
    <div id="FactoriesAdminViewPanel"></div>
<?php
echo $this->Html->scriptBlock('

');
?>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('a.FactoriesAdminViewControl').click(function() {
                $('#FactoriesAdminViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>