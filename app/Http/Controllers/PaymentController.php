<?php

namespace App\Http\Controllers;

use Image;
use File;
use App\Models\SiteSetting;
use App\Models\PaymentMethod;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller {

    public function index() {
        $sitesetting = SiteSetting::first();
        $payments = PaymentMethod::orderBy('id','desc')->paginate(10);
        return view('admin.payment.index',compact('payments','sitesetting'));
    }
    
    public function store(Request $request) {
        $input = $request->all();
        if($request->file('photo')) {
            $newname = 'payment/' . "payment-".uniqid()."." . $request->file('photo')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            $path = public_path().'/uploads/payment';
            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
            Image::make($request->file('photo'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['photo'] = $newname;
        }
        PaymentMethod::create($input);
        return redirect()->route('payment.index')->with('success','New Payment Method created!');
    }
    
    public function update(Request $request, $id) {
        $payment = PaymentMethod::findorfail($id);
        $input = $request->all();
        if($request->file('photo')) {
            Storage::disk('public')->delete($payment->photo);
            $newname = 'payment/' . "payment-".uniqid()."." . $request->file('photo')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            $path = public_path().'/uploads/payment';
            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
            Image::make($request->file('photo'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['photo'] = $newname;
        } else {
            unset($input['photo']);
        }
        $payment->update($input);
        return redirect()->route('payment.index')->with('success','New Payment Method updated!');
    }
    
    public function destroy($id) {
        $payment = PaymentMethod::findorfail($id);
        Storage::disk('public')->delete($payment->photo);
        $payment->delete();
        return redirect()->route('payment.index')->with('success','Payment Method deleted!');
    }
}
