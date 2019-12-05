<?php

use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\ListView;

/* @var $this View */
/* @var $dataProvider ActiveDataProvider */
$this->title = 'Акции';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="page-specials">
    <h1><?= $this->title ?></h1>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemView' => '_view',
        'itemOptions' => [
            'class' => 'specials-item',
        ],
        'options' => [
            'class' => 'specials',
        ],
        'pager' => [
            'class' => 'justinvoelker\separatedpager\LinkPager',
        ]
    ]) ?>
</div>
