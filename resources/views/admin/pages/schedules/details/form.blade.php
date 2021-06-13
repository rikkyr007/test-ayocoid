@extends('layouts.admin-master')

@section('title', 'Add Goal Event')

@section('content')
<section class="section">
    <div class="section-header">
        <h1 class="card-title">Add New Goal Event </h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('scheduleDetail.store') }}">
                            @csrf
                            <input type="hidden" name="schedule_id" value="{{ $details[0]['id'] }}">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="team_id">Team Name</label>
                                        <select class="form-control" name="team_id" id="team_id" onchange="getPlayer()">
                                            <option value="" selected disabled>-- Please Choose --</option>
                                            <option value="{{ $details[0]['team1']['id'] }}">
                                                {{ $details[0]['team1']['name'] }}
                                            </option>
                                            <option value="{{ $details[0]['team2']['id'] }}">
                                                {{ $details[0]['team2']['name'] }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="player_id">Player Name</label>
                                        <select class="form-control" name="player_id" id="player_id">
                                            <option value="" selected disabled>-- Please Choose --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="goal_time">Goal Event</label>
                                <input type="text" class="form-control" name="goal_time" id="goal_time"
                                    placeholder='Example: 13" (mean at minutes 13)' value="{{ old('goal_time') }}">
                            </div>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                            <a href="{{ route('schedule.details', $details[0]['id']) }}" class="btn btn-warning"><i
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
@push('scripts')
<script>
    $(document).ready(() => {
        $('#player_id').select2();
    });

    const getPlayer = (id) => {
        let teamId = $("#team_id").val();
        $("#player_id").html("");
        $.ajax({
            type: "post",
            url: "{{ route('scheduleDetail.getPlayer')}}",
            data: {
                team_id: teamId,
            },
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (datas) {
                datas.map((data) => {
                    $("#player_id").append(
                        `<option value='${data.id}'>${data.name}</option>`
                    );
                });
            }
        });
    }

</script>
@endpush
