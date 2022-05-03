<?php

namespace App\Http\Controllers\User;

use App\Models\Admin\Team;
use App\Models\Admin\Client;
use App\Models\Admin\Review;
use Illuminate\Http\Request;
use App\Models\Admin\Contact;
use App\Models\Admin\PageSeo;
use App\Models\Admin\Category;
use App\Models\Admin\Portfolio;
use App\Http\Controllers\Controller;
use App\Models\Admin\SocialMedia;

class RouteController extends Controller
{
    public function index()
    {
        return view('website.index');
    }


    public function portfolio()
    {
        $allCategory = Category::orderBy('position', 'asc')->get();
        $allPortfolio = Portfolio::with('category')->orderBy('position', 'asc')->get();
        return [
            'allCategory' => $allCategory,
            'allPortfolio' => $allPortfolio,
        ];
    }

    public function client()
    {
        $socialMedia = SocialMedia::where('id', 1)->first();
        $allClient = Client::orderBy('position', 'asc')->get();
        return [
            'allClient' => $allClient,
            'socialMedia' => $socialMedia,
        ];
    }
    public function metaTags(Request $request)
    {
        return PageSeo::where('url', $request->path)->first();
    }

    public function contactAndSocialLink()
    {
        return SocialMedia::where('id', 1)->first();
    }

    public function contactPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone_number' => 'required|numeric',
            'message' => 'required',
        ]);


        Contact::insert([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'message' => $request->message,
        ]);

        session()->flash('submitFormContact', 'we will contact you as soon as possible');

        return back();
    }
}
