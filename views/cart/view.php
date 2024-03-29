<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use app\models\User;

/** @var object $order */
/** @var object $city */
/** @var object $mail */
if (!Yii::$app->user->isGuest)
    $email = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
?>

<div class="container">
   <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo Yii::$app->session->getFlash('success') ?>
        </div>
   <?php endif; ?>

    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <?php if(!empty($session['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th>
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($session['cart'] as $id => $item):?>
                    <tr>
                        <td><?= Html::img("@web/images/products/{$item['img']}", ['alt' => $item['name'], 'height' => 40]) ?></td>
                        <td><a href="<?= Url::to(['product/view', 'id' => $id]) ?>"><?= $item['name'] ?></a></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['qty'] * $item['price'] ?></td>
                        <td>
                            <span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span>
                        </td>
                    </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="5">Итого: </td>
                    <td><?= $session['cart.qty'] ?></td>
                </tr>
                <tr>
                    <td colspan="5">На сумму: </td>
                    <td><?= $session['cart.sum'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr>

    <?php $form = ActiveForm::begin()?>
        <?php if(!Yii::$app->user->isGuest): ?>
            <?= $form->field($order, 'name')->textInput(['value' => Yii::$app->user->identity->username]) ?>
            <?= $form->field($order, 'email')->textInput(['value' => $email->email]) ?>
        <?php else: ?>
            <?= $form->field($order, 'name') ?>
            <?= $form->field($order, 'email') ?>
        <?php endif; ?>

        <?= $form->field($order, 'phone') ?>
        <?= $form->field($order, 'city')->dropDownList(
                $city,
                ['prompt' => 'Виберете город', 'id' => 'city-dropdown']
        )?>

        <?= $form->field($order, 'mail')->textInput(['id'=>'mail-name', 'list' => 'mail'])?>
        <datalist id="mail"></datalist>
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>
    <?php $form = ActiveForm::end()?>

    <?php else: ?>
        <h2>Корзина пустая</h2>
<?php endif; ?>
    <br>
</div>