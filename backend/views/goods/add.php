<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
?>
<style>
    .span8 div{
        display:inline;
    }
    .help-block-error {
        color:red;
        display:inline;
    }
</style>
    <link rel="stylesheet" href="assets/css/compiled/new-user.css" type="text/css" media="screen" />
    <!-- main container -->
    <div class="content">
        <div class="container-fluid">
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <h3>添加商品</h3>
                </div>
                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <div class="container">
                                <?php
                                if (Yii::$app->session->hasFlash('info')) {
                                    echo Yii::$app->session->getFlash('info');
                                }
                                $form = ActiveForm::begin([
                                    'fieldConfig' => [
                                        'template' => '<div class="span12 field-box">{input}</div>{error}',
                                    ],
                                    'options' => [
                                        'class' => 'new_user_form inline-input',
                                        'enctype' => 'multipart/form-data'
                                    ],
                                ]);
                                echo '商品分类'.$form->field($model, 'cat_id')->dropDownList($opts, ['id' => 'cates']);
                                echo '商品名称'.$form->field($model, 'goods_name')->textInput();
                                echo '商品描素'.$form->field($model, 'goods_desc')->textarea(['id' => "wysi", 'class' => "span9 wysihtml5", 'style' => 'margin-left:120px']);
                                echo '商品价格'.$form->field($model, 'shop_price')->textInput(['class' => 'span9']);
                                echo '商品是否热卖'.$form->field($model, 'is_hot')->radioList([0 => '不热卖', 1 => '热卖'], ['class' => 'span8']);
                                echo '是否促销'.$form->field($model, 'is_promote')->radioList(['不促销', '促销'], ['class' => 'span8']);
                                echo '促销价'.$form->field($model, 'promote_price')->textInput(['class' => 'span9']);
                                echo '库存量'.$form->field($model, 'goods_number')->textInput(['class' => 'span9']);
                                echo '是否上架'.$form->field($model, 'is_onsale')->radioList(['下架', '上架'], ['class' => 'span8']);
                                echo '是否新品'.$form->field($model, 'is_new')->radioList(['非新品', '新品'], ['class' => 'span8']);
                                echo '上传图像'.$form->field($model, 'goods_img')->fileInput(['class' => 'span9']);
                                if (!empty($model->goods_img)):
                                ?>
                                    <img src="<?php echo 'http://ommrvw8iv.bkt.clouddn.com/'.$model->goods_img;?>-_logo">

                                    <hr>

                                <?php
                                    endif;
                                    echo $form->field($model, 'album[]')->fileInput(['class' => 'span9', 'multiple' => true,]);
                                ?>
                                <?php
                                    foreach((array)json_decode($model->album, true) as $k=>$pic) {
                                ?>
                                        <img src="<?php echo 'http://ommrvw8iv.bkt.clouddn.com/'.$pic;?>-_logo">
<!--                                    <a href="--><?php //echo yii\helpers\Url::to(['product/removepic', 'key' => $k, 'productid' => $model->productid]) ?><!--">删除</a>-->
                                <?php
                                }
                                ?>
                                </hr>
                                <input type='button' id="addpic" value='增加一个'>
                                <div class="span11 field-box actions">
                                    <?php echo Html::submitButton('提交', ['class' => 'btn-glow primary']); ?>
                                    <span>OR</span>
                                    <?php echo Html::resetButton('取消', ['class' => 'reset']); ?>
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                    <!-- side right column -->
                    <div class="span3 form-sidebar pull-right">
                        <div class="alert alert-info hidden-tablet">
                            <i class="icon-lightbulb pull-left"></i>
                            请在左侧表单当中填入要添加的商品信息,包括商品名称,描述,图片等
                        </div>                        
                        <h6>商城用户说明</h6>
                        <p>可以在前台进行购物</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main container -->

<script src="assets/js/jquery-latest.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/theme.js"></script>

</body>
</html>