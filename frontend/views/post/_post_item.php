<?php
/** @var $model \common\models\Post */

use yii\helpers\Url;

$lead = explode("\r\n\r\n",$model->bodytext);
?>
<article class="my-3">
    <h2><?=$model->title?></h2>
    <p class="text-muted"><?=$model->category->name?> - <?=Yii::$app->formatter->asRelativeTime($model->created_at)?> - <?=$model->createdBy->username?></p>
    <?php
    if($model->preview_image) {
        echo '<img src="'.Yii::$app->params['frontendUrl'].'/storage/previews/'.$model->preview_image.'" class="ratio ratio-16x9 mb-3">';
    }
    ?>
    <p><?=\yii\helpers\StringHelper::truncateWords($lead[0],75)?></p>
    <p><a href="<?= Url::to(['post/view', 'slug' => $model->slug])?>">Continue reading ...</a></p>
</article>