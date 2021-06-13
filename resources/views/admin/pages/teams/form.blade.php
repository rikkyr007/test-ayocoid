@extends('layouts.admin-master')

@section('title', $data->id ? 'Update Team':'Add Team')

@section('content')
<section class="section">
    <div class="section-header">
        <h1 class="card-title">{{($data->id ? 'Update' : 'Add New')}} {{ $data->name ?? '' }} Team </h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $data->id ? route('teams.update', $data->id) : route('teams.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if(isset($data->id))
                            @method('PATCH')
                            @endif
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter team name.."
                                    value="{{ ($data->name) ?  $data->name : old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control" name="logo" id="logo">
                            </div>
                            <div class="form-group">
                                <label for="established">Established</label>
                                <input type="text" class="form-control" name="established" id="established"
                                    placeholder="Enter team established.."
                                    value="{{ ($data->established) ?  $data->established : old('established')}}">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" id="city"
                                    placeholder="Enter team city.."
                                    value="{{ ($data->city) ?  $data->city : old('city')}}">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address"
                                    placeholder="Enter team address..">{{ ($data->address) ?  $data->address : old('address')}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                            <a href="{{ route('teams.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i>
                                Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
