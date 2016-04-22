@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Template List</h2>
        <a href="{{ route('template.create') }}">New Background</a>
        <div>
            @foreach($templates as $template)
            <div class="panel panel-primary" style="display: inline-block;">
                <div class="panel-heading">
                    {{ $template->name }}
                </div>
                <div class="panel-body" style="height: 230px;">
                    <img src="{{ config('app.options.path.upload_template') . $template->image_path }}" style="width: auto; height: 200px;">
                    {{-- <div>{{ $template->options }}</div> --}}
                </div>
                <div class="panel-footer" style="">

                    <a href="{{ route('template.show', $template) }}">Show</a>&nbsp;|&nbsp;
                    <a href="{{ route('template.edit', $template) }}">Edit</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
