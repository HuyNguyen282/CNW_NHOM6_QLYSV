@extends('layouts.app')

@section('content')
<x-form-card title="Sửa điểm">
    <form method="POST" action="{{ route('admin.scores.update', $score) }}">
        @csrf
        @method('PUT')
        @include('admin.scores.form')
    </form>
</x-form-card>
@endsection
