@extends('layouts.admin.layout')

@section('title', $title)

@section('content')
<div class="container">
    <h2>{{ $title }}</h2>

    <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
        @csrf
        @include('employees.form')
    </form>
</div>
@endsection
