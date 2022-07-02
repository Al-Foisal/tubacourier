<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;

class PageController extends Controller
{
    public function pageList()
    {
        $pages = Page::all();
        return view('backEnd.pages.page-list',compact('pages'));
    }

    public function pageCreate()
    {
        return view('backEnd.pages.page-create');
    }

    public function pageStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'details'=>'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        Page::create([
            'title'=>$request->title,
            'details'=>$request->details,
            'status'=>1,
        ]);
        Toastr::success('message', 'Page created successfully!!');
        return redirect()->back();
    }

    public function pageEdit(Page $page)
    {
        return view('backEnd.pages.page-edit',compact('page'));
    }

    public function pageUpdate(Request $request, Page $page)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'details'=>'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $page->update([
            'title'=>$request->title,
            'details'=>$request->details,
        ]);
        Toastr::success('message', 'Page updated successfully!!');

        return redirect()->route('editor.pageList');
    }

    public function pageDelete(Request $request, Page $page)
    {
        $page->delete();
        Toastr::success('message', 'Page deleted successfully!!');

        return redirect()->route('editor.pageList');
    }

    public function pageActive(Request $request, Page $page)
    {
        $page->status = 1;
        $page->save();
        Toastr::success('message', 'Page activated successfully!!');

        return redirect()->route('editor.pageList');
    }

    public function pageInactive(Request $request, Page $page)
    {
        $page->status = 0;
        $page->save();
        Toastr::success('message', 'Page inactivated successfully!!');

        return redirect()->route('editor.pageList');
    }
}
