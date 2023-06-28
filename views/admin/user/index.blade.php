@extends('admin.layouts.layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card table-responsive">
              <div class="card-header">
                <h3 class="card-title">User Details</h3>
                <div style="float:right">
                    <a href="{{ route('users.index',['export'=>true,'exportType'=>'excel']) }}" class="btn ipfs-button"><i class="fa fa-file-excel-o"></i> Excel</a>
                    <a href="{{ route('users.index',['export'=>true,'exportType'=>'pdf']) }}" class="btn ipfs-button"><i class="fa fa-file-pdf-o"></i> PDF</a>
                    <a href="{{ route('users.index',['export'=>true,'exportType'=>'csv']) }}" class="btn ipfs-button"><i class='fas fa-file-csv'></i> CSV</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="user-table" class="table table-bordered table-hover ">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Nationality</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Singup Type</th>
                    <th>Registration Date</th>
                    <th>Membership Level</th>
                    <th>Valid Date</th>
                    <th>Number Of Admin's Albums</th>
                    <th>Number Of Follow</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $i++."." }}</td>
                            <td>
                                <a href="{{ $user->profilePic }}" target="_blank">
                                    <img src="{{ $user->profilePic }}" alt="user" class="brand-image img-circle img-circle" style="width: 50px; height: 50px;">
                                </a>
                            </td>
                            <td>{{ (!$user->first_name) ? "N/A" :$user->first_name.' '.$user->last_name; }}</td>
                            <td>{{ $user->nationality ?? "N/A" }}</td>
                            <td>{{ $user->email ?? "N/A" }}</td>
                            <td>{{ (!$user->phoneNumber) ? "N/A" : ($user->countryCode.' '.$user->phoneNumber); }}</td>
                            <td>
                                @if($user->type_of_login == 'email')
                                    Email
                                @elseif($user->singup_type == 'facebook')
                                    Facebook
                                @elseif($user->singup_type == 'instagram')
                                    Instagram
                                @elseif($user->singup_type == 'google')
                                    Google
                                @elseif($user->singup_type == 'twitter')
                                    Twitter
                                @endif
                            </td>
                            <td>{{ date_format(date_create($user->created_at),"d M, Y H:i A") }} </td>
                            <td>{{ $user->membershipLavel }} </td>
                            <td>{{ date_format(date_create($user->userExpireDate),"d M, Y H:i A") }} </td>
                            <td>{{ $user->number_of_admin }} </td>
                            <td>{{ $user->number_of_follower }} </td>
                            <td>
                                @if (!$user->deleted_at)
                                    <form action="{{ route('users.destroy',$user) }}" method="POST">
                                    <a href="{{ route('users.action', $user->id) }}" class="btn  ipfs-button" data-toggle="tooltip" data-placement="top"  title="Click to {{ ($user->status == 0) ? 'deactivate' : 'activate'; }}"><i class="fa  {{ ($user->status == 0) ? 'fa-check' : 'fa-times'; }}"></i></a>
                                    <a href="{{ route('users.show', $user) }}" class="ipfs-button btn " data-toggle="tooltip" data-placement="top"  title="View User"><i class="fa fa-eye"></i></a>
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn ipfs-button" data-toggle="tooltip" data-placement="top"  title="Delete User" onclick="return confirm('Are you sure want to delete this User!')" ><i class="fa fa-trash"></i></button>
                                    </form>

                                @else
                                    <a href="{{ route('users.restore', $user) }}" class="ipfs-button btn " data-toggle="tooltip" data-placement="top"  title="Restore User"><i class="fas fa-trash-restore"></i></a>
                                    <a href="{{ route('users.delete', $user) }}" class="ipfs-button btn " data-toggle="tooltip" data-placement="top"  title="Parmanent Delete User" onclick="return confirm('Are you sure want to delete this User!')"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr class="no-data-row">
                            <td colspan="5" rowspan="2" align="center">
                                <div class="message"><p>No data available in table</p></div>

                            </td>
                        </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@stop
