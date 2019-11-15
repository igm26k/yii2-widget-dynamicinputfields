<?php
/**
 * @var $id string
 * @var $rows array
 * @var $label string
 */

use yii\helpers\Html; ?>
<style>
    #<?= $id ?> .item {
        padding: 5px 0;
    }

    #<?= $id ?> .delete {
        cursor: pointer;
        float: right;
        font-size: 24px;
        padding-right: 15px;
    }

    #<?= $id ?> .item:hover {
        background: #b9e6b9;
    }
</style>
<label class="control-label" for="columns"><?= $label ?></label>
<div id="<?= $id ?>">
    <?php
    foreach ($rows as $rowKey => $row) {
        if ($rowKey === 'labels') {
            foreach ($row as $label) {
                echo "<label class='col-sm-3 my-1 control-label'>{$label}</label>";
            }

            echo '<div class="clearfix"></div>';

            continue;
        }
        ?>
        <div class="item form-row align-items-center">
            <?php
            foreach ($row['inputs'] as $index => $input) {
                echo '<div class="col-sm-3 my-1">';
                switch ($input['type']) {
                    case 'text':
                    default:
                        echo Html::input(
                            $input['type'],
                            $input['name'],
                            $input['value'],
                            ['class' => 'form-control']
                        );
                        break;
                    case 'select':
                        echo Html::dropDownList(
                            $input['name'],
                            $input['value'],
                            $input['items'],
                            ['class' => 'form-control']
                        );
                        break;
                }
                echo '</div>';
            }
            ?>
            <div class="clearfix"></div>
        </div>
        <?php
    }
    ?>
</div>
<script>
    $("#<?= $id ?> > .item").each(function () {
        ths = $(this);
        ths.find(".clearfix").before("<div class='delete'>&times;</div>");

    });
</script>