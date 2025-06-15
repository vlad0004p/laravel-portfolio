<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class StaticContentController extends Controller
{
    public function index()
    {
        return view('index') ;
    }

    public function profile()
    {
        return view('profile') ;
    }

    public function blog()
    {
        return view('blog');
    }

    /*
     * The static blog pages
     */

    public function professions()
    {
        return view('fixed_blogs/professions') ;
    }

    public function first_feedback()
    {
        return view('fixed_blogs/first_feedback') ;
    }

    public function programming_expirience()
    {
        return view('fixed_blogs/programming_expirience') ;
    }

    public function study_choice()
    {
        return view('fixed_blogs/study_choice') ;
    }

    public function swot_analysis()
    {
        return view('fixed_blogs/swot_analysis') ;
    }

    public function error404()
    {
        return view('errors\404') ;
    }

    public function error500()
    {
        return view('error500') ;
    }

}
