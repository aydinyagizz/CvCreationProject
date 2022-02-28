<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\PersonalInformation;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function index()
    {
        // select ile veritabanından gerekli olacak alanları belirtiyoruz. get(); hepsini getirmesini sağlıyor.
        $educationList = Education::query()
            ->StatusActive()
//            ->where('status', 1)
            ->select('education_date', 'university_name', 'university_branch', 'description')
            ->orderBy('order', 'ASC')
            ->get();

        $experienceList = Experience::query()
            ->where('status', 1)
            ->select('task_name', 'company_name', 'description', 'date')
            ->orderBy('order', 'ASC')
            ->get();

//        $personal = PersonalInformation::find(1);
        // çoklu değer almak isteğimiz için get() diyoruz.
//        $socialMedia = SocialMedia::where('status', 1)->get();

        //datayı view'a gönderme yapıyor.
        return view('pages.index', compact('educationList', 'experienceList'));
    }

    public function resume()
    {
        return view('pages.resume');
    }

    public function portfolio()
    {
        return view('pages.portfolio');
    }

    public function blog()
    {
        return view('pages.blog');
    }

    public function contact()
    {
        return view('pages.contact');
    }

}