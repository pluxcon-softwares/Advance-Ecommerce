<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Section;

class SectionController extends Controller
{
    public function sections()
    {
        Session::put('page', 'Catalog');

        $sections = Section::all();

        return view('admin.section.sections', compact('sections'));
    }

    public function changeSectionStatus(Request $request)
    {
        if($request['section_status'] == 1)
        {
            $status = 0;
        }else{
            $status = 1;
        }
        Section::find($request['section_id'])->update(['status' => $status]);

        return response()->json(['status' => $status]);
    }
}
