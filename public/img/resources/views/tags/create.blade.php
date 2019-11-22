@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">
        {{ isset($tag) ? 'Update tag':'Create tag' }}
    </div>
    <div class="card-body">
      @include('partials.errors')
        <form action=" {{ isset($tag) ? route('tags.update', $tag->id)  : route('tags.store') }} "
           method="post">
            @csrf
            @if (isset($tag))
            @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" id="name" name="name"
                value="{{ isset($tag) ? $tag->name : '' }}">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="button">
                  {{ isset($tag) ? 'Update' : 'Add' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
