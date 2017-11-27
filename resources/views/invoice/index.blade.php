@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
<ol class="breadcrumb">
      <li><a href="{{url('/')}}">Dashboard</a></li>
      <li class="active">List </li>
    </ol>
    <!-- top tiles -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="col-md-6">
                            <h2>University Invoice <small>list</small> </h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    
                        <table id="datatable-fixed-header" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>University name</th>
                                    <th>Number of Students</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @forelse($invoice as $list)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$list->institute->institute_name or ''}}</td>
                                        <td>{{count($list->selfInstitute)}}</td>
                                        <td><a href="{{url('invoice/'.$list->id)}}" class="btn btn-xs btn-info">View</a></td>
                                    </tr>
                                @empty

                        <tr>
                           <td colspan="12">Data empty</td>
                        </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
