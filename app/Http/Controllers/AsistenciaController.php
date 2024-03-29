<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Miembro;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
/**
 * Class AsistenciaController
 * @package App\Http\Controllers
 */
class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asistencias = Asistencia::paginate();

        return view('asistencia.index', compact('asistencias'))
            ->with('i', (request()->input('page', 1) - 1) * $asistencias->perPage());
    }

    public function reportes()
    {
        return view('asistencia.reportes');
    }

    public function pdf()
    {
        $asistencias = Asistencia::paginate();
        $pdf = Pdf::loadView('asistencia.pdf', ['asistencias'=>$asistencias]);
        return $pdf->stream();
    }
    public function pdf_fechas(Request $request)
    {
        $fi= $request->fi;
        $ff= $request->ff;
        // CONSULTA PARA VER LAS FECHAS DE RANGO A RANGO
        $asistencias = Asistencia::where('fecha','>=',$fi)->where('fecha','<=',$ff)->get();
        // PARA CONVERTIR EN PDF
        $pdf = Pdf::loadView('asistencia.pdf', ['asistencias'=>$asistencias]);
        return $pdf->stream();
        // return view('asistencia.pdf_fechas', ['asistencias'=>$asistencias]);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asistencia = new Asistencia();
        $miembros = Miembro::pluck('nombre_apelllido','id');
        return view('asistencia.create', compact('asistencia','miembros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Asistencia::$rules);

        $asistencia = Asistencia::create($request->all());

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asistencia = Asistencia::find($id);

        return view('asistencia.show', compact('asistencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asistencia = Asistencia::find($id);
        $miembros = Miembro::pluck('nombre_apelllido','id');
        return view('asistencia.edit', compact('asistencia','miembros'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Asistencia $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        request()->validate(Asistencia::$rules);

        $asistencia->update($request->all());

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $asistencia = Asistencia::find($id)->delete();

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia deleted successfully');
    }
}
