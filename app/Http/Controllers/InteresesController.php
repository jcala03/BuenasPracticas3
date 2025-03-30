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
            'meses' => 'required|integer|min:1|max:120', // Máximo 10 años
            'fecha_nacimiento' => 'required|date',
            'tasa' => 'required|numeric|min:0.1|max:100' // Tasa mensual en %
        ]);

        $edad = Carbon::parse($request->fecha_nacimiento)->age;
        
        if ($edad < 18) {
            return back()->withErrors(['fecha_nacimiento' => 'Debes ser mayor de 18 años'])->withInput();
        }

        $tasaMensual = $request->tasa / 100;
        $monto = $request->monto;
        $meses = $request->meses;
        

        $cuota = $monto * ($tasaMensual * pow(1 + $tasaMensual, $meses)) 
               / (pow(1 + $tasaMensual, $meses) - 1);


        $tablaAmortizacion = [];
        $saldo = $monto;
        
        for ($i = 1; $i <= $meses; $i++) {
            $interes = $saldo * $tasaMensual;
            $capital = $cuota - $interes;
            

            if ($i == $meses) {
                $capital = $saldo;
                $cuota = $interes + $capital;
                $saldo = 0;
            } else {
                $saldo -= $capital;
            }
            
            $tablaAmortizacion[] = [
                'mes' => $i,
                'saldo' => $saldo,
                'interes' => $interes,
                'capital' => $capital,
                'cuota' => $cuota
            ];
        }

        return view('vistas.vistauno', [
            'cuota' => round($cuota, 2),
            'monto' => $monto,
            'meses' => $meses,
            'edad' => $edad,
            'tasa' => $request->tasa,
            'tablaAmortizacion' => $tablaAmortizacion
        ]);
    }
}