@extends('layouts.admin.layout')

@section('title', $title)

@section('content')
<div class="container">
    <h2>{{ $title }}</h2>

    <form method="POST" action="{{ route('employees.update', $employee->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('employees.form')
    </form>
</div>
@endsection
