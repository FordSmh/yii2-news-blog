<?php

namespace frontend\controllers;

use common\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ArchiveController extends Controller
{
    public function actionView($date)
    {
        $date = $date.'-01';
        $dates = explode('-', $date);
        if(!checkdate($dates[1], $dates[2], $dates[0])) {
            throw new NotFoundHttpException('Page is not found');
        }
        $query = Post::find()
            ->published()
            ->where("created_at >= DATE(:date) AND created_at < DATE(:date) + INTERVAL '1 month'")
            ->params(['date' => $date])
            ->orderBy('created_at DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('view', [
            'dataProvider' => $dataProvider,
        ]);
    }
}