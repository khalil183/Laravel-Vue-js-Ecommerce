<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use Str;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        // $data=["uploads\/product\/2021-05-09-May-39-11-0.jpeg","uploads\/product\/2021-05-09-May-40-11-1.jpeg","uploads\/product\/2021-05-09-May-40-11-2.jpeg"];
        // return json_decode($products->image);
        return response()->json($products);
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
            'name'=>'required',
            'code'=>'required|unique:products',
            'category_id'=>'required',
            'brand_id'=>'required',
            'qty'=>'required',
            'buying_price'=>'required',
            'selling_price'=>'required',
            'images'=>'required',
        ]);

        $images=array();
        foreach($request->images as $i => $row){
            $file=explode(';',$row);
            $file=explode('/',$file[0]);
            $ext=end($file);
            $imageName=date('Y-m-d-F-s-h-').$i.'.'.$ext;
            $upload_path="uploads/product/".$imageName;
            Image::make($row)
                ->resize(100,100)
                ->save($upload_path);
            $images[$i]=$upload_path;
        }

        Product::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'qty'=>$request->qty,
            'code'=>$request->code,
            'category_id'=>$request->category_id,
            'brand_id'=>$request->brand_id,
            'buying_price'=>$request->buying_price,
            'selling_price'=>$request->selling_price,
            'images'=>json_encode($images),
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
        $product=Product::find($id);
        return response()->json($product);
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
            'name'=>'required',
            'code'=>'required|unique:products,code,'.$id,
            'category_id'=>'required',
            'brand_id'=>'required',
            'qty'=>'required',
            'buying_price'=>'required',
            'selling_price'=>'required',
        ]);

        $images=$request->images;
        $newImages=array();
        if($request->newImages){
            foreach($request->newImages as $i => $row){
                $file=explode(';',$row);
                $file=explode('/',$file[0]);
                $ext=end($file);
                $imageName=date('Y-m-d-F-s-h-').$i.'.'.$ext;
                $upload_path="uploads/product/".$imageName;
                Image::make($row)
                    ->resize(100,100)
                    ->save($upload_path);
                $newImages[$i]=$upload_path;
            }
            if($images){
                $product_images= json_decode($images);
                foreach($product_images as $img){
                    unlink($img);
                }
            }
            $images=$newImages;
        }

        Product::where('id',$id)->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'qty'=>$request->qty,
            'code'=>$request->code,
            'category_id'=>$request->category_id,
            'brand_id'=>$request->brand_id,
            'buying_price'=>$request->buying_price,
            'selling_price'=>$request->selling_price,
            'images'=>json_encode($images),
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

        $product=Product::find($id);
        Product::destroy($id);
        $product_images= json_decode($product->image);
        foreach($product_images as $row){
            unlink($row);
        }
        return response()->json(['success'=>'Deleted Successfully']);
    }
}
