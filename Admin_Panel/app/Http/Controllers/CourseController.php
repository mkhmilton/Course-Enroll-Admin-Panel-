<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursesModel;

class CourseController extends Controller
{
    function showCourse()
    {
        
        return view('course');
    }

    function getCourseData()
    {
        $result= json_encode(CoursesModel::all());
        return $result;
    }

    function getCourseDetails(Request $req)
    {
        $id = $req->input('id');
        $result= json_encode(CoursesModel::where('id','=',$id)->get());
        return $result;
    }
    function CourseDelete(Request $req)
    {
        $id = $req->input('id');
        $result= CoursesModel::where('id','=',$id)->delete();
        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
        
    }

    function CourseUpdate(Request $req)
    {
        $id = $req->input('id');
        $name = $req->input('name');
        $des = $req->input('des');
        $img = $req->input('img');
        $result= CoursesModel::where('id','=',$id)->update(['course_name'=>$name,'course_des'=>$des,'course_img'=>$img]);
        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
        
    }

    function CourseAdd(Request $req)
    {
       
        $name = $req->input('name');
        $des = $req->input('des');
        $img = $req->input('img');
        $result= CoursesModel::insert(['course_name'=>$name,'course_des'=>$des,'course_img'=>$img]);
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
