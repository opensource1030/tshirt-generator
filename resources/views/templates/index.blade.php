@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Template List</h2>
        <a href="{{ route('template.create') }}">New Background</a>
        <div>
            @foreach($templates as $template)
            <div>
                <div style="display: inline-block; width: 100px; min-height: 100px;">
                    <img src="{{ config('app.options.path.upload_template') . $template->image_path }}">
                </div>
                <div style="display: inline-block;">
                    <div style="font-weight: bold;">{{ $template->name }}</div>
                    <div>{{ $template->options }}</div>
                    <a href="{{ route('template.show', $template) }}">Show</a>&nbsp;|&nbsp;
                    <a href="{{ route('template.edit', $template) }}">Edit</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection