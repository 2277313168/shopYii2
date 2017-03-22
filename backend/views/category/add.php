<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<link rel="stylesheet" href="assets/admin/css/compiled/new-user.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">
    <div class="container-fluid">
        <div id="pad-wrapper" class="new-user">
            <div class="row-fluid header">
                <h3>添加新分类</h3>
            </div>
            <div class="row-fluid form-wrapper">
                <!-- left column -->
                <div class="span9 with-sidebar">
                    <div class="container">
                        <?php

                        $form = ActiveForm::begin([
                            'fieldConfig' => [
                                'template' => '<div class="span12 field-box">{input}</div>{error}',
                            ],
                            'options' => [
                                'class' => 'new_user_form inline-input',
                            ],
                        ]);
                        ?>
                      <label> 父分类</label>
                        <?php echo $form->field($model, 'parent_id')->dropDownList($catTree); ?>
                        <label> 子分类名称</label>
                       <?php echo $form->field($model, 'cat_name')->textInput();
                        ?>
                        <div class="span11 field-box actions">
                            <?php echo Html::submitButton('添加', ['class' => 'btn-glow primary']); ?>
                            <span>OR</span>
                            <?php echo Html::resetButton('取消', ['class' => 'reset']); ?>
                            <?php
                            if (Yii::$app->session->hasFlash('info')) {
                                echo Yii::$app->session->getFlash('info');
                            }
                            ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

                <!-- side right column -->
                <div class="span3 form-sidebar pull-right">
                    <div class="alert alert-info hidden-tablet">
                        <i class="icon-lightbulb pull-left"></i>
                        请在左侧表单当中填写要添加的分类，请选择好上级分类
                    </div>
                    <h6>商城分类说明</h6>
                    <p>该分类为无限级分类</p>
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