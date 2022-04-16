<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-12 col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'bodytext')->textarea(['rows' => 6]) ?>
        </div>

        <div class="col-12 col-md-6">

            <?= $form->field($model, 'status')->dropDownList($model->getStatusLabels()) ?>

            <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(\common\models\Category::find()->asArray()->all(), 'id', 'name')) ?>

            <?= $form->field($model, 'previewImage')->fileInput() ?>

            <?= $form->field($model, 'featured')->checkbox() ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>
