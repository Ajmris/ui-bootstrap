@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row align-items-center mb-3">
        <div class="col">
            <h1 class="h3 mb-0">Lista produktów</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('product.create') }}" class="btn btn-primary">Dodaj</a>
        </div>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Opis</th>
                    <th scope="col">Ilość</th>
                    <th scope="col">Cena</th>
                    <th scope="col">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->amount}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                        <a href="{{ route('product.show', $product->id) }}">
                            <button class="btn btn-primary btn-sm">P</button>
                        </a>
                        <a href="{{ route('product.edit', $product->id) }}">
                            <button class="btn btn-success btn-sm">E</button>
                        </a>
                        <button class="btn btn-danger btn-sm delete" data-id="{{ $product->id }}">X</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</div>
@endsection
@section('javascript')
<script>
    const deleteURL="{{url('product')}}/";
    </script>
    @vite('resources/js/delete.js')
@endsection