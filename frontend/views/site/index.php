<?php

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $postsDataProvider */
/** @var \yii\data\ActiveDataProvider $featuredDataProvider */

use yii\widgets\ListView;

$this->title = Yii::$app->name;
?>
<div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
        <h1 class="display-4 fst-italic">Title of a longer featured blog post</h1>
        <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
        <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
    </div>
</div>
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
