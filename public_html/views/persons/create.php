<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Persons */

$this->title = 'Добавить Гостя';
$this->params['breadcrumbs'][] = ['label' => 'Persons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="persons-create">


	<h1><?= Html::encode($this->title) ?></h1>


	<?php $form = ActiveForm::begin([
		'layout'=>'horizontal',
		'options' => ['class' => 'form-horizontal'],
	]) ?>

	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<?= $form->field($model, 'second_name') ?>
			<?= $form->field($model, 'name') ?>
			<?= $form->field($model, 'middle_name') ?>
			<?= $form->field($model, 'phone') ?>
			<?= $form->field($model, 'mail') ?>
			<?= $form->field($model, 'birthday') ?>
			<?= $form->field($model, 'sex')->dropDownList([
				'0' => 'женский',
				'1' => 'мужской',
			]); ?>
		</div>
		<div class="col-xs-12 col-sm-6">
			<?= $form->field($model, 'group') ?>
			<?= $form->field($model, 'status') ?>
			<?= $form->field($model, 'discount') ?>
			<?= $form->field($model, 'vishes') ?>
			<?= $form->field($model, 'froms')->dropDownList([
				'1' => 'КудаГо',
				'2' => 'Сайт ХР',
				'4' => 'Друзья',
				'5' => 'Другое',
				'6' => 'Листовки',
				'7' => 'Морейнис',
				'8' => 'Событие',
				'9' => 'Джаз',
				'10' => 'Концерт',
				'11' => 'Вконтакте',
				'12' => 'FaceBook',
				'13' => 'instagram',
				'3' => 'СоцСети(не помню точно какая)',
				'14' => 'Проходили мимо',
			]); ?>
			<?= $form->field($model, 'sendmail')->dropDownList([
				'0' => 'Нет',
				'1' => 'Да'
			]); ?>
			<?= $form->field($model, 'info') ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-xs-12 col-md-2 col-md-offset-4">
			<?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
		</div>
		<div class="col-xs-12 col-md-2">
			<?= Html::submitButton('Создать и начать визит', ['class' => 'btn btn-primary', 'formaction' => '/persons/createbegin']) ?>
		</div>
	</div>

	<?php ActiveForm::end() ?>




</div>



