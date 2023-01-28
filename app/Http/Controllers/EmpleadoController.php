<?php

namespace App\Http\Controllers;

use App\Models\empleado;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['empleados'] = Empleado::paginate(5);

        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $campos=([

            'Nombre'=>'required|string|max:100',

            'ApellidoPaterno'=>'required|string|max:100',
            
            'ApellidoMaterno'=>'required|string|max:100',

            'Correo'=>'required|email',

            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',

        ]);

$mensaje=([

            'required'=>'El :attribute es requerido',

            'Foto.required'=>'La foto es requerida',

        ]);



$this->validate($request, $campos, $mensaje);

        // Metodo para manejar un POST

        $datosEmpleados = request()->except('_token');



        if($request->hasFile('Foto')){

            $datosEmpleados['Foto']=$request->file('Foto')->store('uploads','public');

        }



        Empleado::insert($datosEmpleados); // Inserto los datos en la BD



        return redirect('empleado')->with('mensaje', 'Empleado creado con éxito.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // Método para manejar un GET a empleado/{id_empleado}/edit

        $empleado = Empleado::findOrFail($id);

        return view('empleado.edit', compact('empleado'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       //Validación de campos:

        $campos=([

            'Nombre'=>'required|string|max:100',

            'ApellidoPaterno'=>'required|string|max:100',

            'ApellidoPaterno'=>'required|string|max:100',

            'Correo'=>'required|email',

            

        ]);

        $mensaje=[

            'required'=>'El :attribute es requerido',

        ];

         if($request->hasFile('Foto')){  
            $campos=['Foto' => 'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=['Foto.required'=>'La foto es requerida'];    

        }

        $this->validate($request, $campos, $mensaje);

            $datosEmpleado = Request()->except(['_token', '_method']);
    
            if($request->hasFile('Foto')){
    
                $empleado = Empleado::findOrFail($id);
    
                Storage::delete('public/'.$empleado->Foto);
    
                $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads','public');
    
            }
    
            Empleado::where('id','=', $id)->update($datosEmpleado);
    
            $empleado = Empleado::findOrFail($id);
    
            //return view('empleado.edit', compact('empleado'));
            return redirect('empleado')-> with('mensaje','Empleado modificado con exito!');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\empleado  $empleado
     * @return \Illuminate\Http\Response
     */
   
    public function destroy($id)
   {
        $empleado = Empleado::findOrFail($id);

        if(storage::delete('public/'.$empleado->Foto)){
            Empleado::destroy($id);
        }
        
        return redirect('empleado')-> with('mensaje','Empleado borrado con exito!');
    
    }


}