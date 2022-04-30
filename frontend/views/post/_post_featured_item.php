<?php
/** @var \common\models\Post $model */

use yii\helpers\Url;

$previewImage = Yii::$app->params['frontendUrl'].'/storage/previews/'.$model->preview_image;

?>
<div class="col-md-6 mb-4">
    <div class="row g-0 border rounded overflow-hidden flex-md-row shadow-sm h-100 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary"><?=$model->category->name?></strong>
            <h2 class="h4 mb-0 two-lines-title"><?=$model->title?></h2>
            <div class="mb-1 text-muted"><?=Yii::$app->formatter->asDate($model->created_at, 'medium')?></div>
            <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
            <a href="<?= Url::to(['post/view', 'slug' => $model->slug])?>" class="stretched-link">Continue reading</a>
        </div>
        <?php if ($model->preview_image) {?>
            <div class="col-lg-4 d-none d-lg-flex justify-content-center overflow-hidden p-0 shadow-lg">
                <img style="max-height:250px" src="<?=$previewImage?>">
            </div>
        <?php } ?>
    </div>
</div>