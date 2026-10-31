@extends('layouts.app')

@section('content')
<x-form-card title="Nhập điểm">
    <form method="POST" action="{{ route('admin.scores.store') }}">
        @csrf
        @include('admin.scores.form')
    </form>
</x-form-card>
@endsection
