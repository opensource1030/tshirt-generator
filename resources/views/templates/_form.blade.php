{{ csrf_field() }}
<div class="form-group">
    <label>Upload Image</label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ $template->name }}" required>
</div>
<div class="form-group">
    <label>Options</label>
    <textarea name="options" class="form-control">{{ $template->options }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $submitButton }}</button>
</div>
