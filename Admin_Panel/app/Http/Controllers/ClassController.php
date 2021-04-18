<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;

class ClassController extends Controller
{
    function showClass()
    {
        
        return view('classroom');
    }

    function getClass()
    {
        $result= json_encode(ClassModel::all());
        return $result;
    }
    function getDetails(Request $req)
    {
        $id = $req->input('id');
        $result= json_encode(ClassModel::where('id','=',$id)->get());
        return $result;
    }

    function ClassDelete(Request $req)
    {
        $id = $req->input('id');
        $result= ClassModel::where('id','=',$id)->delete();
        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
        
    }


    function ClassUpdate(Request $req)
    {
        $id = $req->input('id');
        $Tutorialclasstopic = $req->input('Tutorialclasstopic');
        $Tutorialclasstitle = $req->input('Tutorialclasstitle');
        $Tutorialclassvideo = $req->input('Tutorialclassvideo');
        $result= ClassModel::where('id','=',$id)->update(['classtopic'=>$Tutorialclasstopic,'classtitle'=>$Tutorialclasstitle,'classvideo'=>$Tutorialclassvideo]);
        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
        
    }


    function ClassAdd(Request $req)
    {
       
        $Tutorialclasstopic = $req->input('Tutorialclasstopic');
        $Tutorialclasstitle = $req->input('Tutorialclasstitle');
        $Tutorialclassvideo = $req->input('Tutorialclassvideo');
        $result= ClassModel::insert(['classtopic'=>$Tutorialclasstopic,'classtitle'=>$Tutorialclasstitle,'classvideo'=>$Tutorialclassvideo]);
        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
        
    }

}
