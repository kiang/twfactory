<h1><?php echo $factory['Factory']['name']; ?></h1>
<?php if (intval($factory['Factory']['longitude']) != 0 && intval($factory['Factory']['latitude']) != 0) { ?>
    <div id="map" style="width: 100%; height: 400px;"></div>
<?php } ?>
<p>&nbsp;</p>
<div id="FactoriesView">
    <dl class="dl-horizontal">
        <dt>工廠設立許可案號</dt>
        <dd><?php
            if ($factory['Factory']['license_no']) {
                echo $factory['Factory']['license_no'];
            }
            ?>&nbsp;
        </dd>
        <dt>住址</dt>
        <dd><?php
            if ($factory['Factory']['address']) {

                echo $factory['Factory']['address'];
            }
            ?>&nbsp;
        </dd>
        <dt>村里</dt>
        <dd><?php
            if ($factory['Factory']['cunli']) {

                echo $factory['Factory']['cunli'];
            }
            ?>&nbsp;
        </dd>
        <dt>負責人</dt>
        <dd><?php
            if ($factory['Factory']['owner']) {

                echo $factory['Factory']['owner'];
            }
            ?>&nbsp;
        </dd>
        <dt>公司統編</dt>
        <dd><?php
            if ($factory['Factory']['company_id']) {

                echo $factory['Factory']['company_id'];
            }
            ?>&nbsp;
        </dd>
        <dt>類型</dt>
        <dd><?php
            if ($factory['Factory']['type']) {

                echo $factory['Factory']['type'];
            }
            ?>&nbsp;
        </dd>
        <dt>審核日期</dt>
        <dd><?php
            if ($factory['Factory']['date_approved']) {

                echo $factory['Factory']['date_approved'];
            }
            ?>&nbsp;
        </dd>
        <dt>登記日期</dt>
        <dd><?php
            if ($factory['Factory']['date_registered']) {

                echo $factory['Factory']['date_registered'];
            }
            ?>&nbsp;
        </dd>
        <dt>狀態</dt>
        <dd><?php
            if ($factory['Factory']['status']) {

                echo $factory['Factory']['status'];
            }
            ?>&nbsp;
        </dd>
    </dl>
</div>

<?php if (!empty($factory['Tag'])) { ?>
    <p>&nbsp;</p>
    <h2>分類</h2>
    <hr>
    <?php
    foreach ($factory['Tag'] AS $tag) {
        echo '<ol class="breadcrumb" style="display: inline-block">';
        foreach ($tagNames[$tag['id']] AS $item) {
            echo $this->Html->tag(
                'li',
                $this->Html->link($item['Tag']['name'], '/factories/tag/' . $item['Tag']['id'])
            );
        }
        echo '</ol>';
        echo '<br>';
    }
    ?>
<?php } ?>

<?php if (!empty($nearPoints)) { ?>
    <p>&nbsp;</p>
    <h2>附近工廠</h2>
    <hr>
    <?php
    $pointsCount = 0;
    foreach ($nearPoints AS $nearPoint) {
        ++$pointsCount;
    ?>
        <div class="col-md-4">
            <h3>
                <span class="glyphicon glyphicon-briefcase text-muted"></span>
                <?php echo $this->Html->link($nearPoint['Factory']['name'], '/factories/view/' . $nearPoint['Factory']['id']); ?>
            </h3>
            <div class="text-ellipsis text-muted" title="<?php echo $nearPoint['Factory']['address']; ?>">
                (~<?php echo round($nearPoint['Factory']['distance'], 2); ?>公里)&nbsp;<?php echo $nearPoint['Factory']['address']; ?>
            </div>
        </div>
        <?php
            if ($pointsCount === 3) {
                echo '<div class="clearfix"></div>';
                $pointsCount = 0;
            }
        }
        ?>
<?php } ?>
<script>
    var factory = <?php echo json_encode($factory['Factory']); ?>;
</script>
<?php
$this->Html->script('https://maps.google.com/maps/api/js?sensor=false', array('inline' => false));
$this->Html->script('c/factories/view', array('inline' => false));
