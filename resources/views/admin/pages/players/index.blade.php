@extends('layouts.admin-master')

@section('title','Player Master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>List Player of {{ $data->name }}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="{{ route('players.create')}}"><i class="fa fa-plus"></i> Add
                            New</a> &nbsp;
                        <a class="btn btn-warning" href="{{ route('teams.index')}}"><i class="fa fa-undo"></i> Back</a>
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
                                        <th>Back Number</th>
                                        <th>Position</th>
                                        <th>Height & Weight</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($data->players as $player)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $player->name }}</td>
                                        <td>{{ $player->back_number }}</td>
                                        <td>{{ $player->position }}</td>
                                        <td>{{ $player->height }} CM / {{ $player->weight }} KG</td>
                                        <td>
                                            <a href="{{ route('players.edit', $player->id)}}"
                                                class="btn btn-warning">Update</a>
                                            <button onClick="del('{{ route('players.destroy', $player->id) }}')"
                                                class='btn btn-danger' title='Delete'>Delete</button>
                                        </td>
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
