@extends('layouts.app')

@section('content')
    <h2>Nhập điểm</h2>

    <form method="POST" action="{{ route('admin.scores.store') }}">
        @csrf
        @include('admin.scores.form')
    </form>
@endsection
