<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function faq()
    {
//        return view('faq');

        return view('faq', [
            'faqs' => Faq::all()
        ]);
    }

    public function create()
    {
        return view('faq.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faq = Faq::create($validated);

        return redirect()->route('faq');
    }

    public function edit(Faq $faq)
    {
        return view('faq.edit', [
            'faq' => $faq
        ]);
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq->update($validated);

        return redirect()->route("faq");
    }

    public function delete(Faq $faq)
    {
        return view('faq.delete', [
            'faq' => $faq
        ]);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faq');
    }
}
