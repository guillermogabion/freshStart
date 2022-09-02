<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
class ProgramController extends Controller
{
    //
    public function indexPrograms(){
        return Program::get();
    }
    public function ProgramsAdd(Request $request){
        $program = New Program;
        $program->program_id = $request->program_id;
        $program->program = $request->program;
        $program->description = $request->description;
        $program->save();
        return $program;
    }
    public function ProgramsUpdate(Request $request, $id){
        $program = Program::findorfail($id);
        $program->program_id = $request->program_id;
        $program->program = $request->program;
        $program->description = $request->description;
        return 'Update Success';
    }
    public function searchProgram(Request $request) 
    {
        $program = Program::query();
        if ($request->input('searchkey') != "") {
            $keyword = $request->input('searchkey');
            $program->where(function($query) use($keyword) {
                $query   ->where('program_id', 'LIKE', "%$keyword%")
                            ->orWhere('program','LIKE', "%$keyword%"); 
            });
        }
        return $program->orderBy('created_at', 'desc')->get();
    }
}
