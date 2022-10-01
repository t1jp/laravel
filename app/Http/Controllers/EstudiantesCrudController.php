<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estudiantes;
use App\Models\tipos_sangre;

class EstudiantesCrudController extends Controller
{
    public function index()
    {
        $data['student']=estudiantes::join('tipos_sangres','estudiantes.id_tipos_sangre','=','tipos_sangres.id')->get(['estudiantes.*','tipos_sangres.sangre']);
        $data['blood']=tipos_sangre::all();
        return view('CRUD.index',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'txt_carne' => 'required',
            'txt_nombres' => 'required',
            'txt_apellidos' => 'required',
            'txt_direccion' => 'required',
            'txt_telefono' => 'required',
            'txt_correo' => 'required',
            'drop_sangre' => 'required',
            'txt_fn' => 'required'
        ]);
        $student=new estudiantes();
        $student->carne=$request->txt_carne;
        $student->nombres=$request->txt_nombres;
        $student->apellidos=$request->txt_apellidos;
        $student->direccion=$request->txt_direccion;
        $student->telefono=$request->txt_telefono;
        $student->correo_electronico=$request->txt_correo;
        $student->id_tipos_sangre=$request->drop_sangre;
        $student->fecha_nacimiento=$request->txt_fn;
        $student->save();
        return redirect()->route('CRUD.index')->with('success','Estudiante agregado correctamente');
    }
    public function update(Request $request,$id)
    {

        $request->validate([
            'txt_carne' => 'required',
            'txt_nombres' => 'required',
            'txt_apellidos' => 'required',
            'txt_direccion' => 'required',
            'txt_telefono' => 'required',
            'txt_correo' => 'required',
            'drop_sangre' => 'required',
            'txt_fn' => 'required'
        ]);
        $student=estudiantes::find($id);
        $student->carne=$request->txt_carne;
        $student->nombres=$request->txt_nombres;
        $student->apellidos=$request->txt_apellidos;
        $student->direccion=$request->txt_direccion;
        $student->telefono=$request->txt_telefono;
        $student->correo_electronico=$request->txt_correo;
        $student->id_tipos_sangre=$request->drop_sangre;
        $student->fecha_nacimiento=$request->txt_fn;
        $student->save();
        return redirect()->route('CRUD.index')->with('success','Estudiante Modificado correctamente');
    }
    public function destroy($id)
    {
        $student=estudiantes::find($id);
        $student->delete();
        return redirect()->route('CRUD.index')->with('success','Estudiante Eliminado correctamente');
    }
}
