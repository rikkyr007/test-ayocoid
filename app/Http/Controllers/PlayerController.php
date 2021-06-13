<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Session;

class PlayerController extends Controller
{
    private $viewPath = 'admin.pages.players.';
    private $routePath = 'players.';

    private $rules = [
        'team_id' => 'required',
        'name' => 'required',
        'height' => 'required|numeric',
        'weight' => 'required|numeric',
        'position' => 'required',
        'back_number' => 'required|numeric',

    ];

    private $messages = [
        'required' => 'The :attribute field is required.',
        'numeric' => 'The :attribute must be number.',
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $player = new Player();
        return view($this->viewPath . 'form')->withData($player);
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

        //Back Number Unique Check
        $player = Player::where('back_number', $request->back_number)->where('team_id', $request->team_id)->first();
        if ($player != null) {
            if ($request->back_number == $player->back_number && $request->team_id == $player->team_id) {
                return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors(['There is player with same back number!']);
            }
        }

        $newRequest = $request->except(['_token']);
        Player::create($newRequest);

        return redirect()->route($this->routePath . 'show', Session::get('teamId'))
            ->withMessage('Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Session::put('teamId', $id);
        $players = Team::with('players')->where('id', $id)->first();
        return view($this->viewPath . 'index')->withData($players);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        return view($this->viewPath . 'form')
            ->withData($player);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        validator()->make($request->all(), $this->rules, $this->messages)->validate();

        //Back Number Unique Check
        $players = Player::where('back_number', $request->back_number)->where('team_id', $request->team_id)->first();
        if ($players != null) {
            if ($players->id != $player->id && $players->team_id == $player->team_id) {
                return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors(['There is player with same back number!']);
            }
        }

        $newRequest = $request->except(['_token']);
        $player->update($newRequest);

        return redirect()->route($this->routePath . 'show', Session::get('teamId'))
            ->withMessage('Data Saved Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        try {
            $player->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
