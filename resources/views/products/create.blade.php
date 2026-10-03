@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="card-title">Add Product</h3>
        
        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="price">Price</label>
                <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                @error('price')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="stock">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
                @error('stock')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="category">Category</label>
                <select name="category" class="form-select">
                    <option value="">Select Category</option>
                    <option value="Canned Goods" @selected(old('category') == 'Canned Goods')>Canned Goods</option>
                    <option value="Instant Noodles" @selected(old('category') == 'Instant Noodles')>Instant Noodles</option>
                    <option value="Beverages" @selected(old('category') == 'Beverages')>Beverages</option>
                    <option value="Alcoholic Beverages" @selected(old('category') == 'Alcoholic Beverages')>Alcoholic Beverages</option>
                    <option value="Snacks" @selected(old('category') == 'Snacks')>Snacks</option>
                </select>
                @error('category')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Save Product</button>
            <a href="{{route('products.index')}}" class="btn btn=secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection





