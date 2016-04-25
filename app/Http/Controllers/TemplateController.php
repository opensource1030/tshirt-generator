<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;
use Session;

class TemplateController extends Controller
{
    //

    public function __construct() {
//        $this->middleware('auth');
    }

    public function index(Request $request) {
        $templates = Template::all();
        Session::forget('output');
        return view('templates.index', ['templates' => $templates ]);
    }

    public function show(Request $request) {
        $template = Template::find($request->template);
        $image = Session::get('image');
        $output = url('/') . '/' . config('app.options.path.upload_template') . $template->image_path;
        if (Session::get('output')) {
            $output = url('/') . '/' . config('app.options.path.upload_image') . Session::get('output');
        }
        return view('templates.show', ['template' => $template, 'image' => $image, 'output' => $output]);
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

        return redirect()->route('template.show', ['tempalte' => $request->template]);
    }

    public function create(Request $request) {
        $template = new Template();
        return view('templates.create', ['template' => $template]);
    }

    public function store(Request $request) {
        $filename = '';
        if ($request->file('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName(); // . '.' . $image->getClientOriginalExtension();
            $path = public_path(config('app.options.path.upload_template'));
            $image->move($path, $filename);
        }

        $template = Template::create([
            'name'          => $request->name,
            'options'       => $request->options,
            'image_path'    => $filename,
        ]);

        return redirect()->route('template.show', ['tempalte' => $request->template]);
    }

    public function change_image(Request $request) {
        // print_r('change image');
        if ($request->file('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName(); // . '.' . $image->getClientOriginalExtension();
            $path = public_path(config('app.options.path.upload_image'));
            $image->move($path, $filename);
            // print_r($path);

            if (Session::get('image')) {
                File::delete($path . '/' . Session::get('image'));
            }
            Session::put('image', $filename);
        } else {
          // print_r('no file attached');
        }

        // $template = ['id' => $request->template];
        return redirect()->route('template.show', ['tempalte' => $request->template]);
    }

    public function apply_image(Request $request) {
        // $template = Template::find($request->template);
        $image = Session::get('image');
        // $path = '/Volumes/WORK/project/Carl/imagick/info';
        $path = public_path();
        // $template_path = $path . '/' . config('app.options.path.upload_template') . $template->image_path;
        $template_id = $request->template;
        $image_path = $path . '/' . config('app.options.path.upload_image') . $image;
        // $output_path = $path . '/' . config('app.options.path.upload_image') . 'output.jpg';
        // $apply_command = './tshirt -r "130x130+275+175" -R -3 -o 5,0 -E ' . $image_path . ' ' . $template_path . ' ' . $output_path;
        // // cd /Volumes/WORK/project/Carl/imagick/info && ./tshirt -r "130x130+275+175" -R -3 -o 5,0 -E flowers_van_gogh.jpg tshirt_gray.jpg export.jpg
        // $command = 'cd ' . $path . ' && cd .. && ' . $apply_command;
        // $output = exec($command);
        // print_r($output);

        $originalInput = \Request::input();
        $request = \Request::create(route('api.v1.templates.apply_image'), 'POST');
        \Request::replace(['template_id' => $template_id, 'image_path' => $image_path]);
        // \Request::replace($request->input());
        $response = \Route::dispatch($request);
        $instance = json_decode(\Route::dispatch($request)->getContent());
        Session::put('output', $instance->data->output->filename);
        // var_dump($instance);
        // \Request::replace($originalInput);
        // var_dump($originalInput);
        return redirect()->route('template.show', ['tempalte' => $template_id]);
    }
}
