<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categoryevents */

$this->title = 'Update Categoryevents: ' . $model->category;
$this->params['breadcrumbs'][] = ['label' => 'Categoryevents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->category, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categoryevents-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
