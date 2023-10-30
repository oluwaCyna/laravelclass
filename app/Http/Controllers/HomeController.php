<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $picture = Picture::find(1);

        return view('home', compact('picture'));
    }

public function upload(Request $request)
    {
        // dd($request);
        if ($request->hasFile('picture')) {
            $files = $request->File('picture');
            $filename = $files->getClientOriginalName();
            // $title = $request->title;
            // $exten = $files->extension();

            // $new_file_name = $filename;
            $new_file_name = str_replace(' ', '-', $filename);
        // dd($request, $files, $filename, $new_file_name);

            $files->move('images', $new_file_name);
            Picture::create([
                'picture' => $new_file_name
            ]);
            return redirect()->back();

            // $pic = new Picture();
            // $pic->name = $fFile;
            // $pic->save();
            // $pictureId = $pic->id;
        }

    }
}
