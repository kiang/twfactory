<div id="FactoriesAdminEdit">
    <?php echo $this->Form->create('Factory', array('type' => 'file')); ?>
    <div class="Factories form">
        <fieldset>
            <legend><?php
                echo __('Edit 工廠', true);
                ?></legend>
            <?php
            echo $this->Form->input('Factory.id');
            echo $this->Form->input('Factory.name', array(
                'label' => '名稱',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Factory.license_no', array(
                'label' => '工廠設立許可案號',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Factory.address', array(
                'label' => '住址',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Factory.longitude', array(
                'label' => '經度',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Factory.latitude', array(
                'label' => '緯度',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Factory.cunli', array(
                'label' => '村里',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Factory.owner', array(
                'label' => '負責人',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Factory.company_id', array(
                'label' => '公司統編',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Factory.type', array(
                'label' => '類型',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Factory.date_approved', array(
                'label' => '審核日期',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Factory.date_registered', array(
                'label' => '登記日期',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Factory.status', array(
                'label' => '狀態',
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