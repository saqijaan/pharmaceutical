<?php

namespace App\Http\Controllers;

use App\BrandRegistration;
use App\CategoryRegistration;
use App\ProductRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use PDF;

class ProductRegistrationController extends Controller
{

    public function view($id){
        $product = ProductRegistration::where('id', $id)->first();
        $brands = BrandRegistration::get();
        $cates = CategoryRegistration::get();

        return view( 'dashboard.admin-panel.productRegistrations.view', [ 'product'=>$product, 'brands'=>$brands, 'cates'=>$cates ] );

    }


    public function downloadPDF($id){
        $product = ProductRegistration::find($id);
        $brands = BrandRegistration::get();
        $cates = CategoryRegistration::get();

        $pdf = PDF::loadView('dashboard.admin-panel.productRegistrations.pdf', compact('product','brands','cates'));
        return $pdf->stream('invoice.pdf');

    }

    public function index()
    {
        //
        $productRegis = ProductRegistration::all();
        return view( 'dashboard.admin-panel.productRegistrations.index', ['productRegis'=>$productRegis] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cates  =   CategoryRegistration::all();
        $brands  =   BrandRegistration::all();
        return view( 'dashboard.admin-panel.productRegistrations.new', ['brands'=>$brands, 'cates'=>$cates ] );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, array(
            'name'  =>  'required|max:150',
            'cost_price'    =>  'required|max:25',
            'slae_price'     =>  'max:25',
            'reorder_level'       =>  'max:25',
            'unit'     =>  'max:300',
            'box'   =>  'max:300',
            'barcode'     =>  'max:300',
            'vait'     =>  'max:300',
            'detail'     =>  'max:300',
            'company_discount'     =>  'max:300',
            'holesale_price'     =>  'max:300',
            'cate_id'     =>  'max:300',
            'brand_id'     =>  'max:300',
            'image'     =>  'image|mimes:jpeg,jpg,png,gif,svg|max:10000',
        ));

        $productRegis = new ProductRegistration();

        if( $request->has('name') ){
            $productRegis->name = $request->input('name');
        }

        if( $request->has('cost_price') ){
            $productRegis->cost_price = $request->input('cost_price');
        }

        if( $request->has('slae_price') ){
            $productRegis->slae_price = $request->input('slae_price');
        }

        if( $request->has('reorder_level') ){
            $productRegis->reorder_level = $request->input('reorder_level');
        }

        if( $request->has('unit') ){
            $productRegis->unit = $request->input('unit');
        }

        if( $request->has('box') ){
            $productRegis->box = $request->input('box');
        }

        if( $request->has('barcode') ){
            $productRegis->barcode = $request->input('barcode');
        }

        if( $request->has('vait') ){
            $productRegis->vait = $request->input('vait');
        }

        if( $request->has('detail') ){
            $productRegis->detail = $request->input('detail');
        }

        if( $request->has('company_discount') ){
            $productRegis->company_discount = $request->input('company_discount');
        }

        if( $request->has('holesale_price') ){
            $productRegis->holesale_price = $request->input('holesale_price');
        }

        if( $request->has('cate_id') ){
            $productRegis->cate_id = $request->input('cate_id');
        }

        if( $request->has('brand_id') ){
            $productRegis->brand_id = $request->input('brand_id');
        }

        if($apk_file =  $request->file('image')) {

            $ext = $apk_file->extension();
            $name = uniqid();
            $imageName = $name.'.'.$ext;
            $s_path = 'uploads/productRegister/s';
            $m_path = 'uploads/productRegister/m';
            if(!file_exists($s_path))
                mkdir($s_path, 777, true);
            if(!file_exists($m_path))
                mkdir($m_path, 777, true);
            Image::make($apk_file)->resize(100, 60)->save($s_path.'/'.$imageName);
            Image::make($apk_file)->resize(220, 220)->save($m_path.'/'.$imageName);
            $apk_file->move('uploads/productRegister',$imageName);
            $productRegis->image = $imageName;

        }

        $productRegis->save();

        Session::flash('Success','Product has been successfully registered!.');
        return redirect('/dashboard/product-registration');

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
        $cates  =   CategoryRegistration::all();
        $brands  =   BrandRegistration::all();
        $productRegis = ProductRegistration::find($id);
        return view( 'dashboard.admin-panel.productRegistrations.edit', ['productRegis'=>$productRegis, 'brands'=>$brands, 'cates'=>$cates ] );

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
        //
        $this->validate($request, array(
            'name'  =>  'required|max:150',
            'cost_price'    =>  'required|max:25',
            'slae_price'     =>  'max:25',
            'reorder_level'       =>  'max:25',
            'unit'     =>  'max:300',
            'box'   =>  'max:300',
            'barcode'     =>  'max:300',
            'vait'     =>  'max:300',
            'detail'     =>  'max:300',
            'company_discount'     =>  'max:300',
            'holesale_price'     =>  'max:300',
            'cate_id'     =>  'max:300',
            'brand_id'     =>  'max:300',
            'image'     =>  'image|mimes:jpeg,jpg,png,gif,svg|max:10000',
        ));

//        Hi,
//I'm a web developer, 3+ years of experience, start own Software house and expertise in Laravel, PHP, Materialize, Bootstrap,  Mysql, Jquery, Javascript, Ajax, OOP, MVC, PSD to HTML etc. For further inquiry you can check my site www.hubmarts.com, this is not updated but hopefully, this fulfills your requirements. Some demos here (www.app.equiloco.com, www.arabiansource.com)
//thanks

        $productRegis = ProductRegistration::find($id);

        if( $request->has('name') ){
            $productRegis->name = $request->input('name');
        }

        if( $request->has('cost_price') ){
            $productRegis->cost_price = $request->input('cost_price');
        }

        if( $request->has('slae_price') ){
            $productRegis->slae_price = $request->input('slae_price');
        }

        if( $request->has('reorder_level') ){
            $productRegis->reorder_level = $request->input('reorder_level');
        }

        if( $request->has('unit') ){
            $productRegis->unit = $request->input('unit');
        }

        if( $request->has('box') ){
            $productRegis->box = $request->input('box');
        }

        if( $request->has('barcode') ){
            $productRegis->barcode = $request->input('barcode');
        }

        if( $request->has('vait') ){
            $productRegis->vait = $request->input('vait');
        }

        if( $request->has('detail') ){
            $productRegis->detail = $request->input('detail');
        }

        if( $request->has('company_discount') ){
            $productRegis->company_discount = $request->input('company_discount');
        }

        if( $request->has('holesale_price') ){
            $productRegis->holesale_price = $request->input('holesale_price');
        }

        if( $request->has('cate_id') ){
            $productRegis->cate_id = $request->input('cate_id');
        }

        if( $request->has('brand_id') ){
            $productRegis->brand_id = $request->input('brand_id');
        }

        if($apk_file =  $request->file('image')) {

            $ext = $apk_file->extension();
            $name = uniqid();
            $imageName = $name.'.'.$ext;
            $s_path = 'uploads/productRegister/s';
            $m_path = 'uploads/productRegister/m';
            if(!file_exists($s_path))
                mkdir($s_path, 777, true);
            if(!file_exists($m_path))
                mkdir($m_path, 777, true);
            Image::make($apk_file)->resize(100, 60)->save($s_path.'/'.$imageName);
            Image::make($apk_file)->resize(220, 220)->save($m_path.'/'.$imageName);
            $apk_file->move('uploads/productRegister',$imageName);
            $productRegis->image = $imageName;

        }

        $productRegis->update();

        Session::flash('Success', $id.' Product has been successfully updated!.');
        return redirect('/dashboard/product-registration');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $productRegis = ProductRegistration::find($id);
        if(\File::exists(public_path('uploads/productRegister/m/' . $productRegis->image))){
            \File::delete(public_path('uploads/productRegister/m/' . $productRegis->image));
            \File::delete(public_path('uploads/productRegister/s/' . $productRegis->image));
            \File::delete(public_path('uploads/productRegister/' . $productRegis->image));
        }
        $productRegis->delete();

        Session::flash('Success', $id.' Product has been successfully deleted!.');
        return redirect('/dashboard/product-registration');

    }
    public function profile($id)
    {
        //
        $productRegis   =   ProductRegistration::find($id);
        return view( 'dashboard.admin-panel.productRegistrations.product-profile', [ 'productRegis'=>$productRegis ] );
    }
}
