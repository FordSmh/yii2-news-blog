<?php

namespace frontend\controllers;

use common\models\Post;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{

    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Post::find()
            //->joinWith('createdBy', true, 'inner join')
            ->published()
            ->orderBy('created_at DESC');

        $sort = new Sort([
            'attributes' => [
                'created_at',
                'updated_at'
            ],
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'sort' => $sort
        ]);
    }

    /**
     * Displays a single Post model.
     * @param string $slug Slug
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        return $this->render('view', [
            'model' => $this->findModelBySlug($slug),
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
        $this->findModel($id)->delete();

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

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelBySlug($slug)
    {
        if (($model = Post::findOne(['slug' => $slug])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
