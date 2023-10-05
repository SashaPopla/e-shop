<?php

/** @var yii\web\View $this */
/** @var object $product */
/** @var object $hits */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <ul class="catalog category-products">
                        <?= \app\components\MenuWidget::widget(['tpl' => 'menu'])?>
                    </ul>

                    <div class="shipping text-center"><!--shipping-->
                        <?= Html::img("@web/images/home/shipping.jpg", ['alt'=> '']) ?>
                    </div><!--/shipping-->

                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <?= Html::img("@web/images/products/{$product[0]['img']}", ['alt'=> $product[0]['description']]); ?>
                            <h3>ZOOM</h3>
                        </div>
                    </div>

                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <?php if($product[0]['new']): ?>
                                <?= Html::img("@web/images/home/new.png", ['alt'=> 'New', 'class' => 'newarrival'])?>
                            <?php endif; ?>

                            <?php if($product[0]['sale']): ?>
                                <?= Html::img("@web/images/home/sale.png", ['alt'=> 'Sale', 'class' => 'newarrival'])?>
                            <?php endif; ?>

                            <h2><?= $product[0]['title'] ?></h2>
                            <p>Web ID: 1089<?= $product[0]['id'] ?></p>
                            <?= Html::img("@web/images/product-details/rating.png", ['alt'=> '']) ?>
                            <span>
                                <span>$ <?= $product[0]['price'] ?></span>
                                <label>Quantity:</label>
                                <input type="text" value="1" id="qty"/>
                                <a href="#" data-id="<?= $product[0]['id'] ?>" class="btn btn-fefault add-to-cart cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </a>
                            </span>
                            <p><b>Availability:</b> In Stock</p>

                            <?php if($product[0]['new']): ?>
                                <p><b>Condition:</b> New</p>
                            <?php endif; ?>

                            <b>Brand:</b> <?= $product[0]['categoryName'] ?>
                            <a href=""><?= Html::img("@web/images/product-details/share.png", ['alt'=> '', 'class'=>'share img-responsive']) ?> </a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Details</a></li>
                            <li><a href="#tag" data-toggle="tab">Tag</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details" >
                            <div class="col-sm-12">
                                <p>
                                    <?= $product[0]['description'] ?>
                                </p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tag" >
                            <div class="col-sm-12">
                                <p class="text">
                                    <?= $product[0]['categoryName'].', '.$product[0]['description'] ?>
                                </p>
                            </div>
                        </div>

                    </div>
                </div><!--/category-tab-->

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php $count = count($hits); $i = 0; foreach ($hits as $hit): ?>
                                <?php if($i % 3 === 0): ?>
                                <div class="item <?php if($i == 0 ) echo 'active' ?>">
                                <?php endif; ?>
                                    <?php if($product[0]['id'] !== $hit['id']): ?>
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                    <?= Html::img("@web/images/products/{$hit['img']}", ['alt'=> $hit['description']]) ?>
                                                        <h2>$<?= $hit['price'] ?></h2>
                                                        <p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $hit['id']]) ?>"> <?= $hit['title']?> </a></p>
                                                        <a href="<?=\yii\helpers\Url::to(['cart/add', 'id'=>$hit['id']])?>" data-id="<?=$hit['id']?>" class="btn btn-default add-to-cart">
                                                            <i class="fa fa-shopping-cart"></i>
                                                            Add to cart
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php $i++; if($i % 3 === 0 || $i == $count): ?>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div><!--/recommended_items-->

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