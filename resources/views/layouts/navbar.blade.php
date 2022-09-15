<a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-sm btn-outline rounded-pill"><i class="fas fa-list"></i></a>
<a href="{{ route('home') }}" class="btn btn-sm btn-outline rounded-pill"><i class="fas fa-home me-2"></i>Home</a>
<a href="{{ route('users.index') }}" class="btn btn-sm btn-outline rounded-pill"><i class="fas fa-user me-2"></i>User</a>
<a href="{{ route('products.index') }}" class="btn btn-sm btn-outline rounded-pill"><i class="fas fa-truck me-2"></i>Products</a>
<a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline rounded-pill"><i class="fas fa-laptop me-2"></i>Cashire</a>
<a href="{{ route('users.index') }}" class="btn btn-sm btn-outline rounded-pill"><i class="fas fa-file me-2"></i>Report</a>
<a href="{{ route('transactions.index') }}" class="btn btn-sm btn-outline rounded-pill"><i class="fas fa-money-bill me-2"></i>Transactions</a>
<a href="{{ route('suppliers.index') }}" class="btn btn-sm btn-outline rounded-pill"><i class="fas fa-industry me-2"></i>Supplier</a>
<a href="{{ route('users.index') }}" class="btn btn-sm btn-outline rounded-pill"><i class="fas fa-users me-2"></i>Customers</a>
<a href="{{ route('logout') }}" class="btn btn-sm btn-outline rounded-pill" onclick="event.preventDefault();
document.getElementById('logout-form').submit();"><i class="fas fa-truck-moving me-2"></i>Incoming</a>
<a href="{{ route('products.barcode') }}" class="btn btn-sm btn-outline rounded-pill"><i class="fas fa-users me-2"></i>Barcode</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>