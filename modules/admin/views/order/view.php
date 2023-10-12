<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \app\modules\admin\models\OrderItems;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = "Заказ № {$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1>Просмотр заказа №<?= $model->id ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return !$data->status ? '<span class="text-danger">Active</span>' : '<span class="text-success">Completed</span>';
                },
                'format' => 'html',
            ],
            'name',
            'email:email',
            'phone',
            'city',
            'mail',
        ],
    ]) ?>

    <?php
        $id = Yii::$app->request->get('id');
        $orderItems = new OrderItems;
        $items = $orderItems::find()->where("order_id = {$id}")->one();
    ?>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="<?= \yii\helpers\Url::to(['/product/view', 'id' => $items->product_id]) ?>"><?= $items->name ?></a></td>
                    <td><?= $items->qty_item ?></td>
                    <td><?= $items->price ?></td>
                    <td><?= $items->sum_item ?></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
