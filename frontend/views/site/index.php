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

    <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
            <div class="p-4 mb-3 bg-light rounded">
                <h4 class="fst-italic">About</h4>
                <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
            </div>

            <div class="p-4">
                <h4 class="fst-italic">Archives</h4>
                <ol class="list-unstyled mb-0">
                    <li><a href="#">March 2021</a></li>
                    <li><a href="#">February 2021</a></li>
                    <li><a href="#">January 2021</a></li>
                    <li><a href="#">December 2020</a></li>
                    <li><a href="#">November 2020</a></li>
                    <li><a href="#">October 2020</a></li>
                    <li><a href="#">September 2020</a></li>
                    <li><a href="#">August 2020</a></li>
                    <li><a href="#">July 2020</a></li>
                    <li><a href="#">June 2020</a></li>
                    <li><a href="#">May 2020</a></li>
                    <li><a href="#">April 2020</a></li>
                </ol>
            </div>

            <div class="p-4">
                <h4 class="fst-italic">Elsewhere</h4>
                <ol class="list-unstyled">
                    <li><a href="#">GitHub</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Facebook</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
