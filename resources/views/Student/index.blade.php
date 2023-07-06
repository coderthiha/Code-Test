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
            
            <div class="card shadow-lg">
                <div class="card-header bg-success">
                <p class="m-0" style="float: left; color: #fff; font-size: 25px; font-weight: ;"><i class="fa-solid fa-user-graduate" style="color: #fff;"></i> Student List</p>

                <div class="input-group float-right col-md-3 mb-2">
                    <input style="" type="text" class="form-control" id="myInput" placeholder="Search...">
                </div>

                <script>
                $(document).ready(function(){
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                });
                </script>

                <a href="/student/create" class="btn btn-primary btn-md" style="float: right; color: #fff;"><i class="fas fa-plus"></i> Add New</a>
                </div>

                <div class="card-body">
                    <table id="item" class="table table-bordered table-striped dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;">No.</th>
                                <th style="vertical-align: middle;">Profile</th>
                                <th style="vertical-align: middle;">Name</th>
                                <th style="vertical-align: middle;">Email</th>
                                <th style="vertical-align: middle;">Phone</th>
                                <th style="vertical-align: middle;">Address</th>
                                <th style="vertical-align: middle;">Remark</th>
                                <th style="vertical-align: middle;">Option</th>
                            </tr>
                        </thead>
                            <tbody id="myTable">
                                <tr>
                                    @php($no=0)
                                    @foreach ($data as $datas)
                                    @php($no++)
                                    <td style="font-size: 14px; vertical-align: middle;">{{$no}}</td>
                                    <td style="vertical-align: middle;">
                                        @if($datas->img == '')
                                            <i class="text-center" style="font-size: 14px; vertical-align: middle;">No Photo</i>
                                        @else
                                            <!-- Button trigger modal -->
                                            <a data-toggle="modal" data-target="#exampleModalLong{{$no}}" title="view image">
                                                <img src="{{URL::asset('uploads/'.unserialize($datas->img)[0])}}" alt="img" width="100px" height="100px;" style="vertical-align: middle;margin: 0; padding: 0;">
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalLong{{$no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

                                                <button type="button" class="close mt-3 mr-5" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" style="color: blue;font-size: 40px;">&times;</span>
                                                </button><br>

                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content" style="background-color:transparent;">
                                                        <div class="modal-body" style="margin: 0; padding: 0;">
                                                            <img id="" src="{{URL::asset('uploads/'.unserialize($datas->img)[0])}}" alt="img" width="100%" height="100%" style="border-radius: 5px;border: 1px solid #fff;">
                                                        </div>
                                                    </div>
                                                    <p class="text-center" style="color: #fff;">{{unserialize($datas->img)[0]}}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td style="font-size: 14px; vertical-align: middle;" class="text-left">{{$datas->name}}</td>
                                    <td style="font-size: 14px; vertical-align: middle;" class="text-left">{{$datas->email}}</td>
                                    <td style="font-size: 14px; vertical-align: middle;" class="text-left">{{$datas->phone}}</td>
                                    <td style="font-size: 14px; vertical-align: middle;" class="text-left">{{$datas->address}}</td>
                                    <td style="font-size: 14px; vertical-align: middle;">
                                        @if($datas->remark == '')
                                        <span class="text-center" style="font-size: 14px;">---</span>
                                        @else
                                        {{$datas->remark}}
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <div class="form-row">
                                        <a href="/student/{{Crypt::encrypt($datas->id)}}/edit" class="btn btn-warning" style="height: px;margin-right: 10px;width:px;"><i class="fas fa-pen"></i></a>
                                        <form method="POST" action="/student/{{Crypt::encrypt($datas->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                        </div>
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
@endsection
