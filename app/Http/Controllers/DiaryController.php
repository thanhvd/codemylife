<?php

namespace App\Http\Controllers;

use App\Diary;
use Illuminate\Http\Request;
use Auth;

class DiaryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diaryGroups = Diary::orderBy('created_at', 'desc')->get()->groupBy(function($item) {
          return $item->created_at->format('d-M-y');
        });

        return view('diary.index', [
            'diaryGroups' => $diaryGroups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:255'
        ]);

        $diary = new Diary;
        $diary->user_id = Auth::user()->id;
        $diary->content = $request->content;
        $diary->save();

        return redirect('/diaries');
    }
}
