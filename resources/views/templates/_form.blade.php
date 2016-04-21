{{ csrf_field() }}
<div class="form-group">
    <label>Upload Image</label>
    <input type="file" name="image">
</div>
<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" value="{{ $template->name }}" required>
</div>
<div class="form-group">
    <label>Options</label>
    <textarea name="options">{{ $template->options }}</textarea>
</div>
<div class="form-group">
    <button type="submit">{{ $submitButton }}</button>
</div>