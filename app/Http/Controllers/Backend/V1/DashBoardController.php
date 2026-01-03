<?php 
namespace App\Http\Controllers\Backend\V1;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashBoardController extends Controller{
    public function __construct()
    {
        
    }
    public function index(){
        return Inertia::render('dashboard');
    }

}