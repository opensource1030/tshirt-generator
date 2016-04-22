@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Template: {{ $template->name }}</h2>
        <div>
            <a href="{{ route('template.index') }}">Back to List</a>&nbsp;|&nbsp;
            <a href="{{ route('template.edit', $template) }}">Edit</a>
        </div>
        <div  style="display: inline-block; width: 200px; vertical-align: top;">
            @if ($image != '')
                <img src="{{ url('/') . '/' . config('app.options.path.upload_image') . $image }}" style="width: 100%; height: auto; border: 1px solid #ccc;">
            @endif

            <form action="{{ route('template.show.change_image', $template) }}" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Change Image</button>
                </div>
            </form>

            @if ($image != '')
                <form action="{{ route('template.show.apply_image', $template) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Apply Image</button>
                    </div>
                </form>
            @endif
        </div>
        <div style="display: inline-block; width: 700px;">
            <img src="{{ url('/') . '/' . config('app.options.path.upload_template') . $template->image_path }}" style="width: 100%; height: auto; border: 1px solid #ccc;">
        </div>
    </div>
@endsection
