@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Main Menu</div>
                <div class="card-body">
                   <ul>
                       {{-- <li><a href="{{ route('product.index') }}">Product Master</a></li>
                       <li><a href="{{ route('transaction.index') }}">Transaction Master</a></li> --}}
                   </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
