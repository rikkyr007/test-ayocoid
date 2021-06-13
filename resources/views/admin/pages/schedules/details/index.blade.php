@extends('layouts.admin-master')

@section('title','Goal Event Master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Goal Event ( {{ $data[0]['team1']->name }} VS {{  $data[0]['team2']->name }} )</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="{{ route('scheduleDetail.create', $data[0]->id)}}"><i
                                class="fa fa-plus"></i>
                            Add
                            New</a> &nbsp;
                        <button class="btn btn-info" id="score-modal"> <i class="fa fa-star"></i> Update Score</button>
                        &nbsp;
                        <a class="btn btn-warning" href="{{ route('schedules.index')}}"><i class="fa fa-undo"></i>
                            Back</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Team Name</th>
                                        <th>Player Name</th>
                                        <th>Goal Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($data as $datas)
                                    @foreach ($datas['details'] as $detail)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $detail['team']['name'] }}</td>
                                        <td>{{ $detail['player']['name'] }}</td>
                                        <td>{{ $detail['goal_time'] }}</td>
                                        <td>
                                            <button
                                                onClick="del('{{ route('scheduleDetail.destroy', $detail['id']) }}')"
                                                class='btn btn-danger' title='Delete'>Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        let scheduleId = window.location.pathname.split("/").pop();
        let team1Name = @json($data[0]['team1']['name']);
        let team2Name = @json($data[0]['team2']['name']);

        $('#table-1').DataTable();

        $('#score-modal').fireModal({
            title: 'Update Score',
            body: `
            <form id="scoreForm">
                <div class="form-group">
                    <label for="team1_score">${team1Name}</label>
                    <input type="number" class="form-control" name="team1_score" min="0" max="100" placeholder="Enter team score">
                </div>
                <div class="form-group">
                    <label for="team2_score">${team2Name}</label>
                    <input type="number" class="form-control" name="team2_score" min="0" max="100" placeholder="Enter team score">
                </div>
            </form>`,
            buttons: [{
                    submit: true,
                    class: 'btn btn-success',
                    id: 'submit-button',
                    text: 'Save',
                    handler: () => {
                        let datas = new FormData(document.getElementById("scoreForm"));
                        let team1Score = datas.get('team1_score');
                        let team2Score = datas.get('team2_score');
                        $.ajax({
                            type: "post",
                            url: "{{ route('schedule.updateScore') }}",
                            data: {
                                id: scheduleId,
                                team1_score: team1Score,
                                team2_score: team2Score
                            },
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function (data) {
                                return data;
                            }
                        });
                    }
                },
                {
                    text: 'Close',
                    class: 'btn btn-secondary',
                    handler: function (current_modal) {
                        $.destroyModal(current_modal);
                    }
                }
            ]
        });
    });

</script>
@endpush
