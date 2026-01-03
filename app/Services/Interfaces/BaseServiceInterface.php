<?php 
namespace App\Services\Interfaces;
use Illuminate\Http\Request;
interface BaseServiceInterface{
    public function save(Request $request, ?int $id = null);
}