<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;

class TemplateController extends Controller
{
    //

    public function __construct() {
//        $this->middleware('auth');
    }

    public function index(Request $request) {
        $templates = Template::all();
        return view('templates.index', ['templates' => $templates ]);
    }

    public function show(Request $request) {
        $template = Template::find($request->template);
        return view('templates.show', ['template' => $template]);
    }

    public function edit(Request $request) {
//        print_r(config('app.options.path.upload_template'));
        $template = Template::find($request->template);
        return view('templates.edit', ['template' => $template]);
    }

    public function update(Request $request) {
        $template = Template::find($request->template);

        if ($request->file('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName(); // . '.' . $image->getClientOriginalExtension();
            $path = public_path(config('app.options.path.upload_template'));
            $image->move($path, $filename);

            if ($template->image_path) {
                File::delete($path . '/' . $template->image_path);
            }
            $template->image_path = $filename;
        }

        $template->name = $request->name;
        $template->options = $request->options;
        $template->save();

        return view('templates.show', ['template' => $template]);
    }

    public function create(Request $request) {
        $template = new Template();
        return view('templates.create', ['template' => $template]);
    }

    public function store(Request $request) {

        $filename = '';

        /*if (Input::file()) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path(config('app.options.path.upload_template')) . $filename;
            $image->move($path);
        }*/

        $template = Template::create([
            'name'          => $request->name,
            'options'       => $request->options,
            'image_path'    => $filename,
        ]);

        return view('templates.show', array(
            'template' => $template
        ));
    }
}