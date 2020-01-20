<?php
/**
 * @var $id string
 * @var $rows array
 * @var $label string
 */

use yii\helpers\Html;

?>
<style>
    #<?= $id ?>.difWrapper .item {
        padding: 5px 0;
    }

    #<?= $id ?>.difWrapper .difFlexRow {
        display: -webkit-flex;
        display: flex;
        justify-content: space-between;
    }

    #<?= $id ?>.difWrapper .difLabels > input {
        border: 0;
        background: none;
        cursor: default;
        font-weight: bold;
    }

    #<?= $id ?>.difWrapper .add,
    #<?= $id ?>.difWrapper .delete {
        cursor: pointer;
        float: right;
        font-size: 24px;
        padding-right: 15px;
    }

    #<?= $id ?>.difWrapper .item:hover {
        background: #b9e6b9;
    }
</style>
<label class="control-label" for="columns"><?= $label ?></label>
<div id="<?= $id ?>" class="difWrapper">
    <?php
    foreach ($rows as $rowKey => $row) {
        if ($rowKey === 'labels') {
            echo '<div class="difLabels difFlexRow">';

            foreach ($row as $label) {
                echo Html::input(
                    'text',
                    '',
                    $label,
                    ['class' => 'form-control disabled', 'disabled' => 'disabled']
                );
            }

            echo '</div>';

            continue;
        }
        ?>
        <div class="item form-row difFlexRow">
            <?php
            foreach ($row['inputs'] as $index => $input) {
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
            }
            ?>
            <div class="delete">&times;</div>
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

    function difBindDelButtons() {
        $("#<?= $id ?> .delete").off('click');
        $("#<?= $id ?> .delete").click(function () {
            if ($("#<?= $id ?> .delete").length > 1) {
                $(this).closest('.item').remove();
            }
            else {
                $("#<?= $id ?> .delete").closest('.item').find('*').each(function () {
                    $(this).val('');
                });
            }
        });
    }

    difBindDelButtons();

    $("#<?= $id ?> .add").click(function () {
        lastItem = $("#<?= $id ?> > .item").last();
        lastItemClone = lastItem.clone();
        lastItemClone.find('input,textarea,select').val('');
        lastItem.after(lastItemClone);
        difBindDelButtons();
    });
</script>