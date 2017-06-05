<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Goods;
use app\models\Items;


/* @var $this yii\web\View */
/* @var $model app\models\Events */

// $this->title = 'Добавить ингредиент';
// $this->params['breadcrumbs'][] = ['label' => 'Ингредиенты', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>



<div class="col-xs-12 col-md-9">
	<h1>Добавить ингредиент в товар</h1>
</div>

<div class="col-xs-12 col-md-3">
	<p>Если не находите нужно ингредиента, создайте его</p>
	<a class="btn btn-primary" href="/items/create">+ Создать ингредиент</a>
</div>


<div class="clear"></div>

<?php
$form = ActiveForm::begin();

$goods = Goods::find()->all();
$good = ArrayHelper::map($goods,'id','name');
$params = [
'prompt' => 'Выберите...'
];
echo $form->field($model, 'good_id')->dropDownList($good,$params);


$items = Items::find()->all();
$item = ArrayHelper::map($items,'id','name');
$params = [
'prompt' => 'Выберите...'
];
echo $form->field($model, 'item_id')->dropDownList($item,$params);


echo $form->field($model, 'count')->textInput();

echo $form->field($model, 'info')->textarea(['rows' => 6]) ?>

<div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

