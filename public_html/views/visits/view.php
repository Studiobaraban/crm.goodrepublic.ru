<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Visits */

$this->title = 'Завершить визит '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="visits-view">

	<h1><?= Html::encode($this->title) ?></h1>


	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
		'id',
		'user_id',
		'start',
		'end',
		'money',
		'type',
		],
	]) ?>

</div>
