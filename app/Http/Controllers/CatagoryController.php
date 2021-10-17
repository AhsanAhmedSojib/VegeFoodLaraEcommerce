<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Catagory;
use App\Models\Product;
use Session;

class CatagoryController extends Controller
{
    public function addcatagory() {
        return view('admin.addcatagory');
    }

    public function savecatagory(Request $request) {
        $this->validate($request, ['catagory_name'=>'required']);
        $checkcat = Catagory::where('catagory_name', $request->input('catagory_name'))->first();

        $catagory = new Catagory();
            if(!$checkcat){
                $catagory->catagory_name=$request->input('catagory_name');
                $catagory->save();
                return redirect('/addcatagory')->with('status', 'The '.$catagory->catagory_name.' Catagory has been saved successfully.');

        }else{

                return redirect('/addcatagory')->with('status1', 'The '.$request->input('catagory_name').' Catagory already exist.');

        }
    }
     
    public function catagories() {
        $catagories =Catagory::get();
        return view('admin.catagories')->with('catagories', $catagories);
    }
    public function edit($id) {
        $catagory =Catagory::find($id);
        return view('admin.editcatagory')->with('catagory', $catagory);
    }
    public function updatecatagory(Request $request) {
        $catagory =Catagory::find($request->input('id'));
        $oldcat =$catagory->catagory_name;

        $catagory->catagory_name = $request->input('catagory_name');
        
        $data=array();
        $data['product_catagory']= $request->input('catagory_name');

        DB::table('products')
            ->where('product_catagory', $oldcat)
            ->update($data);

        $catagory->update();
        return redirect('/catagories')->with('status', 'The '.$catagory->catagory_name.' Catagory has been updated successfully.');

    }
    public function delete($id) {
        $catagory= Catagory::find($id);
        $catagory->delete();
        return redirect('/catagories')->with('status', 'The '.$catagory->catagory_name.' Catagory has been deleted successfully.');

    }
    public function view_by_cat($name) {
        $catagories =Catagory::get();
        $products= Product::where('product_catagory', $name)->get();
        return view('client.shop')->with('products', $products)->with('catagories', $catagories);

    }
}
