<?php

use common\models\Post;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            //'bodytext:ntext',
            [
                'attribute' => 'created_by',
                'value' => 'createdBy.username',
                'label' => 'Created By'
            ],
            [
                'attribute' => 'created_at',
                'value' => 'created_at',
                'label' => 'Created at',
                'filterType' => \kartik\grid\GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'locale' => [
                            'format' => 'YYYY-MM-DD',
                            ]
                        ]
                    ]
            ],
            //'updated_at',
            //'preview_image',
            [
                'attribute' => 'featured',
                'content' => function($model){
                    return $model->featured ? 'Featured' : '';
                },
                'filter'=>array(1 => 'Featured'),
            ],
            [
                'attribute' => 'status',
                'content' => function($model){
                    return $model->getStatusLabels()[$model->status];
                },
                'filter'=>array(1 => 'Published', 0 => 'Draft'),
            ],
            [
                'attribute' => 'category_id',
                'value' => 'category.name',
                'label' => 'Category',
                'filter'=>ArrayHelper::map(\common\models\Category::find()->asArray()->all(), 'id', 'name'),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Post $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
