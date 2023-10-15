<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productModel;


class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $products = productModel::all();
        return view('showAllProduct')->with('products',$products,compact('products'));


        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    { 

        $imageName = 'noimg.png';
      
        if($request->img){
$request->validate([
    'img' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
 ]);

$imageName = date('mdYHis').uniqid().'.'.$request->img->extension();
$request->img->move(public_path('uploaded_img'),$imageName);
}


        $product = new productModel;
        $product->Name = $request->Name; 
        $product->img = $imageName;   
        $product->Price = $request->Price;  
        $product->Status = $request->Status;  
        $product->save();
        return redirect('product');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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



$product = productModel::find($id);

if($request->img){
    $request->validate([
        'img' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
     ]);
     if($product->img != 'noimg.png'){
        unlink(public_path('uploaded_img').'/'.$product->img);
    }

    $imageName = date('mdYHis').uniqid().'.'.$request->img->extension();
$request->img->move(public_path('uploaded_img'),$imageName);


}else{
    $imageName = $product->img;
}


        $product = productModel::find($id);
        $product->Name = $request->Name;    
        $product->img = $imageName;  
  
        $product->Price = $request->Price;  
        $product->Status = $request->Status;  
        $product->save();
        return redirect('product');
 //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
    $product = productModel::find($id);

        if($product->img != 'noimg.png'){
            unlink(public_path('uploaded_img').'/'.$product->img);
        }
         $product->delete();
         return redirect('product');
  //
    }
}
