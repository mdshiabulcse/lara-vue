<?php

namespace App\Http\Controllers;

use App\Models\ShopModel;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       $datas= ShopModel::get();
       return view('shop/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop/shop_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => 'required',
            'shop_location' => 'required',
            'shop_img' => 'required',
           
        ]);

        $flight = new ShopModel();
        $image1 = $request->file('shop_img');
        if($image1){
            $fileName = pathinfo($image1->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time().".".$image1->getClientOriginalExtension();
            $uploadPath = 'assets_admin/img/shop/';
            $image1->move($uploadPath,$imageName);
            $flight['shop_img']  = $uploadPath.$imageName;
           }
        
        $flight->shop_name = $request->shop_name;
        $flight->shop_phone = $request->shop_phone;
        $flight->address_latitude = $request->address_latitude;
        $flight->address_longitude = $request->address_longitude;
        $flight->shop_location = $request->shop_location;
        $flight->status = $request->input('status',0);
        $flight->save();

        return response()->json([
            'status'=>200,
            'message'=>'Data Save Successfully',
            'data'=>$flight
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= ShopModel::find($id);
        return view('shop/shop_edit', compact('data'));
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
        $flight =  ShopModel::find($id);
        $image1 = $request->file('shop_img');
        if($image1){
            $fileName = pathinfo($image1->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time().".".$image1->getClientOriginalExtension();
            $uploadPath = 'assets_admin/img/shop/';
            $image1->move($uploadPath,$imageName);
            $flight['shop_img']  = $uploadPath.$imageName;
           }
        
        $flight->shop_name = $request->shop_name;
        $flight->shop_location = $request->shop_location;
        $flight->address_latitude = $request->address_latitude;
        $flight->address_longitude = $request->address_longitude;
        $flight->status = $request->input('status',0);
        $flight->save();

        return response()->json([
            'status'=>200,
            'message'=>'Data Save Successfully',
            'data'=>$flight
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= ShopModel::find($id);
        $data->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Data Delete Successfully',
            'data'=>$data
        ]);
    }
}
