@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="row">
                  <div class="col-11">
                  <span>
                      Category
                    </span>
                  </div>
                  <div class="col">
                    <a href="/admin/categories" class="btn-sm btn-danger">Back</a>
                  </div>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Name</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="name" value="{{$category->name}}">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection