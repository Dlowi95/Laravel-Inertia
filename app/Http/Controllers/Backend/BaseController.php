<?php 
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Enums\CommonEnum;
use Illuminate\Support\Facades\Lang;

class BaseController extends Controller{

    protected $service;

    public function __construct(
        $service
    )
    {
        $this->service = $service;
    }

    public function handleAction($request, $response, string $redirectRoute = ''): RedirectResponse{
        if($response){
            if($request->input(CommonEnum::SAVE_AND_REDIRECT)){
                return redirect()->intended(route($redirectRoute, absolute: false));
            }
            return back();
        }
        return back()->with('error', Lang::get('messages.save_failed'));
    }
}