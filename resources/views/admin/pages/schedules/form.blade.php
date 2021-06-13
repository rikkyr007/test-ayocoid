@extends('layouts.admin-master')

@section('title', $data->id ? 'Update Schedule':'Add Schedule')

@section('content')
<section class="section">
    <div class="section-header">
        <h1 class="card-title">{{($data->id ? 'Update' : 'Add New')}} Schedule </h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $data->id ? route('schedules.update', $data->id) : route('schedules.store') }}">
                            @csrf
                            @if(isset($data->id))
                            @method('PATCH')
                            @endif
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="team1_id">Team 1</label>
                                        <select class="js-example-basic-single form-control" name="team1_id" id="team1">
                                            <option value="" selected disabled>-- Please Choose --</option>
                                            @foreach ($teams as $team)
                                            <option value="{{ $team->id }}"
                                                {{ $data->team1_id == $team->id || old('team1_id') == $team->id ? 'selected' : ''}}>
                                                {{ $team->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-2 col-md-2 col-sm-12 col-12 d-flex align-items-center justify-content-center">
                                    <h3>VS</h3>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="team2_id">Team 2</label>
                                        <select class="js-example-basic-single form-control" name="team2_id" id="team2">
                                            <option value="" selected disabled>-- Please Choose --</option>
                                            @foreach ($teams as $team)
                                            <option value="{{ $team->id }}"
                                                {{ $data->team2_id == $team->id || old('team2_id') == $team->id ? 'selected' : ''}}>
                                                {{ $team->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="team1_type">Team 1 Type</label>
                                        <select class="form-control" name="team1_type" id="team1_type">
                                            <option value="" selected disabled>-- Please Choose --</option>
                                            <option value="Home"
                                                {{ $data->team1_type == "Home" || old('team1_type') == "Home" ? 'selected' : ''}}>
                                                Home
                                            </option>
                                            <option value="Away"
                                                {{ $data->team1_type == "Away" || old('team1_type') == "Away" ? 'selected' : ''}}>
                                                Away
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12 col-12 d-flex justify-content-center">

                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="team2_type">Team 2 Type</label>
                                        <select class="form-control" name="team2_type" id="team2_type">
                                            <option value="" selected disabled>-- Please Choose --</option>
                                            <option value="Home"
                                                {{ $data->team2_type == "Home" || old('team2_type') == "Home" ? 'selected' : ''}}>
                                                Home
                                            </option>
                                            <option value="Away"
                                                {{ $data->team2_type == "Away" || old('team2_type') == "Away" ? 'selected' : ''}}>
                                                Away
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" name="date" id="date"
                                            placeholder="Enter schedule date"
                                            value="{{ ($data->date) ?  $data->date : old('date')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="time">Time</label>
                                        <input type="time" class="form-control" name="time" id="time"
                                            placeholder="Enter schedule time"
                                            value="{{ ($data->time) ?  $data->time : old('time')}}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                            <a href="{{ route('schedules.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i>
                                Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@push('scripts')
<script>
    $(document).ready(() => {
        $('#team1').select2();
        $('#team2').select2();
    });

</script>
@endpush
