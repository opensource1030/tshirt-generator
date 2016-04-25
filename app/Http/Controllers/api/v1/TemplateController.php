<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\api\ApiController;
use App\Template;

class TemplateController extends ApiController {

    public function __construct(
        ResponseFactory $response,
        Request $request
    ) {
        parent::__construct($response, $request);
    }

    public function index () {
        $templates = Template::all()->toArray();
        return $this->respond($templates);
    }

    public function apply_image () {
        $validator = Validator::make($this->request->all(), [
            'template_id' => 'required',
            'image_path' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->respondWithValidationErrors($validator->errors());
        }

        $template_id = $this->request['template_id'];
        $image_path = $this->request['image_path'];

        $path = public_path();
        $template = Template::find($template_id);
        $template_path = $path . '/' . config('app.options.path.upload_template') . $template->image_path;
        $options = json_decode($template->options);

        $output_path = $path . '/' . config('app.options.path.upload_image') . 'output.jpg';
        $output_url = Url('/') . '/' . config('app.options.path.upload_image') . 'output.jpg';

        // $apply_command = './tshirt -r "' . $options->width . 'x' . $options->height . '+' . $options->left . '+' . $options->top . '" -R -3 -o 5,0 -E ' . $image_path . ' ' . $template_path . ' ' . $output_path;
        // $command = 'cd ' . $path . ' && cd .. && ' . $apply_command;
        $apply_command = "./tshirt -r '{$options->width}x{$options->height}+{$options->left}+{$options->top}' -R -3 -o 5,0 -E {$image_path} {$template_path} {$output_path}";
        $command = "cd $path && cd .. && $apply_command";
        $output = exec($command);

        // return $this->respond(['output' => $apply_command]);
        return $this->respond(['output' => ['result' => $output, 'filename' => 'output.jpg', 'path' => $output_path, 'url' => $output_url]]);
    }
}
