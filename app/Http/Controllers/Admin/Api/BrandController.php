<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use Str;
use Image;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::all();
        return response()->json($brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required|unique:brands',
            'logo'=>'required'
        ]);


        $file=explode(';',$request->logo);
        $file=explode('/',$file[0]);
        $ext=end($file);
        $logo_name=date('Y-m-d-F-s-h').'.'.$ext;

        $upload_path="uploads/brand/".$logo_name;
        Image::make($request->logo)
                ->resize(100,100)
                ->save($upload_path);

        Brand::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'logo'=>$upload_path,
            'status'=>$request->status,
        ]);

        return response()->json(['success'=>'inserted successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand=Brand::find($id);
        return response()->json($brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);

        $logo=$request->logo;
        if($request->updateLogo){
            $file=explode(';',$request->updateLogo);
            $file=explode('/',$file[0]);
            $ext=end($file);
            $logo_name=date('Y-m-d-F-s-h').'.'.$ext;

            $upload_path="uploads/brand/".$logo_name;
            Image::make($request->updateLogo)
                    ->resize(100,100)
                    ->save($upload_path);
            unlink($logo);
            $logo=$upload_path;
        }
        Brand::where('id',$id)->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'logo'=>$logo,
            'status'=>$request->status,
        ]);
        return response()->json(['success'=>'update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json(['success'=>'Deleted Successfully']);
    }
}
