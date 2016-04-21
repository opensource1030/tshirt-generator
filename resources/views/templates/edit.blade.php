@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>New Template</h2>
        <form action="{{ route('template.update', $template) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <input name="_method" type="hidden" value="PUT" />
            @include('templates._form', ['submitButton' => 'Update'])
        </form>
    </div>
@endsection