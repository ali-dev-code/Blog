@extends('layouts.app')

@section('content')



            <div class="card">
                <div class="card-header">My profile</div>

                <div class="card-body">

                  @include('partials.errors')

                  <form  action="{{ route('users.update-profile') }}"  method="post" >
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                      <label for="name"></label>
                      <input type="text" name="name" class="form-control" value="{{ $users->name}}"  id="name">
                    </div>

                    <div class="form-group">
                      <label for="about"></label>
                      <textarea name="about" id="about" class="form-control" rows="5" cols="5">{{ $users->about }}</textarea>
                    </div>

                    <div class="form-group">
                      <button class="btn btn-success " type="submit"  name="button">Update</button>
                    </div>

                  </form>


                </div>
            </div>



@endsection
