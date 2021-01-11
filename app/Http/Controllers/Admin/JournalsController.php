<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JournalRequest;
use App\Models\Journal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

class JournalsController extends Controller
{
    public function index()
    {
        $journals = Journal::orderBy('created_at', 'DESC')->get();
        return view('admin.journals.index', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $authors = User::all();
        return view('admin.journals.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(JournalRequest $request)
    {
        $image_name = md5($request->file('image')->getClientOriginalName()) . '.' . $request->file('image')->getClientOriginalExtension();
        $journal = Journal::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_name' => $image_name
        ]);
        $request->file('image')->move(public_path('uploads/journals/' . $journal->id), $image_name);
        foreach ($request->authors as $author_id){
            DB::table('journal_user')->insert(['user_id' => $author_id, 'journal_id' => $journal->id]);
        }
        return redirect()->route('admin.journals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $authors = User::all();
        $journal = Journal::findOrFail($id);
        $journal_authors = [];
        foreach(DB::table('journal_user')->where('journal_id', $journal->id)->get() as $ju){
            $journal_authors[] = $ju->id;
        }
        return view('admin.journals.edit', compact('authors', 'journal', 'journal_authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);
        DB::table('journal_user')->where('journal_id', $journal->id)->delete();
        if(file_exists(asset('uploads/journals/' . $journal->id . '/' . $journal->image_name))){
            File::delete(asset('uploads/journals/' . $journal->id . '/' . $journal->image_name));
        }
        $journal->delete();
        return redirect()->route('admin.journals.index');
    }
}
