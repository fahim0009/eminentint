<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Job;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function blog()
    {
        return view('frontend.blog');
    }

    public function blogDetails($id)
    {
        $data = Blog::where('id',$id)->first();
        return view('frontend.blogdtl', compact('data'));
    }

    public function job()
    {
        return view('frontend.job');
    }

    public function jobCategory()
    {
        return view('frontend.jobcategory');
    }

    public function jobdtl($id)
    {
        $data = Job::where('id',$id)->first();
        return view('frontend.jobdtl', compact('data'));
    }

}
