
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>Users</h3>
                <div class="span10 pull-right">
                    <input type="text" class="span5 search" placeholder="Type a user's name..." />

                    <!-- custom popup filter -->
                    <!-- styles are located in assets/css/elements.css -->
                    <!-- script that enables this dropdown is located in assets/js/theme.js -->
                    <div class="ui-dropdown">
                        <div class="head" data-toggle="tooltip" title="Click me!">
                            Filter users
                            <i class="arrow-down"></i>
                        </div>
                        <div class="dialog">
                            <div class="pointer">
                                <div class="arrow"></div>
                                <div class="arrow_border"></div>
                            </div>
                            <div class="body">
                                <p class="title">
                                    Show users where:
                                </p>
                                <div class="form">
                                    <select>
                                        <option />Name
                                        <option />Email
                                        <option />Number of orders
                                        <option />Signed up
                                        <option />Last seen
                                    </select>
                                    <select>
                                        <option />is equal to
                                        <option />is not equal to
                                        <option />is greater than
                                        <option />starts with
                                        <option />contains
                                    </select>
                                    <input type="text" />
                                    <a class="btn-flat small">Add filter</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="new-user.html" class="btn-flat success pull-right">
                        <span>&#43;</span>
                        NEW USER
                    </a>
                </div>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span4 sortable">
                             管理员昵称
                        </th>
                        <th class="span3 sortable ">
                            <span class="line"></span> 邮箱
                        </th>
                        <th class="span3 sortable ">
                            <span class="line"></span> 真实姓名
                        </th>
                        <th class="span3 sortable ">
                            <span class="line"></span> 性别
                        </th>

                        <th class="span3 sortable">
                            <span class="line"></span>注册时间
                        </th>

                        <th class="span3 sortable ">
                            <span class="line"></span> 操作
                        </th>


                    </tr>
                    </thead>
                    <tbody>


                    <!-- row -->
                    <?php  foreach($userList as $k=>$v): ?>
                    <tr class="first">
                        <td>
                            <?php if(empty($v['user_img'])): ?>
                            <img src="<?php echo Yii::$app->params['defaultImg']; ?>" width="60px" height="60px" class="img-circle avatar hidden-phone" />
                            <?php else: ?>
                            <img src="assets/img/contact-img.png" class="img-circle avatar hidden-phone" />
                            <?php endif; ?>
                            <a href="#" class="name"><?php echo$v['user_name'];  ?></a>
                            <span class="subtext"> </span>
                        </td>

                        <td >
                            <?php echo $v['email'] ?>
                        </td>
                        <td >
                            <?php
                            echo empty($v['userDetail']['true_name']) ? '未填写':$v['userDetail']['true_name'];
                            ?>
                        </td>
                        <td >
                            <?php
                            if($v['userDetail']['sex'] == 0){
                                echo '保密';
                            }else if($v['userDetail']['sex'] == 1){
                                echo  '女';
                            }else{
                                echo '男';
                            }
                            ?>
                        </td>

                        <td>
                            <?php date_default_timezone_set('PRC');
                            echo date('Y-m-d H:m:i', $v['reg_time'] );
                            ?>
                        </td>

                        <td>
                            <a href="<?php echo yii\helpers\Url::to(['user/delete','id'=>$v['user_id']]) ?>">删除&nbsp;&nbsp;</a>
                            <a href="<?php echo yii\helpers\Url::to(['user/edit','id'=>$v['user_id']]) ?>">修改</a>
                        </td>

                       
                    </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

            <?php
            if(Yii::$app->session->hasFlash('info')){
                echo Yii::$app->session->getFlash('info');
            }
            ?>


            <div class="pagination pull-right">
<!--                --><?php //echo yii\widgets\LinkPager::widget(['pagination'=>$pager]) ?>
                <?php echo yii\widgets\LinkPager::widget(['pagination'=>$pager, 'prevPageLabel'=>'&#8249;', 'nextPageLabel'=>'&#8250;']) ?>
<!--                <ul>-->
<!--                    <li><a href="#">&#8249;</a></li>-->
<!--                    <li><a class="active" href="#">1</a></li>-->
<!--                    <li><a href="#">2</a></li>-->
<!--                    <li><a href="#">3</a></li>-->
<!--                    <li><a href="#">4</a></li>-->
<!--                    <li><a href="#">5</a></li>-->
<!--                    <li><a href="#">&#8250;</a></li>-->
<!--                </ul>-->
            </div>
            <!-- end users table -->
        </div>
    </div>
</div>
<!-- end main container -->


<!-- scripts -->
<script src="assets/js/jquery-latest.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/theme.js"></script>

</body>
</html>