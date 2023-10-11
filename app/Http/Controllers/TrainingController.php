<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Training;
use App\Models\SiteSetting;
use App\Models\EnrollInquiry;
use App\Models\TrainingEnroll;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller {
    
    public function index() {
        $sitesetting = SiteSetting::first();
        $trainings = Training::orderBy('id','desc')->paginate(15);
        return view('admin.trainings.index',compact('trainings','sitesetting'));
    }
    
    public function store(Request $request) {
        $input = $request->all();
        $input['slug'] = $this->slugify($input['title']);
        if($request->file('image')) {
            $newname = 'training/' . "training-".uniqid()."." . $request->file('image')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('image'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['image'] = $newname;
        }
        if($request->file('trainer_image')) {
            $newname = 'training/' . "trainer-".uniqid()."." . $request->file('trainer_image')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('trainer_image'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['trainer_image'] = $newname;
        }
        Training::create($input);
        return redirect()->route('training.index')->with('success','New Training added!');
    }
    
    public function edit($id) {
        $sitesetting = SiteSetting::first();
        $training = Training::findorfail($id);
        return view('admin.trainings.edit',compact('training','sitesetting'));
    }

    public function show($slug) {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        $training = Training::where(['slug' => $slug])->first();
        return view('frontend.training-single',compact('training','sitesetting'));
    }
    
    public function update(Request $request, $id) {
        $training = Training::findorfail($id);
        $input = $request->all();
        $input['slug'] = $this->slugify($input['title']);
        if($request->file('image')) {
            Storage::disk('public')->delete($training->image);
            $newname = 'training/' . "training-".uniqid()."." . $request->file('image')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('image'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['image'] = $newname;
        }
        if($request->file('trainer_image')) {
            Storage::disk('public')->delete($training->trainer_image);
            $newname = 'training/' . "trainer-".uniqid()."." . $request->file('trainer_image')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('trainer_image'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['trainer_image'] = $newname;
        }
        $training->update($input);
        return redirect()->route('training.index')->with('success','Training updated!');
    }
    
    public function destroy($id) {
        $training = Training::findorfail($id);
        Storage::disk('public')->delete($training->image);
        $training->delete();
        return redirect()->route('training.index')->with('success','Training deleted!');
    }

    public function enrollInquiry(Request $request) {
        $input = $request->all();
        EnrollInquiry::create($input);
        return redirect()->back()->with('success','Enrolled for inquiry!');
    }

    public function applytraining(Request $request) {
        $input = $request->all();
        TrainingEnroll::create($input);
        return redirect()->back()->with('success','Enrolled to training!');
    }

    public function viewenrolled($slug) {
        $sitesetting = SiteSetting::first();
        $training = Training::where(['slug' => $slug])->first();
        return view('admin.trainings.enrolled',compact('training','sitesetting'));
    }

    public function download($slug) {
        $sitesetting = SiteSetting::first();
        $training = Training::where(['slug' => $slug])->first();
        $filename = $training->title.'-'.uniqid().'.pdf';
        $pdf = \PDF::loadview('pdf.training',compact('training','sitesetting'))->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        return $pdf->download($filename);
    }

    public function enrolled_update(Request $request) {
        $enrolled = TrainingEnroll::findorfail($request->enrolled_id);
        $input = $request->all();
        $enrolled->update($input);
        return redirect()->back()->with('success', 'Enroll record updated!');
    }

    public function deleteEnrolled(Request $request) {
        $enrolled = TrainingEnroll::where(['id' => $request->enrolled_id])->delete();
        return redirect()->back()->with('success', 'Enroll record deleted!');
    }

    public function enrolled_payment(Request $request) {
        $enrolled = TrainingEnroll::findorfail($request->enrolled_id);
        $paid = $enrolled->paid;
        $input['paid'] = $paid + $request->paidamt;
        $enrolled->update($input);
        return redirect()->back()->with('success', 'New Payment added!');
    }

    public function viewInquiry() {
        $sitesetting = SiteSetting::first();
        $inquiries = EnrollInquiry::orderBy('id','desc')->get();
        return view('admin.trainings.inquiry',compact('inquiries','sitesetting'));
    }

    public function deleteInquiry(Request $request) {
        $inquiry = EnrollInquiry::findorfail($request->inquiry_id);
        $inquiry->delete();
        return redirect()->back()->with('success', 'Inquiry record deleted!');
    }

    public function slugify($text, string $divider = '-') {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}
