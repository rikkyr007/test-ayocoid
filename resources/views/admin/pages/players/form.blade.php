@extends('layouts.admin-master')

@section('title', $data->id ? 'Update Player':'Add Player')

@section('content')
<section class="section">
    <div class="section-header">
        <h1 class="card-title">{{($data->id ? 'Update' : 'Add New')}} {{ $data->name ?? '' }} </h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $data->id ? route('players.update', $data->id) : route('players.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if(isset($data->id))
                            @method('PATCH')
                            @endif
                            <input type="hidden" class="form-control" name="team_id" id="team_id" readonly
                                value="{{ Session::get('teamId')}}">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter player name.."
                                    value="{{ ($data->name) ?  $data->name : old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="height">Height (CM)</label>
                                <input type="number" class="form-control" name="height" id="height"
                                    placeholder="Enter player height.." min="0" max="200"
                                    value="{{ ($data->height) ?  $data->height : old('height')}}">
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight (KG)</label>
                                <input type="number" class="form-control" name="weight" id="weight"
                                    placeholder="Enter player weight.." min="0" max="150"
                                    value="{{ ($data->weight) ?  $data->weight : old('weight')}}">
                            </div>
                            <div class="form-group">
                                <label for="position">Position</label>
                                <select name="position" id="position" class="form-control">
                                    <option value="" disabled selected>-- Please Choose --</option>
                                    <option value="Striker"
                                        {{ $data->position == 'Striker' || old('position') == 'Striker' ? 'selected' : ''}}>
                                        Striker
                                    </option>
                                    <option value="Forward"
                                        {{ $data->position == 'Forward' || old('position') == 'Forward' ? 'selected' : ''}}>
                                        Forward
                                    </option>
                                    <option value="Winger"
                                        {{ $data->position == 'Winger' || old('position') == 'Winger' ? 'selected' : ''}}>
                                        Winger
                                    </option>
                                    <option value="Attacking Midfielder"
                                        {{ $data->position == 'Attacking Midfielder' || old('position') == 'Attacking Midfielder' ? 'selected' : ''}}>
                                        Attacking
                                        Midfielder</option>
                                    <option value="Central Midfielder"
                                        {{ $data->position == 'Central Midfielder' || old('position') == 'Central Midfielder' ? 'selected' : ''}}>
                                        Central
                                        Midfielder</option>
                                    <option value="Defensive Midfielder"
                                        {{ $data->position == 'Defensive Midfielder' || old('position') == 'Defensive Midfielder' ? 'selected' : ''}}>
                                        Defensive
                                        Midfielder</option>
                                    <option value="Wing-Back"
                                        {{ $data->position == 'Wing-Back' || old('position') == 'Wing-Back' ? 'selected' : ''}}>
                                        Wing-Back</option>
                                    <option value="Full-Back"
                                        {{ $data->position == 'Full-Back' || old('position') == 'Full-Back' ? 'selected' : ''}}>
                                        Full-Back</option>
                                    <option value="Centre Back"
                                        {{ $data->position == 'Centre Back' || old('position') == 'Centre Back' ? 'selected' : ''}}>
                                        Centre Back</option>
                                    <option value="Sweeper"
                                        {{ $data->position == 'Sweeper' || old('position') == 'Sweeper' ? 'selected' : ''}}>
                                        Sweeper
                                    </option>
                                    <option value="Goalkeeper"
                                        {{ $data->position == 'Goalkeeper' || old('position') == 'Goalkeeper' ? 'selected' : ''}}>
                                        Goalkeeper</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="back_number">Back Number (Unique)</label>
                                <input type="number" class="form-control" name="back_number" id="back_number"
                                    placeholder="Enter player back number.." min="0"
                                    value="{{ ($data->back_number) ?  $data->back_number : old('back_number')}}">
                            </div>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                            <a href="{{ route('players.show', Session::get('teamId')) }}" class="btn btn-warning"><i
                                    class="fa fa-undo"></i>
                                Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
