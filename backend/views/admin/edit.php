<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="new-user">
            <div class="row-fluid header">
                <h3>Create a new user</h3>
            </div>

            <div>
                <!-- left column -->


                <div>
                    <div>

                        <?php $form=ActiveForm::begin([
                            'fieldConfig'=> ["template"=>'<div class="span12 field-box">{input}{error}</div>  ']
                        ]); ?>
                        <label>昵称:</label>
                        <?php echo $form->field($adminModel,'admin_name')->textInput(['disabled'=>true ,]); ?>

                        <label>密码:</label>
                        <?php echo $form->field($adminModel,'password')->passwordInput(); ?>

                        <label>邮箱:</label>
                        <?php echo $form->field($adminModel,'email')->textInput(['type'=>'text']); ?>


                        <?php
                        if(Yii::$app->session->hasFlash('info')) {
                            echo Yii::$app->session->getFlash('info');
                        }
                            ?>




                        <div class="span11 field-box actions">
                            <?php echo Html::submitButton('修改',['class'=>'btn-glow primary']);  ?>
<!--                            <input type="button" class="btn-glow primary" value="创建"/>-->
                            <span>或</span>
                            <?php echo Html::submitButton('取消',['class'=>'reset']); ?>
<!--                            <input type="reset" value="取消" class="reset"/>-->
                        </div>
                       <?php ActiveForm::end() ?>
                    </div>
                </div>

                <!-- side right column -->
                <!--                <div class="span3 form-sidebar pull-right">-->
                <!--                    <div class="btn-group toggle-inputs hidden-tablet">-->
                <!--                        <button class="glow left active" data-input="inline">INLINE INPUTS</button>-->
                <!--                        <button class="glow right" data-input="normal">NORMAL INPUTS</button>-->
                <!--                    </div>-->
                <!--                    <div class="alert alert-info hidden-tablet">-->
                <!--                        <i class="icon-lightbulb pull-left"></i>-->
                <!--                        Click above to see difference between inline and normal inputs on a form-->
                <!--                    </div>-->
                <!--                    <h6>Sidebar text for instructions</h6>-->
                <!--                    <p>Add multiple users at once</p>-->
                <!--                    <p>Choose one of the following file types:</p>-->
                <!--                    <ul>-->
                <!--                        <li><a href="#">Upload a vCard file</a></li>-->
                <!--                        <li><a href="#">Import from a CSV file</a></li>-->
                <!--                        <li><a href="#">Import from an Excel file</a></li>-->
                <!--                    </ul>-->
                <!--                </div>-->

            </div>
        </div>
    </div>
</div>
<!-- end main container -->


<!-- scripts -->
<script src="assets/js/jquery-latest.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/theme.js"></script>

<script type="text/javascript">
    $(function () {

        // toggle form between inline and normal inputs
        var $buttons = $(".toggle-inputs button");
        var $form = $("form.new_user_form");

        $buttons.click(function () {
            var mode = $(this).data("input");
            $buttons.removeClass("active");
            $(this).addClass("active");

            if (mode === "inline") {
                $form.addClass("inline-input");
            } else {
                $form.removeClass("inline-input");
            }
        });
    });
</script>

</body>
</html>