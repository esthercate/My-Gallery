@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @include('common.errors')
                @include('common.success')
                <div class="card-header">Dashboard</div>
                <div class="card-body">

                    <form method="POST" action="{{route('images.store')}} " enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="image[]" class="form-control-file" multiple accept="image/*" >
                        </div>
                        <button class="btn btn-info" type="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
