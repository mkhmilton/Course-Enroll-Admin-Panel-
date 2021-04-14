<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class VisitorController extends Controller
{
    function showVisitor()
    {
        $visitordata= json_decode(VisitorModel::all());
        return view('Visitor',['visitordata'=>$visitordata]);
    }
}
