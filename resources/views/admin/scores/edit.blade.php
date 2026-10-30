@extends('layouts.app')

@section('content')
    <h2>Sửa điểm</h2>

    <form method="POST" action="{{ route('admin.scores.update', $score) }}">
        @csrf
        @method('PUT')
        @include('admin.scores.form')
    </form>
@endsection
