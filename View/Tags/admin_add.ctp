<div id="TagsAdminAdd">
        <?php echo $this->Form->create('Tag', array('type' => 'file')); ?>
    <div class="Tags form">
        <fieldset>
            <legend><?php
                echo __('Add 標籤', true);
                ?></legend>
            <?php
            echo $this->Form->input('Tag.parent_id', array(
                'label' => '上',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Tag.name', array(
                'label' => '名稱',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Tag.lft', array(
                'label' => '左',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Tag.rght', array(
                'label' => '右',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            ?>
        </fieldset>
    </div>
        <?php
    echo $this->Form->end(__('Submit', true));
    ?>
</div>