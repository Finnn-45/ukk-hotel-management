@extends('customer.layouts.app')

@section('title', 'Restoran - Potato Rolls')

@section('content')
<style>
    .restaurant-hero {
        position: relative;
        height: 40vh;
        min-height: 250px;
        background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1920') center/cover;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        margin-top: -56px;
        padding-top: 56px;
    }
    .restaurant-hero h1 {
        font-size: 2.5rem;
        font-weight: 900;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        margin-bottom: 0.5rem;
    }
    .restaurant-hero p {
        font-size: 1rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }
    @media (min-width: 768px) {
        .restaurant-hero { height: 60vh; min-height: 400px; }
        .restaurant-hero h1 { font-size: 3.5rem; }
        .restaurant-hero p { font-size: 1.25rem; }
    }
    .category-filter {
        background: white;
        padding: 1rem;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-top: -30px;
        position: relative;
        z-index: 10;
    }
    @media (min-width: 768px) {
        .category-filter { margin-top: -50px; padding: 1.5rem; }
    }
    .menu-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        height: 100%;
    }
    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }
    .menu-card-img {
        height: 180px;
        object-fit: cover;
        width: 100%;
    }
    @media (min-width: 768px) {
        .menu-card-img { height: 250px; }
    }
    .menu-card-body {
        padding: 1rem;
    }
    @media (min-width: 768px) {
        .menu-card-body { padding: 1.5rem; }
    }
    .menu-card-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: #1f2937;
    }
    .menu-card-description {
        color: #6b7280;
        font-size: 0.85rem;
        margin-bottom: 0.75rem;
    }
    .menu-card-price {
        font-size: 1.25rem;
        font-weight: 800;
        color: #ff690f;
        margin-bottom: 0.75rem;
    }
    .btn-add-cart {
        background: #ff690f;
        color: white;
        border: none;
        padding: 0.6rem 1rem;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        transition: background 0.3s;
        font-size: 0.9rem;
    }
    .btn-add-cart:hover {
        background: #e55a00;
    }
    .category-badge {
        background: #f3f4f6;
        color: #374151;
        padding: 0.4rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s;
        white-space: nowrap;
        font-size: 0.85rem;
    }
    .category-badge:hover, .category-badge.active {
        background: #ff690f;
        color: white;
        border-color: #ff690f;
    }

    /* Floating Cart Button - Always visible */
    .floating-cart {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #ff690f;
        color: white;
        border: none;
        box-shadow: 0 4px 15px rgba(255, 105, 15, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    .floating-cart:hover {
        transform: scale(1.1);
        background: #e55a00;
    }
    .floating-cart .badge-cart {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    @media (min-width: 768px) {
        .floating-cart {
            bottom: 30px;
            right: 30px;
            width: 65px;
            height: 65px;
            font-size: 1.6rem;
        }
    }
</style>

<!-- Hero Section -->
<div class="restaurant-hero">
    <div>
        <h1>🍽️ RESTORAN HOTEL</h1>
        <p>Nikmati hidangan lezat dengan cita rasa premium</p>
    </div>
</div>

<!-- Category Filter -->
<div class="container">
    <div class="category-filter">
        <div class="d-flex gap-2 overflow-auto pb-2">
            <button class="category-badge active" data-category="all">Semua</button>
            @foreach($categories as $category)
                <button class="category-badge" data-category="{{ $category }}">{{ ucfirst($category) }}</button>
            @endforeach
        </div>
    </div>
</div>

<!-- Menu Grid -->
<div class="container py-4">
    <div class="row g-3" id="menuGrid">
        @forelse($menus as $menu)
            <div class="col-6 col-md-6 col-lg-4 menu-item" data-category="{{ $menu->category }}">
                <div class="card menu-card">
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="menu-card-img">
                    @else
                        <div class="menu-card-img bg-light d-flex align-items-center justify-content-center">
                            <i class="bi bi-image" style="font-size: 3rem; color: #ccc;"></i>
                        </div>
                    @endif
                    <div class="menu-card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h5 class="menu-card-title">{{ $menu->name }}</h5>
                                <span class="badge bg-{{ $menu->is_available ? 'success' : 'danger' }}" style="font-size: 0.7rem;">
                                    {{ $menu->is_available ? 'Tersedia' : 'Habis' }}
                                </span>
                            </div>
                        </div>
                        <p class="menu-card-description d-none d-md-block">{{ $menu->description }}</p>
                        <div class="menu-card-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                        @auth
                            @if($menu->is_available)
                                <button class="btn btn-add-cart" onclick="addToCart({{ $menu->id }}, this)">
                                    <i class="bi bi-cart-plus"></i> Pesan
                                </button>
                            @else
                                <button class="btn btn-add-cart" disabled>
                                    <i class="bi bi-x-circle"></i> Habis
                                </button>
                            @endif
                        @else
                            <a href="{{ route('customer.login') }}" class="btn btn-add-cart">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-shop display-1 text-muted"></i>
                <h5 class="mt-3">Menu belum tersedia</h5>
                <p class="text-muted">Silakan kembali lagi nanti</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Floating Cart Button -->
<button class="floating-cart" onclick="toggleCart()" id="cartFloatingBtn">
    <i class="bi bi-cart-fill"></i>
    <span class="badge-cart" id="cartCount">0</span>
</button>

<!-- Cart Sidebar -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold">🛒 Pesanan Saya</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <div id="cartItems" class="flex-grow-1"></div>
        <div class="pt-3 border-top mt-auto">
            <div class="d-flex justify-content-between mb-3">
                <strong>Total:</strong>
                <strong id="cartTotal" class="text-primary fs-5">Rp 0</strong>
            </div>
            <button class="btn btn-primary w-100 py-2 fw-bold" onclick="showCheckoutModal()">
                <i class="bi bi-credit-card"></i> Checkout
            </button>
        </div>
    </div>
</div>

<!-- Order Modal -->
<div class="modal fade" id="orderTypeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">🏠 Nomor Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nomor Kamar/Meja *</label>
                    <input type="text" class="form-control form-control-lg" id="tableNumber" placeholder="Contoh: 101" required>
                    <small class="text-muted">Masukkan nomor kamar Anda agar pesanan bisa diantar</small>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Catatan (Opsional)</label>
                    <textarea class="form-control" id="orderNotes" rows="2" placeholder="Catatan untuk pesanan"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary fw-bold px-4" onclick="processCheckout()">
                    <i class="bi bi-check-circle"></i> Buat Pesanan
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let cart = [];

    function toggleCart() {
        const cartEl = document.getElementById('cartSidebar');
        const cartSidebar = new bootstrap.Offcanvas(cartEl);
        cartSidebar.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });

    function showCheckoutModal() {
        if (cart.length === 0) {
            alert('Keranjang masih kosong');
            return;
        }
        // Close cart sidebar first
        const cartEl = document.getElementById('cartSidebar');
        const cartSidebar = bootstrap.Offcanvas.getInstance(cartEl);
        if (cartSidebar) cartSidebar.hide();
        
        // Show order modal after a short delay
        setTimeout(() => {
            new bootstrap.Modal(document.getElementById('orderTypeModal')).show();
        }, 300);
    }

    function processCheckout() {
        if (cart.length === 0) {
            alert('Keranjang masih kosong');
            return;
        }

        const tableNumber = document.getElementById('tableNumber').value;
        const orderNotes = document.getElementById('orderNotes').value;

        if (!tableNumber.trim()) {
            alert('Mohon masukkan nomor kamar/meja');
            return;
        }

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('customer.restaurant.order.place') }}';
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);

        // Send each cart item as proper PHP array fields
        cart.forEach(function(item, index) {
            const menuIdInput = document.createElement('input');
            menuIdInput.type = 'hidden';
            menuIdInput.name = 'items[' + index + '][menu_id]';
            menuIdInput.value = item.menu_id;
            form.appendChild(menuIdInput);

            const qtyInput = document.createElement('input');
            qtyInput.type = 'hidden';
            qtyInput.name = 'items[' + index + '][quantity]';
            qtyInput.value = item.quantity;
            form.appendChild(qtyInput);
        });

        const typeInput = document.createElement('input');
        typeInput.type = 'hidden';
        typeInput.name = 'order_type';
        typeInput.value = 'dine_in';
        form.appendChild(typeInput);

        const tableInput = document.createElement('input');
        tableInput.type = 'hidden';
        tableInput.name = 'table_number';
        tableInput.value = tableNumber;
        form.appendChild(tableInput);

        if (orderNotes) {
            const orderNotesInput = document.createElement('input');
            orderNotesInput.type = 'hidden';
            orderNotesInput.name = 'notes';
            orderNotesInput.value = orderNotes;
            form.appendChild(orderNotesInput);
        }

        document.body.appendChild(form);
        form.submit();
    }

    // Store menus data for JavaScript
    const menusData = @json($menus->keyBy('id')->toArray());
    
    function addToCart(menuId, btn) {
        const item = menusData[menuId];
        
        if (!item) return;

        const existingItem = cart.find(i => i.menu_id === menuId);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({
                menu_id: menuId,
                name: item.name,
                price: item.price,
                quantity: 1
            });
        }

        updateCartUI();
        updateCartCount();
        
        // Show feedback on button
        if (btn) {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-check"></i> OK';
            btn.style.background = '#22c55e';
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = '';
            }, 800);
        }
    }

    function removeFromCart(menuId) {
        cart = cart.filter(i => i.menu_id !== menuId);
        updateCartUI();
        updateCartCount();
    }

    function updateCartUI() {
        const cartItems = document.getElementById('cartItems');
        const cartTotal = document.getElementById('cartTotal');
        
        if (cart.length === 0) {
            cartItems.innerHTML = '<div class="text-center py-5"><i class="bi bi-cart-x" style="font-size: 3rem; color: #ddd;"></i><p class="text-muted mt-2">Keranjang kosong</p></div>';
            cartTotal.textContent = 'Rp 0';
            return;
        }

        let html = '<div class="list-group list-group-flush">';
        let total = 0;

        cart.forEach(item => {
            const subtotal = item.price * item.quantity;
            total += subtotal;
            html += `
                <div class="list-group-item px-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <strong>${item.name}</strong><br>
                            <small class="text-muted">Rp ${item.price.toLocaleString('id-ID')} x ${item.quantity}</small>
                        </div>
                        <div class="text-end ms-2">
                            <div class="fw-bold">Rp ${subtotal.toLocaleString('id-ID')}</div>
                            <button class="btn btn-sm btn-outline-danger mt-1" onclick="removeFromCart(${item.menu_id})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });

        html += '</div>';
        cartItems.innerHTML = html;
        cartTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    function updateCartCount() {
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);
        const el = document.getElementById('cartCount');
        if (el) el.textContent = count;
    }

    // Category filter
    document.querySelectorAll('.category-badge').forEach(badge => {
        badge.addEventListener('click', function() {
            document.querySelectorAll('.category-badge').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const category = this.dataset.category;
            document.querySelectorAll('.menu-item').forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush