<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Catagory;
class ProductController extends Controller
{
    //
    public function addproduct() {
        $catagories =Catagory::All()->pluck('catagory_name','catagory_name');
        return view('admin.addproduct')->with('catagories', $catagories);
    }

    public function saveproduct(Request $request) {
        $this->validate($request, [ 'product_name'=>'required',
                                    'product_price'=>'required',
                                    'product_image'=>'image|nullable|max:1999']);


        if($request->input('product_catagory')){

            print($request->input('product_catagory'));
        
                    if($request->hasfile('product_image')){
                            //1 : get filename with extentiion
                            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
                            // 2 : get just file name
                            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                            // 3 : get just extention
                            $extension = $request->file('product_image')->getClientOriginalExtension();
                            // 3 : file name to store
                            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                            //upload image
                            $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);
                    }
            
                    else{
                        $fileNameToStore= 'noimage.jpg';
                    }
            $product = new Product();
            $product->product_name=$request->input('product_name');
            $product->product_price=$request->input('product_price');
            $product->product_catagory=$request->input('product_catagory');
            $product->product_image=$fileNameToStore;
            $product->status=1;
    
    
            $product->save();
    
            return redirect('/addproduct')->with('status', 'The '.$product->product_name.' Product has been saved successfully.');

        }
        
        else {
            return redirect('/addproduct')->with('status1', 'Do select the catagory please');

        }
 



    }


    public function products() {
        $products= Product::get();
        return view('admin.products')->with('products', $products);
    }

    public function editproduct($id) {

        $catagories =Catagory::All()->pluck('catagory_name','catagory_name');

        $product= Product::find($id);

        return view('admin.editproduct')->with('product', $product)->with('catagories', $catagories);
    }
    public function updateproduct(Request $request) {
        
        $products= Product::get();
        $this->validate($request, [ 'product_name'=>'required',
                                    'product_price'=>'required',
                                    'product_image'=>'image|nullable|max:1999']);

            $product = Product::find($request->input('id'));
            $product->product_name=$request->input('product_name');
            $product->product_price=$request->input('product_price');
            $product->product_catagory=$request->input('product_catagory');

         
                if($request->hasfile('product_image')){
                        //1 : get filename with extentiion
                        $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
                        // 2 : get just file name
                        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                        // 3 : get just extention
                        $extension = $request->file('product_image')->getClientOriginalExtension();
                        // 3 : file name to store
                        $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                        //upload image
                        $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);

                        $old_image = Product::find($request->input('id'));

                        if($product->product_image !='noimage.jpg'){
                            Storage::delete('public/product_images/'.$product->product_image);
                        }
                        $product->product_image=$fileNameToStore;

                        
                }
            $product->update();
            return redirect('/products')->with('status', 'The '.$product->product_name.' Product has been updated successfully.');

               
    }
    public function delete_product($id) {
        $product= Product::find($id);
        
        if($product->product_image !='noimage.jpg'){
            Storage::delete('public/product_images/'.$product->product_image);
        }
        $product->delete();
        return redirect('/products')->with('status', 'The '.$product->product_name.' Product has been deleted successfully.');

    }
    public function activate_product($id) {
        $product= Product::find($id);
        $product->status=1;
        $product->update();

        return redirect('/products')->with('status', 'The '.$product->product_name.' Product status has been activated successfully.');

    }
    public function unactivate_product($id) {
        $product= Product::find($id);
        $product->status=0;
        $product->update();

        return redirect('/products')->with('status', 'The '.$product->product_name.' Product status has been unactivated successfully.');

    }
}
