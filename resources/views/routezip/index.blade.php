@extends('layouts/app')
@section('content')
@if(isset($get_routezip))
@php $form_action = "routezip.update" @endphp
@else
@php $form_action = "routezip.create" @endphp
@endif
    <div class="container-fluid">
        <div id="content" class="app-content">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Route ZipCode</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create Route ZipCode</li>
                    </ol>
                    <h1 class="page-header mb-0">Route ZipCode</h1>
                </div>
            </div>
            <!-- Row for equal division -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-user-shield fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                                Add Route ZipCode
                            </div>
                        </div>
                        <form action="{{ route($form_action) }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ (isset($get_routezip)) ? $get_routezip->id : '' ; }}" name="hidden_id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Select Route </label>
                                            <select class="form-control custom-select-icon @error('route_id') is-invalid @enderror" name="route_id">
                                                <option value="">Select Route</option>
                                                @if($allroute)
                                                    @foreach ($allroute as $routes)
                                                        <option value="{{ $routes->id }}" @if(empty($get_routezip)) {{ old('route_id') == $routes->id ? 'selected' : '' }} @else {{ (isset($get_routezip) && $get_routezip->route_id == $routes->id) ? 'selected' : '' ; }} @endif>{{ $routes->route.' ( '.$routes->title.' )' }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('route_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Route ZipCode</label>
                                            <input class="form-control @error('zip_code') is-invalid @enderror" type="text" name="zip_code" placeholder="Enter ZipCode" value="@if(empty($get_routezip)) {{ old('zip_code') }} @else {{ (isset($get_routezip)) ? $get_routezip->zip_code : '' ; }} @endif" />
                                            @error('zip_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Route ZipCode Status</label>
                                            <select class="form-control custom-select-icon @error('status') is-invalid @enderror" name="status">
                                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }} {{ (isset($get_routezip) && $get_routezip->status == 1) ? 'selected' : '' ; }}>Active Route ZipCode</option>
                                                <option value="2" {{ old('status') == 2 ? 'selected' : '' }} {{ (isset($get_routezip) && $get_routezip->status == 2) ? 'selected' : '' ; }}>Inactive Route ZipCode</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-none d-flex p-3">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="col-md-6">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex align-items-center" style="border-bottom: 1px solid #2196f3;">
                            <i class="fab fa-buromobelexperte fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                            Route ZipCode List
                        </div>
                        <div class="card-body">
                            <table id="data-table-default" class="table table-striped table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th class="text-nowrap">Route</th>
                                        <th class="text-nowrap">Name</th>
                                        <th class="text-nowrap">ZipCode</th>
                                        <th class="text-nowrap">Created Date</th>
                                        <th class="text-nowrap">Status</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($allroutezip)
                                    @foreach ($allroutezip as $routezip)
                                    <tr class="odd gradeX">
                                        <td width="1%" class="fw-bold text-dark">{{ $loop->iteration }}</td>
                                        <td>{{ $routezip->route }}</td>
                                        <td>{{ $routezip->name }}</td>
                                        <td>{{ $routezip->zip_code }}</td>
                                        <td>{{ \Carbon\Carbon::parse($routezip->created_at)->format('d F Y h:i A') }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{ $routezip->id }}" {{ ($routezip->status==1) ? 'checked' : '' }}  onchange="ChangeStatus('routezips',{{ $routezip->id }});" >
                                              </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('routezip.edit', $routezip->id) }}" class="text-primary me-2">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('routezip.destroy', $routezip->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this routezip?');">
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
