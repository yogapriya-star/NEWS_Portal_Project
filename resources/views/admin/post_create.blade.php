@extends('admin.layout.app')

@section('heading', 'Create Post')

@section('button')
  <a href="{{route('admin_post_show')}}" class="btn btn-primary"> View</a>
@endsection

@section('main_content')

<div class="section-body">
  <form action="{{route('admin_post_store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group mb-3">
              <label>Post Title</label>
              <div>
                <input type="text" class="form-control" name="post_title" value="">
              </div>
            </div>
            <div class="form-group mb-3">
              <label>Post Detail</label>
              <div>
                <textarea name="post_detail" class="form-control snote" cols="30" rows="10"></textarea>
              </div>
            </div>
            <div class="form-group mb-3">
              <label>Post Photo</label>
              <div>
                <input type="file" name="post_photo">
              </div>
            </div>
            <div class="form-group mb-3">
              <label>Select Sub Category</label>
              <div>
              <select name="sub_category_id" class="form-control select2">
                @foreach($sub_categories as $item)
                  <option value ="{{$item->id}}"> {{$item->sub_category_name}} ({{$item->category->category_name}})</option>
                @endforeach
              </select>
              </div>
            </div>
            <div class="form-group mb-3">
              <label>Is Sharable?</label>
              <select name="is_share" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label>Is Comment?</label>
              <select name="is_comment" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label>Tags</label>
              <div>
                <input type="text" class="form-control" name="tags" value="">
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
