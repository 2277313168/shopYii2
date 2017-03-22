<!-- sidebar -->
<div id="sidebar-nav">
    <ul id="dashboard-menu">
        <li class="active">
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
            <a href="index.html">
                <i class="icon-home"></i>
                <span>后台首页</span>
            </a>
        </li>
        <li>
            <a href="chart-showcase.html">
                <i class="icon-signal"></i>
                <span>统计</span>
            </a>
        </li>
        <li>
            <a class="dropdown-toggle" href="#">
                <i class="icon-group"></i>
                <span>管理员管理</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?php echo yii\helpers\url::to(['admin/index']) ?>">管理员列表</a></li>
                <li><a href="new-user.html">加入新管理员</a></li>
                <li><a href="user-profile.html">管理员信息</a></li>
            </ul>
        </li>



        <li>
            <a class="dropdown-toggle" href="#">
                <i class="icon-group"></i>
                <span>用户管理</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="user-list.html">用户列表</a></li>
                <li><a href="new-user.html">加入新用户</a></li>
                <li><a href="user-profile.html">用户信息</a></li>
            </ul>
        </li>
        <li>
            <a class="dropdown-toggle" href="#">
                <i class="icon-edit"></i>
                <span>表单</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="form-showcase.html">基本表单</a></li>
                <li><a href="form-wizard.html">步骤表单</a></li>
            </ul>
        </li>
        <li>
            <a href="gallery.html">
                <i class="icon-picture"></i>
                <span>相册管理</span>
            </a>
        </li>
        <li>
            <a href="calendar.html">
                <i class="icon-calendar-empty"></i>
                <span>日历事件管理</span>
            </a>
        </li>
        <li>
            <a href="tables.html">
                <i class="icon-th-large"></i>
                <span>表格</span>
            </a>
        </li>

        <li>
            <a href="personal-info.html">
                <i class="icon-cog"></i>
                <span>我的信息</span>
            </a>
        </li>

    </ul>
</div>
<!-- end sidebar -->