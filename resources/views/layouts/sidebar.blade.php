<nav class="active" id="sidebar">
    <ul class="list-unstyled lead" >
        <li class="{{ Route::is('home') ? 'active' : '' }}">
            <a href=""><i class="fas fa-home fa-lg"></i> Home</a>
        </li>
        <li class="{{ Route::is('orders.*') ? 'active' : '' }}">
            <a href="{{ route('orders.index') }}"><i class="fas fa-box fa-lg"></i>  Orders</a>
        </li>
        <li class="{{ Route::is('transactions.*') ? 'active' : '' }}">
            <a href="{{ route('transactions.index') }}"><i class="fas fa-money-bill fa-lg"></i> Transactions</a>
        </li>
        <li class="{{ Route::is('products.*') ? 'active' : '' }}">
            <a href="{{ route('products.index') }}"><i class="fas fa-truck fa-lg"></i> Products</a>
        </li>
        <li class="{{ Route::is('sections.*') ? 'active' : '' }}">
            <a href="{{ route('sections.index') }}"><i class="fas fa-truck fa-lg"></i> Sections</a>
        </li>
    </ul>
</nav>