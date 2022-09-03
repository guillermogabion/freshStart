<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
class SubjectController extends Controller
{
    //
    public function indexSubject(){
        return Subject::get();
    }
    public function subjectAdd(Request $request){
        $subject = New Subject;
        $subject->subject_id = $request->subject_id;
        $subject->subject = $request->subject;
        $subject->description = $request->description;
        $subject->save();
        return $subject;
    }
    public function subjectUpdate(Request $request, $id){
        $subject = Subject::findorfail($id);
        $subject->subject_id = $request->subject_id;
        $subject->subject = $request->subject;
        $subject->description = $request->description;
        return 'Update Success';
    }
    public function searchSubject(Request $request) 
    {
        $subject = Subject  ::query();
        if ($request->input('searchkey') != "") {
            $keyword = $request->input('searchkey');
            $subject->where(function($query) use($keyword) {
                $query   ->where('subject_id', 'LIKE', "%$keyword%")
                            ->orWhere('subject','LIKE', "%$keyword%"); 
            });
        }
        return $subject->orderBy('created_at', 'desc')->get();
    }
}
