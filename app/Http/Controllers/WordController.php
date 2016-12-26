<?php

namespace App\Http\Controllers;

use App\Dictionary;
use App\Word;
use Auth;
use DB;
use File;
use Illuminate\Http\Request;

class WordController extends Controller
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
        $wordGroups = Auth::user()->words()->orderBy('created_at', 'desc')->get()->groupBy(function($item) {
          return $item->created_at->format('d-M-y');
        });

        return view('word.index', [
            'wordGroups' => $wordGroups
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
            'word' => 'required|max:255'
        ]);

        $dictWord = Dictionary::where('word', $request->word)->first();

        if (!$dictWord) {
            return redirect('/words')->with('status', 'Word not found!');
        }

        // $userWord = Word::where('word', $request->word)->get();

        $word = new Word;
        $word->user_id = Auth::user()->id;
        $word->word = $dictWord->word;
        $word->meanings = $dictWord->meanings;
        $word->save();

        return redirect('/words');
    }
}
