@extends('layouts.app')

@section('content')
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card">
    <div class="card-header">Thêm lớp học mới</div>
    <div class="card-body">
        <form method="post" action="{{ route('admin.classes.store') }}">
            @csrf

            <div class="form-group mb-3">
                <label class="col-sm-2 col-label-form">Tên lớp</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="col-sm-2 col-label-form">Mô tả</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-primary">
                    Thêm lớp học
                </button>
            </div>
        </form>
    </div>
</div>
@endsection