<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Slider;
class SliderController extends Controller
{
    public function addslider() {
        return view('admin.addslider');

    }
    public function saveslider(Request $request) {

        $this->validate($request, [ 'description_one'=>'required',
                                    'description_two'=>'required',
                                    'slider_image'=>'image|nullable|max:1999']);
                if($request->hasfile('slider_image')){
                    //1 : get filename with extentiion
                    $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
                    // 2 : get just file name
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    // 3 : get just extention
                    $extension = $request->file('slider_image')->getClientOriginalExtension();
                    // 3 : file name to store
                    $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                    //upload image
                    $path = $request->file('slider_image')->storeAs('public/slider_images',$fileNameToStore);
                    }
            
                    else{
                        $fileNameToStore= 'noimage.jpg';
                    }
                    $slider = new Slider();
                    $slider->description1=$request->input('description_one');
                    $slider->description2=$request->input('description_two');
                    $slider->slider_image=$fileNameToStore;
                    $slider->status=1;
            
            
                    $slider->save();
            
                    return redirect('/addslider')->with('status', 'The Slider has been saved successfully.');
        
    }

    public function sliders() {
        $sliders = Slider::get();
        return view('admin.sliders')->with('sliders', $sliders);

    } 
    public function edit_slider($id) {
        $slider = Slider::find($id);
        return view('admin.editslider')->with('slider', $slider);

    } 
    public function update_slider(Request $request) {

        $this->validate($request, [ 'description_one'=>'required',
                                    'description_two'=>'required',
                                    'slider_image'=>'image|nullable|max:1999']);

        $slider = Slider::find($request->input('id'));

        $slider->description1=$request->input('description_one');
        $slider->description2=$request->input('description_two');

            if($request->hasfile('slider_image')){
                //1 : get filename with extentiion
                $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
                // 2 : get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // 3 : get just extention
                $extension = $request->file('slider_image')->getClientOriginalExtension();
                // 3 : file name to store
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                //upload image
                $path = $request->file('slider_image')->storeAs('public/slider_images',$fileNameToStore);

                $old_image = Slider::find($request->input('id'));

                if($slider->slider_image !='noimage.jpg'){
                    Storage::delete('public/slider_images/'.$slider->slider_image);
                }
                $slider->slider_image=$fileNameToStore;


        }
        $slider->update();

        return redirect('/sliders')->with('status', 'The Slider has been updated successfully.');

    } 
    public function delete_slider($id) {
        $slider= Slider::find($id);
        
        if($slider->slider_image !='noimage.jpg'){
            Storage::delete('public/slider_images/'.$slider->slider_image);
        }
        $slider->delete();
        return redirect('/sliders')->with('status', 'The Slider has been updated successfully.');

    }
    public function activate_slider($id) {
        $slider= Slider::find($id);
        $slider->status=1;
        $slider->update();

        return redirect('/sliders')->with('status', 'The Slider status has been activated successfully.');

    }
    public function unactivate_slider($id) {
        $slider= Slider::find($id);
        $slider->status=0;
        $slider->update();

        return redirect('/sliders')->with('status', 'The Slider status has been unactivated successfully.');

    }
    

}
