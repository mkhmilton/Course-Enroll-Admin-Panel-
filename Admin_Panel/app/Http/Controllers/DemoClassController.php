<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemoClassModel;

class DemoClassController extends Controller
{
    function showDemoClass()
    {
        
        return view('democlass');
    }

    function getDemoClass()
    {
        $result= json_encode(DemoClassModel::all());
        return $result;
    }
    function getDemoDetails(Request $req)
    {
        $id = $req->input('id');
        $result= json_encode(DemoClassModel::where('id','=',$id)->get());
        return $result;
    }

    function DemoClassDelete(Request $req)
    {
        $id = $req->input('id');
        $result= DemoClassModel::where('id','=',$id)->delete();
        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
        
    }


    function DemoClassUpdate(Request $req)
    {
        $id = $req->input('id');
        $democlasstopic = $req->input('democlasstopic');
        $democlasstitle = $req->input('democlasstitle');
        $democlassvideo = $req->input('democlassvideo');
        $result= DemoClassModel::where('id','=',$id)->update(['topic'=>$democlasstopic,'title'=>$democlasstitle,'video'=>$democlassvideo]);
        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
        
    }


    function DemoClassAdd(Request $req)
    {
       
        $democlasstopic = $req->input('democlasstopic');
        $democlasstitle = $req->input('democlasstitle');
        $democlassvideo = $req->input('democlassvideo');
        $result= DemoClassModel::insert(['topic'=>$democlasstopic,'title'=>$democlasstitle,'video'=>$democlassvideo]);
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
