<?php

namespace App\Http\Controllers\Api;

use Image;
use Throwable;
use App\Models\WebsiteSetting;
use App\Http\Controllers\Controller;
use App\Http\Resources\GlobalResource;
use App\Repositories\CommonRepository;
use App\Traits\Helpers\ApiResponseTrait;
use App\Http\Requests\WebsiteSettingRequest;

class WebsiteSettingController extends Controller
{
    use  ApiResponseTrait;

    protected CommonRepository $repository;

    public function __construct(private WebsiteSetting $websiteSetting)
    {
        $this->repository = new CommonRepository($websiteSetting);
    }

    public function index(){
        $settings = WebsiteSetting::all();

        return GlobalResource::collection($settings);
    }

    public function  store(WebsiteSettingRequest $request): mixed
    {
        try {
            $image = get_image_from_unsplash($request->header_background_image);
            $validated = $request->validated();
            $imageName = time() . '.' . $image->extension();
            $request->image->storeAs('images', $imageName);
            $data = $request->only(['name','website','facebook','twitter','instagram','logo']);
            $imageContent = file_get_contents($image);
            \Illuminate\Support\Facades\Storage::disk('public')->put('image.jpeg',$imageContent);
            $data['header_background_image'] = 'storage/image.jpeg';
            $websitesetting = WebsiteSetting::updateOrCreate( ['id' => 1],$data);
            return new GlobalResource($websitesetting);
        } catch (Throwable $e) {
            return $this->respondError($e->getMessage());
        }
    }

    public function show(WebsiteSetting $websiteSetting){
        return $websiteSetting;
    }
}
