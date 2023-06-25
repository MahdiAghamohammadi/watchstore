<div class="navigation">
    <div class="navigation-icon-menu">
        <ul>
            <li data-toggle="tooltip" title="کاربران">
                <a href="#users" title=" کاربران">
                    <i class="icon ti-user"></i>
                </a>
            </li>
            <li data-toggle="tooltip" title="محصولات">
                <a href="#products" title=" محصولات">
                    <i class="icon ti-folder"></i>
                </a>
            </li>
            <li data-toggle="tooltip" title="سفارش ها">
                <a href="#orders" title="سفارش ها">
                    <i class="icon ti-shopping-cart"></i>
                </a>
            </li>
        </ul>
        <ul>
            <li data-toggle="tooltip" title="ویرایش پروفایل">
                <a href="#" class="go-to-page">
                    <i class="icon ti-settings"></i>
                </a>
            </li>
            <li data-toggle="tooltip" title="خروج">
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                        @csrf
                    </form>
                @endauth
                <a href="{{ route('logout') }}" class="go-to-page"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="icon ti-power-off"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="navigation-menu-body">
        <ul id="users">
            <li>
                <a href="#">کاربران</a>
                <ul>
                    <li><a href="{{ route('users.create') }}">ایجاد کاربر</a></li>
                    <li><a href="{{ route('users.index') }}">لیست کاربران</a></li>
                </ul>
            </li>
            <li>
                <a href="#">نقش ها</a>
                <ul>
                    <li><a href="{{ route('roles.create') }}">ایجاد نقش</a></li>
                    <li><a href="{{ route('roles.index') }}">لیست نقش ها</a></li>
                </ul>
            </li>
            <li>
                <a href="#">لاگ ها</a>
                <ul>
                    <li><a href="{{ route('log-viewer') }}">لیست لاگ ها</a></li>
                </ul>
            </li>
        </ul>
        <ul id="products">
            <li>
                <a href="#">دسته بندی</a>
                <ul>
                    <li><a href="{{ route('category.create') }}">ایجاد دسته بندی</a></li>
                    <li><a href="{{ route('category.index') }}">لیست دسته بندی ها</a></li>
                </ul>
            </li>
            <li>
                <a href="#">اسلایدر</a>
                <ul>
                    <li><a href="{{ route('sliders.create') }}">ایجاد اسلایدر</a></li>
                    <li><a href="{{ route('sliders.index') }}">لیست اسلایدر ها</a></li>
                </ul>
            </li>
            <li>
                <a href="#">برند</a>
                <ul>
                    <li><a href="{{ route('brands.create') }}">ایجاد برند</a></li>
                    <li><a href="{{ route('brands.index') }}">لیست برند ها</a></li>
                </ul>
            </li>
            <li>
                <a href="#">رنگ</a>
                <ul>
                    <li><a href="{{ route('colors.create') }}">ایجاد رنگ</a></li>
                    <li><a href="{{ route('colors.index') }}">لیست رنگ ها</a></li>
                </ul>
            </li>
            <li>
                <a href="#">محصولات</a>
                <ul>
                    <li><a href="{{ route('products.create') }}">ایجاد محصولات</a></li>
                    <li><a href="{{ route('products.index') }}">لیست محصولات</a></li>
                </ul>
            </li>
            <li>
                <a href="#">گروه ویژگی ها</a>
                <ul>
                    <li><a href="{{ route('property-groups.create') }}">ایجاد گروه ویژگی ها</a></li>
                    <li><a href="{{ route('property-groups.index') }}">لیست گروه ویژگی ها</a></li>
                    <li><a href="{{ route('properties.create') }}">ایجاد ویژگی ها</a></li>
                    <li><a href="{{ route('properties.index') }}">لیست ویژگی ها</a></li>
                </ul>
            </li>
        </ul>
        <ul id="orders">
            <li>
                <a href="#">سفارش ها</a>
                <ul>
                    <li><a href="{{ route('orders.panel') }}">لیست سفارش ها</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
