@extends('admin.layout.app')

@section('heading', 'Create Category')

@section('button')
  <a href="{{route('admin_category_show')}}" class="btn btn-primary"> View</a>
@endsection

@section('main_content')

<div class="section-body">
  <form action="{{route('admin_subcategory_store')}}" method="post">
    @csrf
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <div class="form-group mb-3">
              <label>SubCategory Name</label>
              <div>
                <input type="text" class="form-control" name="sub_category_name" value="">
              </div>
            </div>
            <div class="form-group mb-3">
              <label>Show on menu?</label>
              <select name="show_on_menu" class="form-control">
                <option value="Show">Show</option>
                <option value="Hide">Hide</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label>Sub Category Order</label>
              <div>
                <input type="text" class="form-control" name="sub_category_order" value="">
              </div>
            </div>
            <div class="form-group mb-3">
              <label>Select Category</label>
              <div>
              <select name="category_id" class="form-control">
                @foreach($categories as $row)
                  <option value ="{{$row->id}}"> {{$row->category_name}}</option>
                @endforeach
              </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
  </form>
</div>
@endsection
