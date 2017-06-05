<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Persons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persons-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'second_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'birthday')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'group')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'sex')->dropDownList([
		'0' => 'женский',
		'1' => 'мужской',
	]); ?>

	<?= $form->field($model, 'status') ?>
	<?= $form->field($model, 'discount') ?>
	<?= $form->field($model, 'vishes') ?>
	<?= $form->field($model, 'froms')->dropDownList([
		'1' => 'КудаГо',
		'2' => 'Сайт ХР',
		'3' => 'СоцСети',
		'4' => 'Друзья',
		'5' => 'Другое',
		]); ?>
	<?= $form->field($model, 'sendmail')->dropDownList([
		'0' => 'Нет',
		'1' => 'Да'
	]); ?>
	<?= $form->field($model, 'info') ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
