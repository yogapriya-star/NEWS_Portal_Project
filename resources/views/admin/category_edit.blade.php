@extends('admin.layout.app')

@section('heading', 'Edit Category')

@section('button')
  <a href="{{route('admin_category_show')}}" class="btn btn-primary"> View</a>
@endsection

@section('main_content')

<div class="section-body">
  <form action="{{route('admin_category_update',$category_data->id)}}" method="post">
    @csrf
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
          <div class="form-group mb-3">
            <label>Category Name</label>
            <div>
              <input type="text" class="form-control" name="category_name" value="{{$category_data->category_name}}">
            </div>
          </div>
            <div class="form-group mb-3">
              <label>Status</label>
              <select name="show_on_menu" class="form-control">
                <option value="Show" @if($category_data->show_on_menu == 'Show') selected @endif>Show</option>
                <option value="Hide" @if($category_data->show_on_menu == 'Hide') selected @endif>Hide</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label>Category Order</label>
              <div>
                <input type="text" class="form-control" name="category_order" value="{{$category_data->category_order}}">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
  </form>
</div>
@endsection
