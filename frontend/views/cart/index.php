


<!-- ============================================================= HEADER : END ============================================================= -->		<section id="cart-page">
    <div class="container">
        <!-- ========================================= CONTENT ========================================= -->
<?php $total=0; ?>
        <?php foreach ($cart as $k=>$v): ?>
        <div class="col-xs-12 col-md-9 items-holder no-margin">
            
            <div class="row no-margin cart-item">
                <div class="col-xs-12 col-sm-2 no-margin">
                    <a href="#" class="thumb-holder">
                        <img class="lazy" alt="" src="<?php echo Yii::$app->params['qnPrefix'] . $v['goods_img']; ?>" />
                    </a>
                </div>

                <div class="col-xs-12 col-sm-5 ">
                    <div class="title">
                        <a href="#"><?php echo $v['goods_name'] ?></a>
                    </div>
<!--                    <div class="brand">sony</div>-->
                </div> 

                <div class="col-xs-12 col-sm-3 no-margin">
                    <div class="quantity">
                        <div class="le-quantity">
                            <form>
                                <a class="minus" href="#reduce" " ></a>
                                <input name="quantity" readonly="readonly" type="text" value="<?php echo $v['goods_num'] ?>" />
                                <a class="plus" href="#add" "></a>
                            </form>
                        </div>
                    </div>
                </div> 

                <div class="col-xs-12 col-sm-2 no-margin">
                    <div class="price">
                        <?php echo $v['shop_price'] ?>
                    </div>
                    <a class="close-btn" href="#"></a>
                </div>
            </div><!-- /.cart-item -->
        </div>
            <?php $total += $v['shop_price']*$v['goods_num']; ?>
            <?php endforeach; ?>

        <script>
           $('.minus').click(function () {
               var num = $(this).parent().find('input').val();
               alert(num);
               alert(1);
           })
        </script>

        <!-- ========================================= CONTENT : END ========================================= -->

        <!-- ========================================= SIDEBAR ========================================= -->

        <div class="col-xs-12 col-md-3 no-margin sidebar ">
            <div class="widget cart-summary">
                <h1 class="border">shopping cart</h1>
                <div class="body">
                    <ul class="tabled-data no-border inverse-bold">
                        <li>
                            <label>cart subtotal</label>
                            <div class="value pull-right"><?php echo '$'.$total.'.00'; ?></div>
                        </li>
                        <li>
                            <label>shipping</label>
                            <div class="value pull-right">free shipping</div>
                        </li>
                    </ul>
                    <ul id="total-price" class="tabled-data inverse-bold no-border">
                        <li>
                            <label>order total</label>
                            <div class="value pull-right"><?php echo '$'.$total.'.00'; ?></div>
                        </li>
                    </ul>
                    <div class="buttons-holder">
                        <a class="le-button big" href="http://localhost/~ibrahim/themeforest/HTML/mediacenter/upload/PHP/checkout" >checkout</a>
                        <a class="simple-link block" href="http://localhost/~ibrahim/themeforest/HTML/mediacenter/upload/PHP/home" >continue shopping</a>
                    </div>
                </div>
            </div><!-- /.widget -->

            <div id="cupon-widget" class="widget">
                <h1 class="border">use coupon</h1>
                <div class="body">
                    <form>
                        <div class="inline-input">
                            <input data-placeholder="enter coupon code" type="text" />
                            <button class="le-button" type="submit">Apply</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.widget -->
        </div><!-- /.sidebar -->

        <!-- ========================================= SIDEBAR : END ========================================= -->
    </div>
</section>		<!-- ============================================================= FOOTER ============================================================= -->
<footer id="footer" class="color-bg">

