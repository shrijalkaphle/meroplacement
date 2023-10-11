<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
use App\Models\JobSeekerCertificate;

use Illuminate\Http\Request;

class CertificateController extends Controller {
    
    public function store(Request $request) {
        $input = $request->all();
        JobSeekerCertificate::create($input);
        return redirect()->back()->with('success', 'New Certificate/Training has been added!');
    }

    public function update(Request $request, $id) {
        $certificate = JobSeekerCertificate::findorfail($id);
        $input = $request->all();
        $certificate->update($input);
        return redirect()->back()->with('success', 'New Certificate/Training has been updated!');
    }

    public function destroy($id) {
        $certificate = JobSeekerCertificate::findorfail($id);
        $certificate->delete();
        return redirect()->back()->with('success', 'New Certificate/Training has been deleted!');
    }
}
