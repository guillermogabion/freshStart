<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registrar;
class RegistrarController extends Controller
{
    //

    public function indexPrograms(){
        return Registrar::get();
    }
    public function ProgramsAdd(Request $request){
        $program = New Registrar;
        $program->program_id = $request->program_id;
        $program->program = $request->program;
        $program->description = $request->description;
        $program->save();
        return $program;
    }
    public function ProgramsUpdate(Request $request, $id){
        $program = Registrar::findorfail($id);
        $program->program_id = $request->program_id;
        $program->program = $request->program;
        $program->description = $request->description;
        return 'Update Success';
    }
}
