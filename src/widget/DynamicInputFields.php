<?php

namespace app\widgets;

use yii\base\Widget;

/**
 * Class DynamicInputFields
 *
 * @package app\widgets
 *
 * @property $id string
 * @property $inputs array
 */
class DynamicInputFields extends Widget
{
    public $id    = 'czContainer';
    public $rows  = [];
    public $label = '';

    /**
     * @return string
     */
    public function run()
    {
        return $this->render('dynamic-input-fields', [
            'label' => $this->label,
            'id'    => $this->id,
            'rows'  => $this->rows,
        ]);
    }
}