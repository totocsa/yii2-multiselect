<?php

namespace totocsa;

use Yii;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
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
    public $checkboxListOptions = [
        'encode' => false,
        'itemOptions' => [
            'class' => 'custom-control-input multiselect-filter',
        ],
    ];
    public $allButton = [
        'content' => 'All',
        'options' => [
            'class' => 'btn btn-success btn-sm multiselect-all',
        ],
    ];
    public $noneButton = [
        'content' => 'None',
        'options' => [
            'class' => 'btn btn-danger btn-sm multiselect-none',
        ],
    ];
    public $applyButton = [
        'content' => 'Apply',
        'options' => [
            'class' => 'btn btn-primary btn-sm multiselect-apply',
        ],
    ];
    public $closeButton = [
        'content' => 'Close',
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
                . Html::button($this->allButton['content'], $this->allButton['options'])
                . Html::button($this->noneButton['content'], $this->noneButton['options'])
                . Html::button($this->applyButton['content'], $this->applyButton['options'])
                . Html::button($this->closeButton['content'], $this->closeButton['options'])
                . '</div>'
                . '<div class="items">'
                . $field->checkboxList($this->items, $this->checkboxListOptions)
                . '</div>';

        return $content;
    }

}

/*
  use yii\bootstrap4\ButtonGroup;
  ButtonGroup::widget([
                  'buttons' => [
                  [
                  'label' => 'All',
                  'options' => [
                  'class' => 'btn btn-new btn-sm multiselect-all',
                  ]
                  ],
                  [
                  'label' => 'None',
                  'options' => [
                  'class' => 'btn btn-delete btn-sm multiselect-none',
                  ],
                  ],
                  [
                  'label' => 'Set',
                  'options' => [
                  'class' => 'btn btn-sm btn-index multiselect-set',
                  ],
                  ],
                  [
                  'label' => 'Close',
                  'options' => [
                  'class' => 'btn btn-close btn-sm multiselect-close',
                  ],
                  ],
                  ],
                  ]) */