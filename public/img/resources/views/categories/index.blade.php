@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-end mb-2">
      <a  class="btn btn-success float-right" href="{{ route('categories.create') }}">Add Category</a>
  </div>
  <div class="card card-default">
    <div class="card-header">
      Categories
    </div>
    <div class="card-body">
      <table class="table ">
        <thead >
          <tr>
            <th>Name</th>
            <th>Posts Count</th>
            <th></th>
          </tr>
        </thead>
        <tbody>

            @foreach ($categories as $category)
              <tr>
              <td>
                {{  $category->name  }}

              </td>

              <td> {{  $category->posts->count() }} </td>

              <td>  <a class="btn btn-warning btn-sm" href="{{ route('categories.edit', $category->id)  }}">Edit</a>
              <button class="btn btn-danger btn-sm"  onclick=" handleDelete({{ $category->id }}) " name="button">Delete</button>
              </td>
            @endforeach
          </tr>
        </tbody>
      </table>
      <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <form action="" method="post" id="deleteCategoryForm">
      @csrf
      @method('DELETE')

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <p class="text-center text-bold" > Are you sure you want to delete this category? </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
          <button type="submit" class="btn btn-danger">Yes Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>
    </div>
  </div>
@endsection

@section('script')

<script>
  function handleDelete(id){

    var form = document.getElementById('deleteCategoryForm')
    form.action = '/categories/'+ id
  //  console.log('deleting', form)
    $('#deleteModal').modal('show')
  }
</script>

@endsection
