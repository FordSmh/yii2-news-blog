<?php

namespace backend\controllers;

use common\models\Post;
use common\models\PostSearch;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Post();

        $this->handlePostSave($model);

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->id == $model->created_by || \Yii::$app->user->can('manageArticles')) {
            $this->handlePostSave($model);
        } else {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function handlePostSave(Post $model)
    {
        if ($model->load(Yii::$app->request->post())) {
            $model->previewImage = UploadedFile::getInstance($model, 'previewImage');

            if ($model->validate()) {
                if ($model->previewImage) {
                    if($model->preview_image && file_exists(Yii::getAlias('@frontend/web/storage/previews/').$model->preview_image)) {
                        unlink(Yii::getAlias('@frontend/web/storage/previews/').$model->preview_image);
                    }
                    $previewImageName = Yii::$app->security->generateRandomString(12);
                    $filePath = '@frontend/web/storage/previews/' . $previewImageName . '.' . $model->previewImage->extension;
                    if ($model->previewImage->saveAs($filePath)) {
                        $model->preview_image = $previewImageName . '.' . $model->previewImage->extension;
                    }
                }

                if ($model->save(false)) {
                    return $this->redirect(['index']);
                }
            }
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->user->id == $model->created_by || \Yii::$app->user->can('manageArticles')) {
            $model->delete();
        } else {
            throw new ForbiddenHttpException('You are not allowed to delete this article.');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
