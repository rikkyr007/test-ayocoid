<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Validator;

class TeamController extends Controller
{
    private $viewPath = 'admin.pages.teams.';
    private $routePath = 'teams.';

    private $rules = [
        'name' => 'required',
        'logo' => 'required|mimes:jpeg,bmp,png,jpg,gif,webp,svg|max:5048',
        'established' => 'required',
        'address' => 'required',
        'city' => 'required',

    ];

    private $messages = [
        'required' => 'The :attribute field is required.',
        'mimes' => 'The :attribute must be jpeg/bmp/png/jpg/gif/webp.',
        'max' => 'The :attribute must be less than 5Mb.',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view($this->viewPath . 'index')->withData($teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team = new Team();
        return view($this->viewPath . 'form')->withData($team);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        validator()->make($request->all(), $this->rules, $this->messages)->validate();

        $newRequest = $request->except(['_token']);
        $newRequest['logo'] = storeFile($request, 'logo', '/uploads/team');
        Team::create($newRequest);

        return redirect()->route($this->routePath . 'index')
            ->withMessage('Data Saved Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view($this->viewPath . 'form')
            ->withData($team);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $newRules = $this->rules;
        unset($newRules['logo']);
        validator()->make($request->all(), $newRules, $this->messages)->validate();

        $newRequest = $request->except(['_token']);

        if ($request->hasFile('logo')) {
            if (removeFile(public_path('uploads/team/' . $team->logo))) {
                $newRequest['logo'] = storeFile($request, 'logo', '/uploads/team');
            }
        }

        $team->update($newRequest);

        return redirect()->route($this->routePath . 'index')
            ->withMessage('Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        try {
            $team->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
