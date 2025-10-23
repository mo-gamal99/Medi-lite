<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <a href="{{ route('dashboard.index') }}">
            <li class="menu-title title">لوحة التحكم</li>
        </a>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ti-home"></i>
                <span>الواجهة الرئيسية</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">

                <li><a href="{{ route('medicals.index') }}">الادوية</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="fas fa-users"></i> <span>قائمة العملاء</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('clients.index') }}">العملاء</a></li>

            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="fas fa-cogs"></i> <span>الضبط</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">

                <li><a href="{{ route('front_settings') }}">الاعدادات</a></li>

            </ul>
        </li>

    </ul>
</div>
