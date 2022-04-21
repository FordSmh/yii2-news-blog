<?php

namespace frontend\widgets;


use yii\BaseYii;
use yii\helpers\ArrayHelper;

class ArchiveList extends \yii\base\Widget
{
    public $dates;

    public function init()
    {
        parent::init();

        $now = new \DateTime();
        $this->dates[] = date('Y-m', time());
        $this->dates[] = date_sub($now, date_interval_create_from_date_string("1 month"))->format('Y-m');
        $this->dates[] = date_sub($now, date_interval_create_from_date_string("1 month"))->format('Y-m');
        $this->dates[] = date_sub($now, date_interval_create_from_date_string("1 month"))->format('Y-m');
        $this->dates[] = date_sub($now, date_interval_create_from_date_string("1 month"))->format('Y-m');
        $this->dates[] = date_sub($now, date_interval_create_from_date_string("1 month"))->format('Y-m');
        $this->dates[] = date_sub($now, date_interval_create_from_date_string("1 month"))->format('Y-m');

        \Yii::debug($this->dates);
    }

    public function run()
    {
        $list = '';
        $list .= '<ul class="list-unstyled">';
        foreach($this->dates as $key => $date) {
            $list .= '<li><a href="/archive/'.$this->dates[$key].'">'.\Yii::$app->formatter->asDate($this->dates[$key], 'MMMM Y').'</a></li>';
        }
        $list .= '</ul>';
        return $list;
    }
}