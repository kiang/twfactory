<h1><?php echo $this->data['Factory']['name']; ?></h1>
<?php if (intval($this->data['Factory']['longitude']) != 0 && intval($this->data['Factory']['latitude']) != 0) { ?>
    <div id="map" style="width: 100%; height: 400px;"></div>
<?php } ?>
<div id="FactoriesView">
    <div class="col-md-12">
        <div class="col-md-2">工廠設立許可案號</div>
        <div class="col-md-9"><?php
            if ($this->data['Factory']['license_no']) {
                echo $this->data['Factory']['license_no'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">住址</div>
        <div class="col-md-9"><?php
            if ($this->data['Factory']['address']) {

                echo $this->data['Factory']['address'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">村里</div>
        <div class="col-md-9"><?php
            if ($this->data['Factory']['cunli']) {

                echo $this->data['Factory']['cunli'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">負責人</div>
        <div class="col-md-9"><?php
            if ($this->data['Factory']['owner']) {

                echo $this->data['Factory']['owner'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">公司統編</div>
        <div class="col-md-9"><?php
            if ($this->data['Factory']['company_id']) {

                echo $this->data['Factory']['company_id'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">類型</div>
        <div class="col-md-9"><?php
            if ($this->data['Factory']['type']) {

                echo $this->data['Factory']['type'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">審核日期</div>
        <div class="col-md-9"><?php
            if ($this->data['Factory']['date_approved']) {

                echo $this->data['Factory']['date_approved'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">登記日期</div>
        <div class="col-md-9"><?php
            if ($this->data['Factory']['date_registered']) {

                echo $this->data['Factory']['date_registered'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">狀態</div>
        <div class="col-md-9"><?php
            if ($this->data['Factory']['status']) {

                echo $this->data['Factory']['status'];
            }
            ?>&nbsp;
        </div>
    </div>
    
</div>

<?php if (!empty($nearPoints)) { ?>
    <p><br />&nbsp;</p><h1>附近工廠</h1>
    <?php
    foreach ($nearPoints AS $nearPoint) {
        ?><div class="col-md-4">
            <div class="box box-solid">
                <div class="box-header">
                    <i class="fa fa-medkit"></i>
                    <h3 class="box-title"><?php echo $this->Html->link($nearPoint['Factory']['name'], '/factories/view/' . $nearPoint['Factory']['id']); ?></h3>
                </div>
                <div class="box-body">
                    <i class="fa fa-home"></i> <?php echo $nearPoint['Factory']['address']; ?> (~<?php echo round($nearPoint['Factory']['distance'], 2); ?>km)
                </div>
            </div>
        </div><?php
    }
    ?>
    <div class="clearfix"></div>
<?php } ?>
<script>
    var factory = <?php echo json_encode($this->data['Factory']); ?>;
</script>
<?php
$this->Html->script('http://maps.google.com/maps/api/js?sensor=false', array('inline' => false));
$this->Html->script('c/factories/view', array('inline' => false));
