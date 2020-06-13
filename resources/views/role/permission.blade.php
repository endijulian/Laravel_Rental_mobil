@extends('layouts.TemplatePage')

@section('title')
    <title>Manajemen Permission - {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Permission</h1>
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{url('admin/role/permission/')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Setting permisssion untuk role {{$role->name}}</label>
                                <input type="text"  name="permission" class="form-control" disabled>
                            </div>
                            <button class="btn btn-primary btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
           
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-8">
                 @if (session('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    <h4 class="card-title">
                        {{"Setting permission untuk role : " . $role->name}}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ url('admin/role/permission/' . $role->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <table class="table table-bordered table-hover">
                                @foreach ($permission as $key => $row)
                                    <thead>
                                        <tr>
                                            <td>{{ucfirst($key)}} </td>
                                            <td colspan="2">
                                            @foreach ($row as $item)
                                            
                                                <input type="checkbox" value="{{$item->name}}" {{in_array($item->name, $rolePermissions) ? 'checked' : ''}}  name="permission[]">
                                                <label for="male">{{$item->name}}</label><br>
                                        
                                            @endforeach
                                            </td>
                                        </tr>
                                    </thead>
                                @endforeach
                        </table>
                        <div class="float-right">
                            <button class="btn btn-primary btn-sm"> Assign Permission </button>
                        </div>
                       </form>
                    </div>
                    <div class="float-right">
                    {{-- {!!$role->links()!!} --}}
                    </div> 
                </div>
            </div>
           
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
           

            <!-- Pie Chart -->
            
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              

              <!-- Color System -->
             

            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              

              <!-- Approach -->
              

            </div>
          </div>

        </div>
@endsection
