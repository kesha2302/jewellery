<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Banner;

class AdminBannerController extends Controller
{
    public function adminbannerdetailview(Request $request)
    {
        $search=$request['search']??"";
        if($search!=""){
            $bannerdetail=Banner::where('title',"LIKE","%$search%")->get();
        }
        else{
            $bannerdetail=Banner::all();
        }

        $data=compact('bannerdetail', 'search');

        return view('AdminPanel.banner')->with($data);
    }

    public function adminbannerdetailform()
    {
        $bannerdetail = new Banner();
        $url=url('/Adminbannerdetailform2');
        $title="Banner Detail Form";
        $data=compact('url','title','bannerdetail');

        return view('AdminPanel.bannerform')->with($data);
    }

    public function bannerdetaildata(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // 'title' => 'required|string',
            // 'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $bannerdetail= new Banner();
        $bannerdetail->title=$request->input('title');
        $bannerdetail->description = $request->input('description');
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $fileName = time() . "img." . $request->file('image')->getClientOriginalExtension();
            $file->move('BannerImage', $fileName);
            $bannerdetail->image = $fileName;
        }

        $bannerdetail->save();

        return redirect('/Adminbannerdetail');

    }

    public function bannerdetailtrash()
    {
        $bannerdetail= Banner::onlyTrashed()->get();
        $data=compact('bannerdetail');

        return view ("AdminPanel.bannertrash")->with($data);
    }

    public function bannerdetaildelete($id)
    {
        $bannerdetail= Banner::find($id);
        if(!is_null($bannerdetail)){
            $bannerdetail->delete();
        }
        return redirect('Adminbannerdetail');
    }

    public function bannerdetailrestore($id)
    {
        $bannerdetail=Banner::withTrashed()->find($id);
        if(!is_null($bannerdetail)){
            $bannerdetail->restore();
        }
        return redirect('Adminbannerdetail');
    }

    public function bannerdetailforcedelete($id)
    {
        $bannerdetail=Banner::withTrashed()->find($id);
        if(!is_null($bannerdetail)){
            $bannerdetail->forceDelete();
        }
        return redirect()->back();
    }

    public function bannerdetailedit($id)
    {
        $bannerdetail=Banner::find($id);
        if(is_null($bannerdetail)){
            return redirect('Adminbannerdetail');
        }
        else
        {
            $url=url('/bannerdetail/update')."/".$id;
             $title="Update Banner Details";
            $data=compact('bannerdetail','url','title');

            return view('AdminPanel.bannerform')->with($data);
        }

    }

    public function bannerdetailupdate($id, Request $request)
    {
        $bannerdetail=Banner::find($id);

        $bannerdetail->title=$request->input('title');
        $bannerdetail->description = $request->input('description');

        $bannerdetail->save();

        return redirect('Adminbannerdetail');
    }
}
