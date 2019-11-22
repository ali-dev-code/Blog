@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">
        {{ isset($category) ? 'Update Category':'Create Category' }}
    </div>
    <div class="card-body">
        @include('partials.errors')
        <form action=" {{ isset($category) ? route('categories.update', $category->id)  : route('categories.store') }} "
           method="post">
            @csrf
            @if (isset($category))
            @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" id="name" name="name"
                value="{{ isset($category) ? $category->name : '' }}">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="button">
                  {{ isset($category) ? 'Update' : 'Add' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
