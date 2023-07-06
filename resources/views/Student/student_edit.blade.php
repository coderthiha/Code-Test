@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if (session('status'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('status')}}
                </div>
            @endif
            
            <div class="card">
                <div class="card-header bg-success">
                <p class="m-0" style="float: left; color: #fff; font-size: 25px;"><i class="fa-solid fa-user-graduate" style="color: #fff;"></i> Edit Student</p>
                </div>

                <div class="card-body">
                                       
                    <!-- form start -->
                    <form role="form" method="POST" enctype="multipart/form-data" action="/student/{{Crypt::encrypt($student->id)}}">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Student Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$student->name}}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Student Name is Required.</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$student->email}}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{$student->phone}}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Phone Number is Required.</strong>
                                    </span>
                                @enderror
                            </div>

                            @if($student->img != '')
                            <div class="form-group">
                                <label for="email" class="col-form-label" style="color:rgba(0,0,0,0.5);">Previous Profile Picture</label><br>
                                <img id="previous" src="{{URL::asset('uploads/'.unserialize($student->img)[0])}}" alt="img" width="200px;" height="200px;" style="border-radius: 10px;">
                            </div>
                            @endif

                            <label for="exampleInputEmail1" style="">Student Profile</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="customFile" name="file[]" multiple>
                                <label class="custom-file-label @error('file') is-invalid @enderror" for="customFile" style="color:rgba(0,0,0,0.5);font-style: italic;font-size: 14px;">Choose Your Photo</label>
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Student Profile is Required.</strong>
                                    </span>
                                @enderror
                            </div>

                            <script>
                                $(".custom-file-input").on("change", function() {
                                var fileName = $(this).val().split("\\").pop();
                                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                });
                            </script>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="" class="form-control">{{$student->address}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="remark">Remark <span style="color: green;">(Optional)</span></label>
                                <textarea name="remark" id="" class="form-control">{{$student->remark}}</textarea>
                            </div>
                                    
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="/student"  class="btn btn-secondary pull-right">Back</a>
                        </div><!-- /.card-body -->

                    </form>

                </div>    
            </div>

        </div>
    </div>
</div>
@endsection
