@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Template: {{ $template->name }}</h2>
        <div>
{{--            <img src="{{ url(config('app.options.path.upload_template') . $template->image_path) }}">--}}
            <img src="file://{{ public_path((config('app.options.path.upload_template')) . '/' . $template->image_path) }}" style="width: 300px; height: auto;">
        </div>
        <a href="{{ route('template.edit', $template) }}">Edit</a>
    </div>
@endsection