<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row post-view">
    <div class="col-12 col-md-8">

        <h1><?= Html::encode($this->title) ?></h1>

        <p class="text-muted"><?=Yii::$app->formatter->asRelativeTime($model->created_at)?> - <?=$model->createdBy->username?></p>
        <?php
        if($model->preview_image) {
            echo '<img src="'.Yii::$app->params['frontendUrl'].'/storage/previews/'.$model->preview_image.'" class="ratio ratio-16x9 mb-3">';
        }
        ?>
        <p><?=$model->bodytext?></p>

    </div>

    <?php echo $this->render('../layouts/_sidebar')?>
</div>
