@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Template</h2>
        <a href="{{ route('template.index') }}">Back to List</a>
        <form action="{{ route('template.update', $template) }}" method="POST" enctype="multipart/form-data" class="">
            <input name="_method" type="hidden" value="PUT" />
            @include('templates._form', ['submitButton' => 'Update'])
        </form>
    </div>
@endsection
