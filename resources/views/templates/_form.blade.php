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
    <textarea name="options" class="form-control" style="visibility: hidden; height: 0;">{{ $template->options }}</textarea>
    <div class="json-editor"></div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary template-edit-btn">{{ $submitButton }}</button>
</div>

<style>
    .json-editor label span { display: inline-block; width: 100px; margin-right: 10px; text-align: right; }
</style>

<script type="text/javascript">
$(function () {
    var jsonEditor = $("form .json-editor").empty().jsonEdit({
        data: JSON.parse($("form textarea[name='options']").val()),
        schema: {
            width: { label: "width", type: "number" },
            height: { label: "height", type: "number" },
            left: { label: "left", type: "number" },
            top: { label: "top", type: "number" },
        }
        // eval($("textarea[name='options']").val());
    });

    $("form button.template-edit-btn").bind("click", function (e) {
        console.log("submit button clicked");
        $("form textarea[name='options']").val(JSON.stringify(jsonEditor.getData()))
        // e.preventDefault();
    });
});
</script>
