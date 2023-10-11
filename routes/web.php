<?php

namespace App\Http\Controllers;

use App\Http\Controllers\VacancyController;
use App\Http\Controllers\TaskController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'landing'])->name('landing');
Route::get('/about', [PageController::class, 'about']);
Route::get('/trainings', [PageController::class, 'training']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/blogs', [PageController::class, 'blog']);
Route::get('/terms-condition', [PageController::class, 'termscondition'])->name('termscondition');
Route::get('/forgotpassword', [PageController::class, 'forgotpassword'])->name('forgotpassword');
Route::get('/register', [PageController::class, 'registerpage'])->name('register')->middleware('guest');
Route::get('/login', [PageController::class, 'loginpage'])->name('login')->middleware('guest');
Route::get('/payment-methods', [PageController::class, 'payment_method'])->name('paymentmethod');

Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('login.social');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback']);

Route::post('/create_user', [LoginController::class, 'create_user'])->name('create_user');
Route::post('/check_user', [LoginController::class, 'check_user'])->name('check_user');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/job-view/{slug}', [PageController::class, 'viewjob'])->name('job.view');
Route::post('/apply-training-inquiry', [TrainingController::class, 'enrollInquiry'])->name('training.inquiry');
Route::post('/apply-training', [TrainingController::class, 'applytraining'])->name('training.enroll');


Route::post('/contact/submit', [PageController::class, 'sumbitContact'])->name('contact.submit');

Route::post('/search', [SearchController::class, 'search'])->name('search');
Route::get('/industry/{slug}/jobs', [PageController::class, 'industry_job'])->name('industry.joblist');
Route::get('/employeer/{slug}/jobs', [PageController::class, 'company_job'])->name('company.joblist');

Route::get('/jobseeker/view/{id}', [JobSeekerController::class, 'view'])->name('jobseeker.view');

Route::post('/reset-mail', [LoginController::class, 'resetpassword'])->name('user.resetmail');

Route::middleware(['admin'])->group(function () {
    Route::get('dashboard', [AdminController::class ,'dashboard'])->name('admin.dashboard');
    Route::resource('industry', IndustryController::class );

    Route::get('/job/active', [JobController::class ,'activejob'])->name('job.active');
    Route::post('/job/active/store', [JobController::class ,'activejob_store'])->name('job.active.store');
    Route::get('/job/active/{id}/edit', [JobController::class ,'activejob_edit'])->name('job.active.edit');
    Route::patch('/job/active/{id}/update', [JobController::class ,'activejob_update'])->name('job.active.update');
    Route::delete('/job/active/{id}', [JobController::class ,'activejob_delete'])->name('job.active.destroy');

    Route::resource('applicant', ApplicantController::class);
    Route::get('/job/premium/{id}/applicant', [ApplicantController::class, 'premiumjob_applicant']);
    Route::get('/premium/applicant/delete/{id}', [ApplicantController::class, 'premiumjob_applicant_delete']);

    ROute::get('/job/premium', [JobController::class ,'premiumjob'])->name('job.premium');
    Route::post('/job/premium/store', [JobController::class ,'premiumjob_store'])->name('job.premium.store');
    Route::get('/job/premium/{id}/edit', [JobController::class ,'premiumjob_edit'])->name('job.premium.edit');
    Route::patch('/job/premium/{id}', [JobController::class ,'premiumjob_update'])->name('job.premium.update');
    Route::delete('/job/premium/{id}', [JobController::class ,'premiumjob_destroy'])->name('job.premium.destroy');

    Route::get('/job/pending', [JobController::class ,'pendingjob'])->name('job.pending');
    Route::get('/job/pending/{id}/activate', [JobController::class ,'pendingjob_activate'])->name('job.pending/activate');
    Route::delete('/job/pending/{id}', [JobController::class ,'pendingjob_delete'])->name('job.pending.destroy');

    Route::get('/job/expired', [JobController::class ,'expiredjob'])->name('job.expired');
    Route::post('/job/expired/repost', [JobController::class ,'repostjob'])->name('job.expired.repost');
    
    Route::get('user/activate/{id}', [UserController::class, 'activateUser'])->name('user.activate');
    
    Route::get('/user/admin', [UserController::class ,'useradmin'])->name('user.admin');
    Route::post('/user/admin/store', [UserController::class ,'useradmin_store'])->name('user.admin.store');
    Route::get('/user/admin/{id}/edit',[UserController::class ,'useradmin_edit'])->name('user.admin.edit');
    Route::patch('/user/admin/{id}/update',[UserController::class ,'useradmin_update'])->name('user.admin.update');
    Route::delete('/user/admin/{id}', [UserController::class ,'useradmin_destroy'])->name('user.admin.destroy');

    Route::get('/user/employee', [UserController::class ,'useremployee'])->name('user.employee');
    Route::post('/user/employee/store', [UserController::class ,'useremployee_store'])->name('user.employee.store');
    Route::get('/user/employee/{id}/edit',[UserController::class ,'useremployee_edit'])->name('user.employee.edit');
    Route::patch('/user/employee/{id}/update',[UserController::class ,'useremployee_update'])->name('user.employee.update');
    Route::delete('/user/employee/{id}', [UserController::class ,'useremployee_destroy'])->name('user.employee.destroy');
    Route::post('deleteAllEmployee', [UserController::class, 'deleteAllEmployee']);
    
    Route::get('/user/jobseeker', [UserController::class ,'userjobseeker'])->name('user.jobseeker');
    Route::get('/user/jobseeker/create', [UserController::class ,'userjobseeker_create'])->name('user.jobseeker.create');
    Route::post('/user/jobseeker/store', [UserController::class ,'userjobseeker_store'])->name('user.jobseeker.store');
    Route::get('/user/jobseeker/{id}/edit', [UserController::class ,'userjobseeker_edit'])->name('user.jobseeker.edit');
    Route::patch('/user/jobseeker/{id}/update',[UserController::class ,'userjobseeker_update'])->name('user.jobseeker.update');
    Route::delete('/user/jobseeker/{id}', [UserController::class ,'userjobseeker_destroy'])->name('user.jobseeker.destroy');

    Route::get('/user/jobseeker/{id}/additional', [UserController::class, 'jobseeker_additional'])->name('user.jobseeker.additional');
    Route::patch('/user/jobseeker/{id}/additional', [UserController::class, 'jobseeker_additional_update'])->name('user.jobseeker.additional.update');

    Route::resource('testimonial', TestimonialController::class);
    Route::resource('training', TrainingController::class);
    Route::get('training/{slug}/enrolled', [TrainingController::class, 'viewenrolled'])->name('training.enrolled');
    Route::get('training-inquiry', [TrainingController::class, 'viewInquiry'])->name('training.view.inquiry');
    Route::post('training-inquiry/delete', [TrainingController::class, 'deleteInquiry'])->name('training.delete.inquiry');
    Route::resource('blog', BlogController::class);
    Route::get('contactForm', [AdminController::class, 'contact'])->name('contactForm');
    Route::resource('vacancy', VacancyController::class);
    Route::resource('task', TaskController::class);
    Route::resource('setting', SiteController::class);
    Route::resource('qualification', QualificationController::class);
    Route::resource('uploadcv', UploadCVController::class);

    Route::get('terms-and-conditions', [SiteController::class, 'termsandcondition'])->name('terms.index');
    Route::patch('terms-and-conditions/{id}', [SiteController::class, 'termsandcondition_update'])->name('terms.update');

    Route::get('/cv', [AdminController::class, 'viewCV'])->name('cv.view');

    Route::resource('payment', PaymentController::class);
    Route::resource('slider', SliderController::class);

    Route::get('/cv/access/grant/{id}', [AdminController::class, 'grantAccess'])->name('cv.access.grant');
    Route::get('/cv/access/list/{id}', [AdminController::class, 'access_list'])->name('cv.access.list');
    Route::get('/cv/access/delete/{id}', [AdminController::class, 'deleteAccess'])->name('cv.access.delete');
    Route::post('enrolled/update', [TrainingController::class, 'enrolled_update'])->name('training.enrolled.update');
    Route::post('enrolled/delete', [TrainingController::class, 'deleteEnrolled'])->name('training.enrolled.delete');
    Route::post('enrolled/payment', [TrainingController::class, 'enrolled_payment'])->name('training.enrolled.payment');

    Route::get('contact/delete/{id}', [AdminController::class, 'delete_contact']);
    Route::post('deleteAll', [AdminController::class, 'deleteAll']);
    
    Route::get('/cv-download-request/all', [CVController::class, 'download_request_all'])->name('cvdownloadrequest.all');
    Route::get('/cv-access-request/all', [CVController::class, 'download_access_all'])->name('cvaccessrequest.all');
});

Route::middleware(['employee'])->group(function () {
    Route::get('employee/dashboard', [EmployeeController::class ,'dashboard'])->name('employee.dashboard');
    Route::post('employee/logo/update',[EmployeeController::class ,'logoupdate'])->name('employee.logo.update');
    Route::patch('employee/update/{id}',[EmployeeController::class ,'updateEmployee'])->name('employee.update');
    Route::get('employee/job/create',[EmployeeController::class ,'create_job'])->name('employee.jobpost.create');
    Route::post('employee/job/store',[EmployeeController::class ,'store_job'])->name('employee.jobpost.store');
    Route::get('employee/jobs',[EmployeeController::class ,'view_job'])->name('employee.jobpost.view');
    Route::delete('employee/job/{id}',[EmployeeController::class ,'destroy_job'])->name('employee.jobpost.destroy');
    Route::get('employee/job/{id}/edit',[EmployeeController::class ,'edit_job'])->name('employee.jobpost.edit');
    Route::patch('employee/job/{id}/update',[EmployeeController::class ,'update_job'])->name('employee.jobpost.update');
    Route::patch('employee/job/repost/{id}', [EmployeeController::class ,'repost_job'])->name('employee.jobpost.repost');

    Route::get('employee/cv', [CVController::class, 'viewAll'])->name('employee.cv.view');
    Route::get('employee/requested/cv', [CVController::class, 'requestedCV'])->name('employee.cv.requested');
    Route::get('mark-cv/{id}',[CVController::class, 'markCV'])->name('employee.cv.mark');
    Route::get('employee/cv/request', [CVController::class, 'requestAccess'])->name('employee.cv.request');

    Route::get('employee/applicants', [EmployeeController::class, 'viewAllApplicant'])->name('employee.applicant');
    Route::get('employee/applicant/{id}', [EmployeeController::class, 'viewApplicant'])->name('employee.applicant.show');
});

Route::middleware(['jobseeker'])->group(function () {
    Route::get('/jobseeker/profile', [JobSeekerController::class, 'profile_view'])->name('profile');
    Route::get('/jobseeker/dashboard', [JobSeekerController::class, 'dashboard'])->name('jobseeker.dashboard');
    Route::get('/jobseeker/change-password', [JobSeekerController::class, 'changepassword'])->name('jobseeker.changepassword');
    Route::patch('/jobseeker/update-password', [JobSeekerController::class, 'updatepassword'])->name('jobseeker.updatepassword');

    Route::get('/jobseeker/profile/basic-info/edit', [JobSeekerController::class, 'profile_edit'])->name('profile.basic.edit');
    Route::get('/jobseeker/profile/preference/edit', [JobSeekerController::class, 'preference_edit'])->name('profile.preference.edit');
    Route::get('/jobseeker/profile/education/edit', [JobSeekerController::class, 'education_edit'])->name('profile.education.edit');
    Route::get('/jobseeker/profile/experience/edit', [JobSeekerController::class, 'experience_edit'])->name('profile.experience.edit');
    Route::get('/jobseeker/profile/training-certificate/edit', [JobSeekerController::class, 'training_edit'])->name('profile.training.edit');
    Route::get('/jobseeker/profile/reference/edit', [JobSeekerController::class, 'reference_edit'])->name('profile.reference.edit');
    Route::get('/jobseeker/profile/social-account/edit', [JobSeekerController::class, 'social_edit'])->name('profile.social.edit');

    Route::patch('/jobseeker/profile/basic/{id}', [JobSeekerController::class, 'basic_update'])->name('profile.basic.update');
    Route::patch('/jobseeker/profile/preference/{id}', [JobSeekerController::class, 'preference_update'])->name('profile.preference.update');
    Route::patch('/jobseeker/profile/reference/{id}', [JobSeekerController::class, 'reference_update'])->name('profile.reference.update');

    Route::get('/jobseeker/cv-template', [JobSeekerController::class, 'chooseTemplate']);
    Route::post('request/cv', [CVController::class, 'requestCV']);
});

Route::get('search-job/{query}', [SearchController::class, 'searchJob'])->name('search.job');
Route::get('search-employee/{query}', [SearchController::class, 'searchEmployee'])->name('search.employee');
Route::get('search-jobseeker/{query}', [SearchController::class, 'searchJobSeeker'])->name('search.jobseeker');
Route::get('search-cv/{query}', [SearchController::class, 'searchCV'])->name('search.cv');
Route::get('search-file/{query}', [SearchController::class, 'searchFile'])->name('search.file');


Route::post('/cv/preview', [CVController::class, 'preview_cv']);
Route::get('/cv/preview/{id}/{template}', [CVController::class, 'previewCV']);
Route::get('/cv/deliver/{id}', [CVController::class, 'deliverCV']);
Route::get('/cv/delete/{id}', [CVController::class, 'deleteRequestCV']);

Route::patch('/jobseeker/profile/social-account/{id}', [JobSeekerController::class, 'social_update'])->name('profile.social.update');

Route::post('/jobseeker/experience/store', [ExperienceController::class , 'store'])->name('experience.store');
Route::patch('/jobseeker/experience/{id}/update', [ExperienceController::class , 'update'])->name('experience.update');
Route::delete('/jobseeker/experience/{id}', [ExperienceController::class , 'destroy'])->name('experience.destroy');

Route::post('/jobseeker/education/store', [EducationController::class , 'store'])->name('education.store');
Route::patch('/jobseeker/education/{id}/update', [EducationController::class , 'update'])->name('education.update');
Route::delete('/jobseeker/education/{id}', [EducationController::class , 'destroy'])->name('education.destroy');

Route::post('/jobseeker/certificate/store', [CertificateController::class , 'store'])->name('certificate.store');
Route::patch('/jobseeker/certificate/{id}/update', [CertificateController::class , 'update'])->name('certificate.update');
Route::delete('/jobseeker/certificate/{id}', [CertificateController::class , 'destroy'])->name('certificate.destroy');

Route::get('/change-password', [UserController::class, 'changepassword'])->name('user.changepassword');
Route::patch('/update-password/{id}', [UserController::class, 'updatepassword'])->name('user.updatepassword');
Route::post('/job/apply', [ApplicantController::class, 'applyJob']);
Route::post('/job/premium/apply', [ApplicantController::class, 'applypremiumJob'])->name('apply.premium');

Route::get('/training-view/{slug}', [TrainingController::class, 'show'])->name('training.view');
Route::get('/blog-view/{slug}', [BlogController::class, 'show'])->name('blog.view');

Route::get('pdf/training/{slug}', [TrainingController::class, 'download']);
Route::get('/activate/{id}/{token}', [LoginController::class, 'verify_email']);

Route::get('/download/cv/{id}', [CVController::class, 'downloadCV']);
Route::get('/reset/{id}/{token}',[LoginController::class, 'reset_validate']);
Route::post('/reset/password',[LoginController::class, 'reset_password'])->name('user.password.reset');

Route::get('template', function() {
    $user = \App\Models\User::findorfail(12);
    return view('cv.template1',compact('user'));
});
Route::get('/update-applicant/{id}/{status}', [ApplicantController::class, 'update_applicant']);
Route::get('weeklymail', [JobController::class, 'weekly_mail']);
Route::post('/cv/upload',[UploadCVController::class, 'store'])->name('cv.upload.store');