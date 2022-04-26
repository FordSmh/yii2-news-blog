<?php

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $postsDataProvider */
/** @var \yii\data\ActiveDataProvider $featuredDataProvider */

use yii\widgets\ListView;

$this->title = Yii::$app->name;
?>
<?=ListView::widget([
    'dataProvider' => $featuredDataProvider,
    'itemView' => '../post/_post_featured_item',
    'layout' => '<div class="row mb-2">{items}</div>',
    'itemOptions' => [
        'tag' => false
    ]
])?>


<div class="row g-5">
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            From the <?=Yii::$app->name?>
        </h3>
        <?=ListView::widget([
                'dataProvider' => $postsDataProvider,
                'itemView' => '../post/_post_item',
                'layout' => '{items}'

        ])?>

        <a class="btn btn-lg w-100 btn-outline-primary" href="<?=\yii\helpers\Url::to(['post/index'])?>">More posts</a>

    </div>

    <?php echo $this->render('../layouts/_sidebar')?>

</div>
