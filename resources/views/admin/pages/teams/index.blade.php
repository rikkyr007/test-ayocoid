@extends('layouts.admin-master')

@section('title','Team Master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Teams Master</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="{{ route('teams.create')}}"><i class="fa fa-plus"></i> Add
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
                                        <th>Name</th>
                                        <th>Logo</th>
                                        <th>Established</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($data as $team)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $team->name }}</td>
                                        <td><img src="{{ asset('uploads/team/'. $team->logo ) }}"
                                                alt="{{ $team->name }}" width="35px" height="35px"></td>
                                        <td>{{ $team->established }}</td>
                                        <td>{{ $team->address }}</td>
                                        <td>{{ $team->city }}</td>
                                        <td><a href="{{ route('players.show', $team->id )}}"
                                                class="btn btn-info">Players</a>
                                            <a href="{{ route('teams.edit', $team->id)}}"
                                                class="btn btn-warning">Update</a>
                                            <button onClick="del('{{ route('teams.destroy', $team->id) }}')"
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
    });

</script>
@endpush
