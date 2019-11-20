<?php
/**
 * @var $id string
 * @var $rows array
 * @var $label string
 */

use yii\helpers\Html;

?>
<style>
    #<?= $id ?> .item {
        padding: 5px 0;
    }

    #<?= $id ?> .add,
    #<?= $id ?> .delete {
        cursor: pointer;
        float: right;
        font-size: 24px;
        padding-right: 15px;
    }

    #<?= $id ?> .item:hover {
        background: #b9e6b9;
    }

    #<?= $id ?> .difFlexContent {
        display: flex;
        justify-content: space-between;
        align-items: center;
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
        <div class="item form-row align-items-center difFlexContent">
            <?php
            foreach ($row['inputs'] as $index => $input) {
                $options = ['class' => 'form-control'];

                if (!empty($input['options'])) {
                    $options = $input['options'];
                }
//                echo '<div class="col-sm-3 my-1">';

                switch ($input['type']) {
                    case 'text':
                    default:
                        echo Html::input(
                            $input['type'],
                            $input['name'],
                            $input['value'],
                            $options
                        );
                        break;
                    case 'select':
                        echo Html::dropDownList(
                            $input['name'],
                            $input['value'],
                            $input['items'],
                            $options
                        );
                        break;
                }

//                echo '</div>';
            }
            ?>
<!--            <div class="clearfix"></div>-->
        </div>
        <?php
    }
    ?>
    <div class="form-row align-items-center">
        <div class='add'>+</div>
    </div>
</div>
<script>
    function difSetIndexes() {
        $("#<?= $id ?> > .item").each(function (index) {
            item = $(this);
            item.find('input,textarea,select').each(function () {
                input = $(this);
                inputName = input.attr('name');
                inputName = inputName.replace(':index', index);
                input.attr('name', inputName);
            });
        });
    }

    function difSetDelButtons() {
        $("#<?= $id ?> > .item").each(function (index) {
            $(this).find(".clearfix").before("<div class='delete'>&times;</div>");
        });
    }

    function difBindDelButtons() {
        $("#<?= $id ?> .delete").off('click');
        $("#<?= $id ?> .delete").click(function () {
            $(this).closest('.item').remove();
        });
    }

    difSetDelButtons();
    difBindDelButtons();

    $("#<?= $id ?> .add").click(function () {
        lastItem = $("#<?= $id ?> > .item").last();
        lastItemClone = lastItem.clone();
        lastItemClone.find('input,textarea,select').val('');
        lastItem.after(lastItemClone);
        difBindDelButtons();
    });
</script>