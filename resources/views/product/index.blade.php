@extends('layouts.app')
@section('content')
<div class="container">
    @include('helpers.flash-messages')
    <div class="row align-items-center mb-3">
        <div class="col">
            <h1 class="h3 mb-0">{{ __('product.Product list') }}</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('product.create') }}" class="btn btn-primary">{{ __('product.Add') }}</a>
        </div>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('product.Name') }}</th>
                    <th scope="col">{{ __('product.Description') }}</th>
                    <th scope="col">{{ __('product.Amount') }}</th>
                    <th scope="col">{{ __('product.Price') }}</th>
                    <th scope="col">{{ __('product.Category') }}</th>
                    <th scope="col">{{ __('product.Actions') }}</th>
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
                        @if($product->hasCategory())
                            {{ $product->category->name }}
                        @else
                            <em>Brak kategorii</em>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('product.show', $product->id) }}">
                            <button class="btn btn-primary btn-sm">{{ __('product.Show') }}</button>
                        </a>
                        <a href="{{ route('product.edit', $product->id) }}">
                            <button class="btn btn-success btn-sm">{{ __('product.Edit') }}</button>
                        </a>
                        <button class="btn btn-danger btn-sm delete" data-id="{{ $product->id }}">{{ __('product.Delete') }}</button>
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