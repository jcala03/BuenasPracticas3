<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class InteresesController extends Controller
{
    public function index()
    {
        return view('vistas.vistauno');
    }

    public function calcular(Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric|min:1',
            'meses' => 'required|integer|min:1',
            'fecha_nacimiento' => 'required|date',
        ]);

        $tasaMensual = 0.0171; 
        
        $cuota = $request->monto * ($tasaMensual * pow(1 + $tasaMensual, $request->meses)) 
               / (pow(1 + $tasaMensual, $request->meses) - 1);


        $edad = Carbon::parse($request->fecha_nacimiento)->age;

        return view('vistas.vistauno', [
            'cuota' => round($cuota, 2),
            'monto' => $request->monto,
            'meses' => $request->meses,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'edad' => $edad
        ]);
    }
}
