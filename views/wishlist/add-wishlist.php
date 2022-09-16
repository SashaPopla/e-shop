<?php if(!empty($session['wishlist'])): ?>
    <div class="container table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Цена</th>
                <th>
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($session['wishlist'] as $id => $item):?>
                <tr>
                    <td><?= \yii\helpers\Html::img("@web/images/products/{$item['img']}", ['alt' => $item['name'], 'height' => 40]) ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td>
                        <span data-id="<?= $id ?>" id="" class="glyphicon glyphicon-remove text-danger del" aria-hidden="true"></span>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h2>Нету избраных</h2>
<?php endif; ?>

<?php

$js = <<< JS
$('.del').on('click', function(){
    let id = $(this).data('id');
    $.ajax({
        url: '/e-shop/web/en/wishlist/del',
        data: {id: id},
        type: 'GET',
        success: function (res){
            if(!res)
                alert("Ошибка");
            console.log(res);
            location.reload(true);
        },
        error: function (){
            //alert("Ошибка");
            location.reload(true);
        }
    });
});
JS;

$this->registerJs($js);
?>
