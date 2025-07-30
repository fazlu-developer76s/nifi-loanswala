@extends('layouts/app')
@section('content')
    <div class="container-fluid">
        <div id="content" class="app-content">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Member</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create Member</li>
                    </ol>
                    <h1 class="page-header mb-0">Member</h1>
                </div>
            </div>
            <!-- Row for equal division -->
            <div class="row">
                <!-- Table Section -->
                <div class="col-md-12">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex align-items-center" style="border-bottom: 1px solid #2196f3;">
                            <i class="fab fa-buromobelexperte fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                            Member List
                            <a href="{{ route('member.create') }}" class="ms-auto">
                                <button class="btn btn-primary">Create User</button>
                            </a>
                        </div>


                        <div class="card-body">
                            <form action="{{ route('export-users') }}" method="POST" class="mb-3">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="role" class="form-label">Select Role</label>
                                        <select name="role" id="role" class="form-select">
                                            <option value="">All Roles</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="provider" class="form-label">Select Provider</label>
                                        <select name="provider" id="provider" class="form-select">
                                            <option value="">All Providers</option>
                                            @foreach($providers as $provider)
                                                <option value="{{ $provider->id }}">{{ $provider->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 d-flex align-items-end">
                                        <button type="submit" class="btn btn-success">Export Member</button>
                                    </div>
                                </div>
                            </form>
                            <table id="data-table-default" class="table table-striped table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th class="text-nowrap">User Id</th>
                                        <th class="text-nowrap">Name</th>
                                        <th class="text-nowrap">Email</th>
                                        <th class="text-nowrap">Mobile No.</th>
                                        <th class="text-nowrap">Aadhar No.</th>
                                        <th class="text-nowrap">Pan No.</th>
                                        <th class="text-nowrap">Role</th>
                                        <th class="text-nowrap">Created Date</th>
                                        <th class="text-nowrap">Status</th>
                                        <th class="text-nowrap">Verified</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($allmember)
                                    @foreach ($allmember as $member)
                                    <tr class="odd gradeX">
                                        <td width="1%" class="fw-bold text-dark">{{ $loop->iteration }}</td>
                                        <td>{{ $member->member_id }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->mobile_no }}</td>
                                        <td>{{ $member->aadhar_no }}</td>
                                        <td>{{ $member->pan_no }}</td>
                                        <td>{{ $member->title }} {{ ($member->role_id == 7) ? ' ( ' . $member->provider_title . ' )' : '' ; }}</td>
                                        <td>{{ \Carbon\Carbon::parse($member->created_at)->format('d F Y h:i A') }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{ $member->id }}" {{ ($member->status==1) ? 'checked' : '' }}  onchange="ChangeStatus('users',{{ $member->id }});" >
                                              </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="user_verified{{ $member->id }}" {{ ($member->is_user_verified==1) ? 'checked' : '' }}  onchange="UserVerified('users',{{ $member->id }});" >
                                              </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('member.edit', $member->id) }} {{ ($member->role_id == 7) ? '?role_id=7' : ''  }}" class="text-primary me-2">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('member.destroy', $member->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this member?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
