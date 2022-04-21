<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $sort \yii\data\Sort */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row post-index">
    <div class="col-12 col-md-8">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="text-end"><?='Sort by: ' . $sort->link('created_at') . ' ' . $sort->link('updated_at');?></div>
        <?=ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '../post/_post_item',
            'layout' => "{items}\n{pager}",
        ])?>
    </div>
    <?php echo $this->render('../layouts/_sidebar')?>
</div>
