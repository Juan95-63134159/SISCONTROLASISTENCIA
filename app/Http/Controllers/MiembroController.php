<?php
namespace App\Http\Controllers;

// para leer de la base de datos

use App\Models\Miembro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MiembroController extends Controller
{
    //mostrara el index de miembros
    public function index(){
        // ORDENANDO DE FORMA DESCENDENTE LOS REGISTRO MEDIANTE EL 'id'
        $miembros =Miembro::all()->sortByDesc('id');
        return view('miembros.index',['miembros'=>$miembros]);
    }
    //funcion crear miembros

    public function create(){
        return view('miembros.create');
    }

    public function store(Request $request){
        // captura de datos
        // $miembro =request()->all();
        // para mostrar los datos en un json
        // return response()->json($miembro);

        // VALIDACION DESDE BACKEND PARA LOS DATOS
        $request->validate([
            'nombre_apellido' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'fecha_nacimiento' => 'required',
            'email' => 'required',
            'ministerio' => 'required',

        ]);

        // INSERTANDO DATOS A LA BASE DE DATOS
        $miembro= new Miembro();

        $miembro->nombre_apelllido = $request->nombre_apellido;
        $miembro->direccion = $request->direccion;
        $miembro->telefono= $request->telefono;
        $miembro->fecha_nacimiento = $request->fecha_nacimiento;
        $miembro->genero = $request->genero;
        $miembro->email = $request->email;
        $miembro->estado = '1';
        $miembro->ministerio = $request->ministerio;
        
        // $miembro->fotografia = $request->fotografia;
        // ALMACENANDO UN FOTOGRAFIA DENTRO DE NUESTRO PROYECTO en una carpeta FOTOGRAFIA_MIEMBROS
        // VALIDANDO
        if ($request->hasFile('fotografia')) {
            # code...
            $miembro->fotografia = $request->file('fotografia')->store('fotografia_miembros','public');
        }
        //Se Pondra la fecha actual del sistema:
        $miembro->fecha_ingreso =date($format = 'Y-m-d');

        // GUARDANDO LA INFORMACION
        $miembro->save();

        // RETORNANDO AL MIEMBROS/INDEX y devuelve el mensaje 
        return redirect()->route('miembros.index')->with('mensaje','se registro al miembro de la manera correcta');
    }
    // recibimos el id del miembro.index
    public function show($id) {
        // imprimimos la variable $id
        // echo $id;
         // captura de datos
        //  SI NO ENCUENTRA EL REGISTRO, MOSTRAR NO FOUND CON LA FUNCION OrFail
        $miembro =Miembro::findOrFail($id);
        return view('miembros.show',['miembro'=>$miembro]);
        // para mostrar los datos en un json
        // return response()->json($miembro);
    }

    public function edit($id) {
        $miembro =Miembro::findOrFail($id);
        return view('miembros.edit',['miembro'=>$miembro]);
        // para mostrar los datos en un json
    }

    public function update(Request $request, $id){
        // captura de datos
        //$miembro =request()->all();
        // para mostrar los datos en un json
        //return response()->json($miembro);

        $request->validate([
            'nombre_apellido' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'fecha_nacimiento' => 'required',
            'email' => 'required',
            'ministerio' => 'required',

        ]);

        $miembro = Miembro::find($id);

        $miembro->nombre_apelllido = $request->nombre_apellido;
        $miembro->direccion = $request->direccion;
        $miembro->telefono= $request->telefono;
        $miembro->fecha_nacimiento = $request->fecha_nacimiento;
        $miembro->genero = $request->genero;
        $miembro->email = $request->email;
        $miembro->ministerio = $request->ministerio;
        if ($request->hasFile('fotografia')) {
            # code...
            // ANTES DE SUBIR LA FOTOGRAFIA , SE ELIMINARA LA ANTERIOR
            Storage::delete('public/'.$miembro->fotografia);
            // AHORA SE SUBE LA NUEVA IMAGEN
            $miembro->fotografia = $request->file('fotografia')->store('fotografia_miembros','public');
        }
        $miembro->save();

        return redirect()->route('miembros.index')->with('mensaje','se actualizo al miembro de la manera correcta');
    
    }

    public function destroy($id){
        $miembro = Miembro::find($id);
        // ELIMINA PRIMERO LA FOTOGRAFIA
        Storage::delete('public/'.$miembro->fotografia);
        Miembro::destroy($id);
        // ELIMINA TODO EL REGISTRO
        return redirect()->route('miembros.index')->with('mensaje','se elimino al miembro de la manera correcta');

    }
}
