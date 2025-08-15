@extends('layouts.app')
@section('content')
<style>
    /* Tło z fioletowym filtrem */
    .bg-overlay {
        position: relative;
        background: url('/storage/gettyimages-2193152433-2048x2048.webp') no-repeat center center/cover;
        min-height: 100vh;
    }
    .bg-overlay::before {
        content: "";
        position: absolute;
        inset: 0;
        background-color: rgba(128, 0, 128, 0.5); /* fiolet 50% */
        z-index: 0;
    }

    /* Panel boczny */
    .sidebar {
        width: 200px; /* lub mniej, np. 180px */
        min-width: 180px;
        padding: 1rem;
        background-color: rgba(50, 0, 50, 0.8); /* półprzezroczysty fiolet */
        color: yellow;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .sidebar h5 {
        border-bottom: 1px solid #FFD700;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }

    /* Główna treść */
    .main-content {
        color: white;
        padding: 20px;
    }

    /* Pojemnik z sortowaniem */
    .sort-box {
        background-color: #2e2e2e;
        border: 1px solid #555;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
    }

    /* Karty produktów */
    .product-card {
        border: 3px solid rgba(134, 99, 165, 0.89);
        transition: transform 0.3s ease, border 0.3s ease;
        cursor: pointer;
    }
    .product-card img {
        width: 100%;
        height: auto;
        aspect-ratio: 1 / 1;
        object-fit: cover;
    }
    .product-info {
        background-color: #1a1a1a;
        padding: 10px;
        text-align: center;
    }
    .product-info h6 {
        margin: 0;
        font-size: 1rem;
        color: white;
    }
    .product-info p {
        color: #FFD700;
        margin: 0;
    }
    .product-card:hover {
        transform: scale(1.05);
        border: 8px solid rgba(189, 0, 247, 0.89);
        box-shadow: 0 4px 15px rgba(201, 0, 201, 0.5);
        z-index: 10;
    }
    .welcome-text {
        text-align: center;
        font-size: 2.5rem; /* większy rozmiar */
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #fff; /* dostosuj kolor */
    }
    .welcome-subtext {
        text-align: center;
        font-size: 1.25rem;
        color: #eee;
        margin-bottom: 2rem;
    }
</style>

<div class="bg-overlay">
    <div class="container-fluid position-relative" style="z-index: 1;">
        <div class="row">
            <!-- Panel boczny -->
            <div class="col-md-2 sidebar">
                <h5>Produkty</h5>
                <span>Ilość: {{ count($products) }}</span>

                <h5>Kategorie</h5>
                <ul class="list-unstyled">
                    <li>Monitory</li>
                    <li>Myszki</li>
                    <li>Pady</li>
                    <li>Klawiatury</li>
                    <li>Podzespoły do komputera</li>
                    <li>Akcesoria</li>
                    <li>Fotele</li>
                </ul>

                <h5>Cena</h5>
                <form>
                    <div class="mb-2">
                        <input type="number" class="form-control form-control-sm" placeholder="Od">
                    </div>
                    <div>
                        <input type="number" class="form-control form-control-sm" placeholder="Do">
                    </div>
                </form>
            </div>

            <!-- Główna część -->
            <div class="col-md-9 main-content">
                <div class="welcome-text">
                    <h1>Witaj Gościu!</h1>
                    <p class="welcome-subtext">Sklep ui-bootstrap – najlepsze ceny, najlepszy sprzęt, najlepszy deal $$</p>
                </div>

                <!-- Sortowanie -->
                <div class="sort-box d-flex justify-content-between align-items-center">
                    <div>
                        Sortuj według:
                        <select class="form-select form-select-sm d-inline-block w-auto">
                            <option>Najpopularniejsze</option>
                            <option>Najtańsze</option>
                            <option>Najdroższe</option>
                        </select>
                    </div>
                    <div>
                        Widok:
                        <select class="form-select form-select-sm d-inline-block w-auto">
                            <option>4</option>
                            <option>8</option>
                            <option>12</option>
                        </select>
                    </div>
                </div>

                <!-- Lista produktów -->
                <div class="row g-4">
    @foreach($products ?? [] as $product)
        <div class="col-md-3">
            <div class="product-card">
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('storage/products/no-image.jpg') }}" alt="Brak zdjęcia">
                @endif
                <div class="product-info">
                    <h6>{{ $product->name }}</h6>
                    <p>{{ number_format($product->price, 2) }} zł</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Dodaj linki do paginacji -->
{{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection