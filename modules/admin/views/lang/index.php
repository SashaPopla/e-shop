<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Lang;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app_atribute', 'Lang');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app_atribute', 'Create Lang'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:url',
            'local',
            'name',
            'default',
            //'date_update',
            //'date_create',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Lang $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
