<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Http\Requests\InquiryRequest;

class InquiryController extends Controller
{
    public function index()
    {
        return view('inquiry.index');
    }

    public function confirm(InquiryRequest $request)
    {
        $inputs = $request->only(['name', 'email', 'title', 'content']);
        return view('inquiry.confirm', compact('inputs'));
    }

    public function thanks(InquiryRequest $request)
    {
        Inquiry::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'title'   => $request->title,
            'content' => $request->content,
        ]);
        return view('inquiry.thanks');
    }
}
