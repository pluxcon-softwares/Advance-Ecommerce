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
        Session::put('page', 'Catalogues');

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

    public function addSection(Request $request)
    {
        Session::put('page', 'Catalogues');

        if($request->isMethod('get'))
        {
            return view('admin.section.add-section');
        }

        if($request->isMethod('post'))
        {
            $rules = ['name' => 'required']; //regex:/^[\pL\s\-]+$/u
            $messages = ['name.required' => 'Section name required'];
            $request->validate($rules, $messages);

            $section = new Section;
            $section->name = $request['name'];
            $section->status = 1;
            $section->save();

            Session::flash('flash_success', 'Section has been created!');

            return redirect()->back();
        }
    }
}
