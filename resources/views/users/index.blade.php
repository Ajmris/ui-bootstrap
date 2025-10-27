@extends('layouts.app')
@section('content')
<div class="container">
    @include('helpers.flash-messages')
    <div class="row align-items-center mb-3">
        <div class="col">
            <h1 class="h3 mb-0">{{ __('actions.user title') }}</h1>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Email</th>
                <th scope="col">Phone number</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->surname}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone_number}}</td>
                <td>
                    <button class="btn btn-danger btn-sm delete" data-id="{{ $user->id }}">X</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
@section('javascript')
<script>
    const deleteURL="{{url('users')}}/";
    </script>
    @vite('resources/js/delete.js')
@endsection