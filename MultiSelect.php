<?php

namespace totocsa;

use Yii;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\ButtonGroup;
use totocsa\MultiSelectAsset;

class MultiSelect extends \yii\bootstrap4\ButtonDropdown {

    public $formConfig = [
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ];
    public $model;
    public $attribute;
    public $items = [];
    public $fieldTemplate = "{input}\n{hint}\n{error}";
    public $buttonGroup = false;
    public $checkboxListOptions = [
        'encode' => false,
        'itemOptions' => [
            'class' => 'custom-control-input multiselect-filter',
        ],
    ];
    public $allButton = [
        'label' => 'All',
        'options' => [
            'class' => 'btn btn-success btn-sm multiselect-all',
        ],
    ];
    public $noneButton = [
        'label' => 'None',
        'options' => [
            'class' => 'btn btn-danger btn-sm multiselect-none',
        ],
    ];
    public $applyButton = [
        'label' => 'Apply',
        'options' => [
            'class' => 'btn btn-primary btn-sm multiselect-apply',
        ],
    ];
    public $closeButton = [
        'label' => 'Close',
        'options' => [
            'class' => 'btn btn-secondary btn-sm multiselect-close',
        ],
    ];

    public function run() {
        $view = $this->getView();

        if (YII_DEBUG) {
            $forceCopy = Yii::$app->assetManager->forceCopy;
            Yii::$app->assetManager->forceCopy = true;
            MultiSelectAsset::register($view);
            Yii::$app->assetManager->forceCopy = $forceCopy;
        } else {
            MultiSelectAsset::register($view);
        }

        $content = $this->renderContent();
        $this->dropdown = [
            'items' => [
                [
                    'label' => $content,
                    'encode' => false,
                ],
        ]];

        return parent::run();
    }

    public function renderContent() {
        Html::addCssClass($this->options, ['multiselect']);

        $form = new ActiveForm($this->formConfig);

        $field = $form->field($this->model, $this->attribute);
        $field->template = $this->fieldTemplate;

        $content = '<div class="buttons">'
                . $this->renderButtons()
                . '</div>'
                . '<div class="items">'
                . $field->checkboxList($this->items, $this->checkboxListOptions)
                . '</div>';

        return $content;
    }

    public function renderButtons() {
        if ($this->buttonGroup) {
            return ButtonGroup::widget([
                        'buttons' => [
                            $this->allButton,
                            $this->noneButton,
                            $this->applyButton,
                            $this->closeButton,
                        ],
            ]);
        } else {
            return Html::button($this->allButton['label'], $this->allButton['options'])
                    . Html::button($this->noneButton['label'], $this->noneButton['options'])
                    . Html::button($this->applyButton['label'], $this->applyButton['options'])
                    . Html::button($this->closeButton['label'], $this->closeButton['options']);
        }
    }

}
