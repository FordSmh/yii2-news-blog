<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $dataProvider \common\models\Post */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="row category-view">
    <div class="col-12 col-md-8">

        <h1><?= Html::encode($this->title) ?></h1>

        <?=ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '../post/_post_item',
            'layout' => '{items}'
        ])?>

    </div>
    <?php echo $this->render('../layouts/_sidebar')?>
</div>
