<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- Dashboard --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/dashboard') ? '' : 'collapsed' }}" href="{{ url('/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        {{-- Sell Section --}}
        <li class="nav-heading">SELL SECTION</li>

        {{-- Components --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li><a href="#"><i class="bi bi-circle"></i><span>Alerts</span></a></li>
                <li><a href="#"><i class="bi bi-circle"></i><span>Accordion</span></a></li>
                <!-- Add others as needed -->
            </ul>
        </li>

        {{-- Product Section --}}
        <li class="nav-heading">Product Section</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('product.*') ? '' : 'collapsed' }}" data-bs-target="#product" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="product" class="nav-content collapse {{ request()->routeIs('product.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="" class="{{ request()->routeIs('product.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Add Product</span>
                    </a>
                </li>
                <li>
                    <a href="" class="{{ request()->routeIs('product.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Product List</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('purchase.*') ? '' : 'collapsed' }}" data-bs-target="#purchase" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Products Stock</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="purchase" class="nav-content collapse {{ request()->routeIs('purchase.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="" class="{{ request()->routeIs('purchase.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Add Stock</span>
                    </a>
                </li>
                <li>
                    <a href="" class="{{ request()->routeIs('purchase.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Stock List</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('stock.report') }}" class="{{ request()->routeIs('stock.report') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Stock Report</span>
                    </a>
                </li> --}}
            </ul>
        </li>

        {{-- Category --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('category.*') ? '' : 'collapsed' }}" data-bs-target="#category" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="category" class="nav-content collapse {{ request()->routeIs('category.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href=" class="{{ request()->routeIs('category.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Category List</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Brand --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('brand.*') ? '' : 'collapsed' }}" data-bs-target="#brand" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Brand</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="brand" class="nav-content collapse {{ request()->routeIs('brand.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="" class="{{ request()->routeIs('brand.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Brand List</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Unit --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('unit.*') ? '' : 'collapsed' }}" data-bs-target="#unit" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Unit</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="unit" class="nav-content collapse {{ request()->routeIs('unit.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="" class="{{ request()->routeIs('unit.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Unit List</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Customer & Supplier --}}
        <li class="nav-heading">Customer & Supplier</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('customer.*') ? '' : 'collapsed' }}" data-bs-target="#customer" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Customer</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="customer" class="nav-content collapse {{ request()->routeIs('customer.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('customer.index') }}" class="{{ request()->routeIs('customer.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Customer List</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('supplier.*') ? '' : 'collapsed' }}" data-bs-target="#supplier" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Supplier</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="supplier" class="nav-content collapse {{ request()->routeIs('supplier.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('supplier.index') }}" class="{{ request()->routeIs('supplier.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Supplier List</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- User Role --}}
        <li class="nav-heading">User Role</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.*') ? '' : 'collapsed' }}" data-bs-target="#user" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user" class="nav-content collapse {{ request()->routeIs('user.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="" class="{{ request()->routeIs('user.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>New User</span>
                    </a>
                </li>
                <li>
                    <a href="" class="{{ request()->routeIs('user.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>All User</span>
                    </a>
                </li>
                <li>
                    <a href="" class="">
                        <i class="bi bi-circle"></i><span>Role & Permission</span>
                    </a>
                </li>
            </ul>
        </li>

        
        <li class="nav-heading">Recycle Bin</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('recycle.*') ? '' : 'collapsed' }}" data-bs-target="#recycleBin" data-bs-toggle="collapse" href="#">
                <i class="bi bi-trash"></i><span>Recycle Bin</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="recycleBin" class="nav-content collapse {{ request()->routeIs('recycle.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('recycle.customer') }}" class="{{ request()->routeIs('recycle.customer') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Customer</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('recycle.supplier') }}" class="{{ request()->routeIs('recycle.supplier') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Supplier</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('recycle.product') }}" class="{{ request()->routeIs('recycle.product') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Product</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('recycle.purchase') }}" class="{{ request()->routeIs('recycle.purchase') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Purchase</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('recycle.transaction') }}" class="{{ request()->routeIs('recycle.transaction') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Transaction</span>
                    </a>
                </li>

            </ul>
        </li>
        {{-- History Log --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('activity.logs') }}">
                <i class="bi bi-tools"></i><span>History Logs</span>
            </a>
        </li>

        {{-- Settings --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-tools"></i><span>Setting</span>
            </a>
        </li>
        {{-- Settings --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-tools"></i><span>Setting</span>
            </a>
        </li>
        {{-- Website --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-box-arrow-up-right"></i><span>Website</span>
            </a>
        </li>

    </ul>
</aside>
