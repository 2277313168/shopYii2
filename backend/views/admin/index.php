
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

                        <th class="span3 sortable">
                            <span class="line"></span>上次登录时间
                        </th>

                        <th class="span3 sortable ">
                            <span class="line"></span> 操作
                        </th>


                    </tr>
                    </thead>
                    <tbody>
                    <!-- row -->
                    <?php  foreach($adminList as $k=>$v): ?>
                    <tr class="first">
                        <td>
                            <img src="assets/img/contact-img.png" class="img-circle avatar hidden-phone" />
                            <a href="user-profile.html" class="name"><?php echo$v['admin_name'];  ?></a>
                            <span class="subtext"> </span>
                        </td>
                        <td >
                            <a href="#"><?php echo $v['email'] ?> </a>
                        </td>
                        <td>
                           <?php echo date('Y-m-d H:m:i', $v['login_time'] ); ?>
                        </td>
                        <td>
                            <a href="<?php echo yii\helpers\Url::to(['admin/delete','id'=>$v['admin_id'] ]) ?>">删除</a>
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