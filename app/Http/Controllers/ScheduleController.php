<?php

namespace App\Http\Controllers;

use App\Models\DetailSchedule;
use App\Models\Player;
use App\Models\Schedule;
use App\Models\Team;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private $viewPath = 'admin.pages.schedules.';
    private $routePath = 'schedules.';

    private $rules = [
        'team1_id' => 'required',
        'team2_id' => 'required',
        'team1_type' => 'required',
        'team2_type' => 'required',
        'date' => 'required',
        'time' => 'required',
    ];

    private $messages = [
        'required' => 'The :attribute field is required.',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = Schedule::with(['team1', 'team2'])->get();
        return view($this->viewPath . 'index')->withData($schedule);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedule = new Schedule();
        $teams = Team::get();
        return view($this->viewPath . 'form')->withData($schedule)->withTeams($teams);
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

        //Checking Validation
        if ($request->team1_id == $request->team2_id) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors(['Teams can not be the same!']);
        }

        if ($request->team1_type == $request->team2_type) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors(['Type can not be the same!']);
        }

        $newRequest = $request->except(['_token']);
        Schedule::create($newRequest);

        return redirect()->route($this->routePath . 'index')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $teams = Team::all();
        return view($this->viewPath . 'form')
            ->withData($schedule)
            ->withTeams($teams);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        validator()->make($request->all(), $this->rules, $this->messages)->validate();

        $newRequest = $request->except(['_token']);
        $schedule->update($newRequest);

        return redirect()->route($this->routePath . 'index')
            ->withMessage('Data Saved Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return boolean true/false
     */
    public function updateScore(Request $request)
    {
        $schedule = Schedule::findOrFail($request->id);
        $schedule->team1_score = $request->team1_score;
        $schedule->team2_score = $request->team2_score;

        $message = $schedule->save() ? ['success' => 'Data Saved Successfully'] : ['error' => 'Data Saved Unsuccessfully'];
        return response($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        try {
            $schedule->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */
    public function detailIndex($id)
    {
        $details = Schedule::with(['details.team', 'details.player'])->where('id', $id)->get();
        // dd($details);
        return view('admin.pages.schedules.details.index')->withData($details);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function getPlayer(Request $request)
    {
        $getPlayer = Player::where('team_id', $request->team_id)->get();
        return response()->json($getPlayer);
    }

    /**
     * Show the form for creating a new resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailCreate($id)
    {
        $details = Schedule::with(['team1', 'team2', 'details'])->where('id', $id)->get();
        $teams = Team::get();
        return view('admin.pages.schedules.details.form')->withTeams($teams)->withDetails($details);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detailStore(Request $request)
    {
        $rules = [
            'schedule_id' => 'required',
            'team_id' => 'required',
            'player_id' => 'required',
            'goal_time' => 'required',
        ];

        validator()->make($request->all(), $rules, $this->messages)->validate();

        $newRequest = $request->except(['_token']);
        DetailSchedule::create($newRequest);

        return redirect()->route('schedule.details', $request->schedule_id)
            ->withMessage('Data Saved Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailDestroy($id)
    {
        try {
            $detailSchedule = DetailSchedule::findOrFail($id);
            $detailSchedule->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
