@extends('layouts.app') @section('content')
<div id="page-wrapper">
  @if(Session::has('message'))
  <p class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissable">{{ Session::get('message') }}</p>
  @endif
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
              <div class="col-sm-6">
                Users
              </div>
              <!-- <div class="col-sm-6">
                <a href= "{{ url('/pages/create') }}"><button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Add More Pages</button></a>
              </div> -->
            </div>
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
              <div class="row">
                <div class="col-sm-12">
                  <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Name</th>
                        <th class="sorting center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >Email</th>
                        <th class="sorting center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >Action</th>
                        <th class="sorting center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >Message</th>
                        <th class="sorting center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >Action Perform Date</th>
                        <!-- <th class="sorting center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >Shares</th>
                        <th class="sorting center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Created Time</th> -->
                      </tr>
                    </thead>
                    <tbody>
                          {{ csrf_field() }}
                      @if(count($users)) 
                        @foreach($users as $index => $user)
                          <tr class="gradeA odd" role="row">
                            <td class="sorting_1"><a href="{{ url('posts/'.$user->post_id.'/activity/'.$user->id) }}"><img src="{{ $user->avatar }}" width="30" height="30">  &nbsp;&nbsp; {{ $user->name }}</td>
                            <td class="center" >{{ $user->email }}</td>
                            <td class="center">{{ $user->action }}</td>
                            <td class="center">{{ $user->details }}</td>
                            @if(!is_null($user->action_perform))
                              <td class="center">{{ date("d M Y h:i:s" , strtotime($user->action_perform)) }}</td>
                            @else
                              <td class="center">NULL</td>
                            @endif
                          </tr>
                        @endforeach 
                      @else
                      <tr class="gradeA odd" role="row">
                        <td colspan="4">No data available</td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries </div>
                </div>
                <div class="col-sm-8">
                  <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                    {{ $users->links() }}
                  </div>
                </div>
              </div>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
  </div>
</div>
@endsection