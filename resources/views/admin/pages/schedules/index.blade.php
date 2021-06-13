@extends('layouts.admin-master')

@section('title','Schedule Master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Schedule Master</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="{{ route('schedules.create')}}"><i class="fa fa-plus"></i> Add
                            New</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Team 1</th>
                                        <th>Team 2</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Score</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($data as $schedule)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $schedule['team1']['name'] }} ({{ $schedule->team1_type }})</td>
                                        <td>{{ $schedule['team2']['name'] }} ({{ $schedule->team2_type }})</td>
                                        <td>{{ $schedule->date }}</td>
                                        <td>{{ $schedule->time }}</td>
                                        <td>{{ $schedule->team1_score ?? '0'}} - {{ $schedule->team2_score ?? '0' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('schedule.details', $schedule->id)}}" class="btn
                                                btn-primary">Goal Event</a>
                                            <a href="{{ route('schedules.edit', $schedule->id)}}"
                                                class="btn btn-warning">Update</a>
                                            <button onClick="del('{{ route('schedules.destroy', $schedule->id) }}')"
                                                class='btn btn-danger' title='Delete'>Delete</button>
                                    </tr>
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
        $('#table-1').DataTable();

        $('#score-modal').fireModal({
            title: 'My Modal',
            body: '<h3> halo </h3>',
            buttons: [{
                    submit: true,
                    class: 'btn btn-success',
                    id: 'save',
                    text: 'Save',
                    handler: () => {
                        alert('Clicked');
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
