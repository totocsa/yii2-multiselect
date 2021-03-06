Multiselect for grid view
=========================
Multiselect for grid view with Bootstrap 4

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist totocsa/yii2-multiselect "dev-master"
```

or add

```
"totocsa/yii2-multiselect": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

In the grid view:
```php
[
    'attribute' => 'statusid',
    'value' => function($model, $key, $index, $column) {
        /* @var $model app\models\Human */
        return $model->status->name;
    },
    'filter' => MultiSelect::widget([
        'model' => $searchModel,
        'attribute' => 'statusid',
        'items' => ArrayHelper::map(Status::find()
                        ->orderBy(['name' => SORT_ASC])
                        ->all(), 'id', 'name'),
    ]),
],
```

In the Search file:
```php
public function init() {
    parent::init();

    $this->statusid = ArrayHelper::getColumn(Status::find()
                            ->orderBy(['name' => SORT_ASC])
                            ->all(), 'id');
}

public function rules() {
    return [
    ...
        [['statusid', 'vehicleid', 'operatingsystemid'], 'each', 'rule' => ['integer']],
    ...
    ];
}

public function search($params) {
...
    if (is_array($this->statusid)) {
        if (count($this->statusid) > 0) {
            $query->andFilterWhere(['in', 'human.statusid', $this->statusid]);
        } else {
            $query->andWhere('false');
        }
    } else {
        $query->andWhere('false');
    }
....
}
```