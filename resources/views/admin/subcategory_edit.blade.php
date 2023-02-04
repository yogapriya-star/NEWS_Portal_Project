@extends('admin.layout.app')

@section('heading', 'Edit SubCategory')

@section('button')
  <a href="{{route('admin_subcategory_show')}}" class="btn btn-primary"> View</a>
@endsection

@section('main_content')

<div class="section-body">
  <form action="{{route('admin_subcategory_update',$subcategory_data->id)}}" method="post">
    @csrf
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <div class="form-group mb-3">
              <label>Category Name</label>
              <div>
                <input type="text" class="form-control" name="sub_category_name" value="{{$subcategory_data->sub_category_name}}">
              </div>
            </div>
            <div class="form-group mb-3">
              <label>Show on menu?</label>
              <select name="show_on_menu" class="form-control">
                <option value="Show" @if($subcategory_data->show_on_menu == 'Show') selected @endif>Show</option>
                <option value="Hide" @if($subcategory_data->show_on_menu == 'Hide') selected @endif>Hide</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label>Category Order</label>
              <div>
                <input type="text" class="form-control" name="sub_category_order" value="{{$subcategory_data->sub_category_order}}">
              </div>
            </div>
            <div class="form-group mb-3">
              <label>Select Category</label>
              <div>
              <select name="category_id" class="form-control">
                @foreach($categories as $row)
                  <option value ="{{$row->id}}" @if($subcategory_data->category_id == $row->id) selected @endif> {{$row->category_name}}</option>
                @endforeach
              </select>
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
