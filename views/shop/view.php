<?php

/** @var yii\web\View $this */
/** @var object $category */
/** @var integer $pages */
use yii\helpers\Html;
?>
<section id="advertisement">
    <div class="container">
        <?= Html::img("@web/images/shop/vertisement.jpg", ['alt'=> '']) ?>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <ul class="catalog category-products">
                        <?= \app\components\MenuWidget::widget(['tpl' => 'menu'])?>
                    </ul>
                    <div class="brands_products"><!--brands_products-->
                        <h2>Brands</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <?php foreach($countBrands as $count): ?>
                                    <li><a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $count['id']]) ?>"> <span class="pull-right">(<?= $count['COUNT(product.name)'] ?>)</span><?= $count['name'] ?></a></li>
                                <?php endforeach; ?> 
                            </ul>
                        </div>
                    </div><!--/brands_products-->

                    <div class="shipping text-center"><!--shipping-->
                        <?= Html::img("@web/images/home/shipping.jpg", ['alt'=> '']) ?>
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">All product</h2>
                        <?php if(!empty($products)): ?>
                        <?php $i = 0; foreach ($products as $product): ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/products/{$product->img}", ['alt'=> '']) ?>
                                            <h2>$ <?=$product->price?></h2>
                                            <p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product['id']]) ?>"> <?= $product['name'] ?> </a></p>
                                            <a href="<?=\yii\helpers\Url::to(['cart/add', 'id'=>$product['id']])?>" data-id="<?=$product['id']?>" class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </a>
                                        </div>
                                        <?php if($product->new): ?>
                                            <?= Html::img("@web/images/home/new.png", ['alt'=> 'New', 'class' => 'new'])?>
                                        <?php endif; ?>

                                        <?php if($product->sale): ?>
                                            <?= Html::img("@web/images/home/sale.png", ['alt'=> 'Sale', 'class' => 'new'])?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li>
                                                <a href="<?= \yii\helpers\Url::to(['wishlist/add', 'id'=>$product->id]) ?>">
                                                    <i class="fa fa-plus-square add-wishlist"></i>
                                                    Add to wishlist
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-plus-square"></i>Add to compare</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php $i++ ?>
                            <?php if($i % 3 === 0): ?>
                                <div class="clearfix"></div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                            <div class="clearfix"></div>
                            <?php
                                echo \yii\widgets\LinkPager::widget(['pagination'=>$pages])
                            ?>

                            <?php else: ?>
                            <h2>Товаров нету</h2>
                        <?php endif; ?>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>

<?php
$script = <<<JS
    /*price range*/

 $('#sl2').slider();

 	$('.catalog').dcAccordion({
 	    speed: 300
 	});

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

JS;

$this->registerJs($script);
?>