@extends('admin.layout.app')

@section('heading', 'Sidebar Advertisements create')

@section('button')
  <a href="{{route('admin_sidebar_ad_show')}}" class="btn btn-primary"> View</a>
@endsection

@section('main_content')

<div class="section-body">
  <form action="{{route('admin_sidebar_ad_store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <div class="form-group mb-3">
              <label>Change Photo</label>
              <div>
                <input type="file" name="sidebar_ad">
              </div>
            </div>
            <div class="form-group mb-3">
              <label>URL</label>
              <input type="text" class="form-control" name="sidebar_ad_url" value="">
            </div>
            <div class="form-group mb-3">
              <label>Status</label>
              <select name="sidebar_ad_location" class="form-control">
                <option value="Top">Top</option>
                <option value="Bottom">Bottom</option>
              </select>
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
