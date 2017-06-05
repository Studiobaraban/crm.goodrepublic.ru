<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Categoryevents */

$this->title = 'Create Categoryevents';
$this->params['breadcrumbs'][] = ['label' => 'Categoryevents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoryevents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
