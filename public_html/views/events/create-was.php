<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use nex\datepicker\DatePicker;
use app\models\Biblioevents;


/* @var $this yii\web\View */
/* @var $model app\models\Events */

$this->title = 'Добавить Дату';
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



	<h1>Добавить Дату</h1>

	<?php
	$form = ActiveForm::begin();
// получаем библиотеку
	$biblioevents = Biblioevents::find()->all();
// формируем массив, с ключем равным полю 'id' и значением равным полю 'name' 
	$items = ArrayHelper::map($biblioevents,'id','name');
	$params = [
		'prompt' => 'Выберите из библиотеки...'
	];
	echo $form->field($model, 'event_id')->dropDownList($items,$params);

	echo $form->field($model, 'date')->textInput();

	//echo DatePicker::widget([
		'model' => $model,
		'attribute' => 'date',
		'language' => 'ru',
		'size' => 'lg',
		'readonly' => false,
		'placeholder' => 'Выберите дату',
		'clientOptions' => [
			'format' => 'L LT',
			//'minDate' => '2015-08-10',
			//'maxDate' => '2015-09-10',
		],
		'clientEvents' => [
			'dp.show' => new \yii\web\JsExpression("function () { console.log('It works!'); }"),
		],
	]);

	echo $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
