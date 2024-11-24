@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Edit Slider</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Slider</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Preview</label>
                                <br>
                                <img width="150" src="{{asset($slider->banner)}}" alt="">
                            </div>

                            <div class="form-group">
                                <label>Banner</label>
                                <input type="file" class="form-control" name="banner">
                                @error('banner')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Header 1</label>
                                <input type="text" class="form-control" name="header_1" value="{{$slider->header_1}}" >
                                @error('header_1')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Header 2</label>
                                <input type="text" class="form-control" name="header_2" value="{{$slider->header_2}}" >
                                @error('header_2')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Header 3</label>
                                <input type="text" class="form-control" name="header_3" value="{{$slider->header_3}}">
                                @error('header_3')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Button URL</label>
                                <input type="url" class="form-control" name="btn_url" value="{{$slider->btn_url}}">
                                @error('btn_url')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Serial</label>
                                <input type="number" class="form-control" name="serial" value="{{$slider->serial}}">
                                @error('serial')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" >
                                    <option {{$slider->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                    <option {{$slider->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
