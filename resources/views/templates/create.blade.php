@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>New Template</h2>
        <form action="{{ route('template.store') }}" method="POST" enctype="multipart/form-data" class="">
            @include('templates._form', ['submitButton' => 'Create'])
        </form>
    </div>
@endsection
