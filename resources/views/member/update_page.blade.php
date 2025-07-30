@extends('layouts/app')
@section('content')
@if(isset($get_member))
@php $form_action = "member.update" @endphp
@else
@php $form_action = "member.create" @endphp
@endif
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
                <!-- Form Section -->
                <div class="col-md-8">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-user-shield fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                                Add Member 
                            </div>
                            <a href="{{ route('member') }}">
                                <button class="btn btn-primary">List User</button>
                            </a>
                        </div>
                        <form action="{{ route($form_action) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ (isset($get_member)) ? $get_member->id : '' ; }}" name="hidden_id">
                            <div class="card-body">
                                <div class="row">
                                    @if(isset($_GET['role_id']) && $_GET['role_id'] == 7  )
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Member Role </label>
                                            <select class="form-control custom-select-icon @error('role_id') is-invalid @enderror" name="role_id" id="role_id" onchange="AddBank();">
                                                <option value="">Select Role</option>
                                                @if($get_role)
                                                    @foreach ($get_role as $role)
                                                        <option value="{{ $role->id }}"   @if(isset($_GET['role_id']) && $_GET['role_id'] == $role->id ) selected @endif  @if(isset($get_member) && $get_member->role_id == $role->id) ? selected : '' ;  @endif >{{ $role->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('role_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                     @elseif((isset($_GET['role_id']) && $_GET['role_id'] == 5) ||   (isset($_GET['role_id']) && $_GET['role_id'] == 6) )
                                      <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Member Role </label>
                                            <select class="form-control custom-select-icon @error('role_id') is-invalid @enderror" name="role_id" id="role_id" onchange="AddBank();">
                                                <option value="">Select Role</option>
                                                @if($get_role)
                                                    @foreach ($get_role as $role)
                                                        <option value="{{ $role->id }}"   @if(isset($_GET['role_id']) && $_GET['role_id'] == $role->id ) selected @endif   >{{ $role->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('role_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @elseif($get_member->role_id == 5 || $get_member->role_id == 6)
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Member Role </label>
                                            <select class="form-control custom-select-icon @error('role_id') is-invalid @enderror" name="role_id" id="role_id" onchange="AddBank();">
                                                <option value="">Select Role</option>
                                                @if($get_role)
                                                    @foreach ($get_role as $role)
                                                        <option value="{{ $role->id }}"     @if(isset($get_member) && $get_member->role_id == $role->id) ? selected : '' ;  @endif >{{ $role->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('role_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @else 
                                         <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Member Role </label>
                                            <select class="form-control custom-select-icon @error('role_id') is-invalid @enderror" name="role_id" id="role_id" onchange="AddBank();">
                                                <option value="">Select Role</option>
                                                @if($get_role)
                                                    @foreach ($get_role as $role)
                                                        <option value="{{ $role->id }}"   @if(isset($_GET['role_id']) && $_GET['role_id'] == $role->id ) selected @endif >{{ $role->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('role_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @endif

                                    @if((isset($_GET['role_id']) && $_GET['role_id'] == 7)) 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Provider </label>
                                            <select class="form-control custom-select-icon @error('provider_id') is-invalid @enderror" name="provider_id" id="provider_id" required>
                                                <option value="">Select Provider</option>
                                                @if($providers)
                                                    @foreach ($providers as $provider)
                                                        <option value="{{ $provider->id }}"  @if(empty($get_member)) {{ old('provider_id') == $provider->id ? 'selected' : '' }} @else {{ (isset($get_member) && $get_member->provider_id == $provider->id) ? 'selected' : '' ; }} @endif>{{ $provider->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('provider_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Enter Name" value="@if(empty($get_member)) {{ old('name') }} @else {{ (isset($get_member)) ? $get_member->name : '' ; }} @endif" />
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Enter Email" value=" @if(empty($get_member)) {{ old('email') }} @else {{ (isset($get_member)) ? $get_member->email : '' ; }} @endif" />
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Mobile No.</label>
                                            <input class="form-control @error('mobile_no') is-invalid @enderror" type="text" name="mobile_no" placeholder="Enter Mobile No." value="@if(empty($get_member)) {{ old('mobile_no') }} @else {{ (isset($get_member)) ? $get_member->mobile_no : '' ; }} @endif"   />
                                            @error('mobile_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @if(!empty($get_member))
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Alt Mobile No.</label>
                                            <input class="form-control @error('alt_mobile_no') is-invalid @enderror" type="text" name="alt_mobile_no" placeholder="Enter Aadhar No." value="@if(empty($get_member)) {{ old('alt_mobile_no') }} @else {{ (isset($get_member)) ? $get_member->alt_mobile_no : '' ; }} @endif" />
                                            @error('alt_mobile_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Occupation</label>
                                            <select class="form-control @error('occupation') is-invalid @enderror" name="occupation">
                                                <option value="">Select Occupation</option>
                                                <option value="Salaried"
                                                    @if(old('occupation') == 'Salaried' || (isset($get_member) && $get_member->occupation == 'Salaried')) selected @endif>
                                                    Salaried
                                                </option>
                                                <option value="Business"
                                                    @if(old('occupation') == 'Business' || (isset($get_member) && $get_member->occupation == 'Business')) selected @endif>
                                                    Business
                                                </option>
                                            </select>
                                            @error('occupation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Company Name</label>
                                            <input class="form-control @error('company_name') is-invalid @enderror" type="text" name="company_name" placeholder="Enter Company Name" value="@if(empty($get_member)) {{ old('company_name') }} @else {{ (isset($get_member)) ? $get_member->company_name : '' ; }} @endif" />
                                            @error('company_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Aadhar No.</label>
                                            <input class="form-control @error('aadhar_no') is-invalid @enderror" type="text" name="aadhar_no" placeholder="Enter Aadhar No." value="@if(empty($get_member)) {{ old('aadhar_no') }} @else {{ (isset($get_member)) ? $get_member->aadhar_no : '' ; }} @endif" />
                                            @error('aadhar_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pan No.</label>
                                            <input class="form-control @error('pan_no') is-invalid @enderror" type="text" name="pan_no" placeholder="Enter Pan No." value="@if(empty($get_member)) {{ old('pan_no') }} @else {{ (isset($get_member)) ? $get_member->pan_no : '' ; }} @endif" />
                                            @error('pan_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Account Holder Name</label>
                                            <input class="form-control @error('account_name') is-invalid @enderror" type="text" name="account_name" placeholder="Enter Account Name" value="@if(empty($get_member)) {{ old('account_name') }} @else {{ (isset($get_member)) ? $get_member->account_name : '' ; }} @endif" />
                                            @error('account_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Account No.</label>
                                            <input class="form-control @error('account_no') is-invalid @enderror" type="text" name="account_no" placeholder="Enter Account No." value="@if(empty($get_member)) {{ old('account_no') }} @else {{ (isset($get_member)) ? $get_member->account_no : '' ; }} @endif" />
                                            @error('account_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Ifsc Code</label>
                                            <input class="form-control @error('ifsc_code') is-invalid @enderror" type="text" name="ifsc_code" placeholder="Enter Aadhar No." value="@if(empty($get_member)) {{ old('ifsc_code') }} @else {{ (isset($get_member)) ? $get_member->ifsc_code : '' ; }} @endif" />
                                            @error('ifsc_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Upload Bank Statement/Cancelled Check</label>
                                            <input class="form-control @error('bank_statement') is-invalid @enderror" type="file" name="bank_statement" />
                                            @error('bank_statement')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @if(!empty($get_member->bank_statement))
                                            <a href="{{ asset('storage/' . $get_member->bank_statement) }}" target="_blank">View This Document</a>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">ID Card For Salaried</label>
                                            <input class="form-control @error('id_card_upload') is-invalid @enderror" type="file" name="id_card_upload" />
                                            @error('id_card_upload')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @if(!empty($get_member->id_card_upload))
                                            <a href="{{ asset('storage/' . $get_member->id_card_upload) }}" target="_blank">View This Document</a>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Office Photo</label>
                                            <input class="form-control @error('office_photo') is-invalid @enderror" type="file" name="office_photo" />
                                            @error('office_photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @if(!empty($get_member->office_photo))
                                            <a href="{{ asset('storage/' . $get_member->office_photo) }}" target="_blank">View This Document</a>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">State</label>
                                            <select class="form-control @error('state') is-invalid @enderror" name="state">
                                                <option value="">Select State</option>
                                                @foreach($states as $state)
                                                    <option value="{{ $state }}"
                                                        @if(old('state') == $state || (isset($get_member) && $get_member->state == $state))
                                                            selected
                                                        @endif>
                                                        {{ $state }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">District</label>
                                            <input class="form-control @error('district') is-invalid @enderror" type="text" name="district" placeholder="Enter Aadhar No." value="@if(empty($get_member)) {{ old('district') }} @else {{ (isset($get_member)) ? $get_member->district : '' ; }} @endif" />
                                            @error('district')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tehsil</label>
                                            <input class="form-control @error('tehsil') is-invalid @enderror" type="text" name="tehsil" placeholder="Enter Aadhar No." value="@if(empty($get_member)) {{ old('tehsil') }} @else {{ (isset($get_member)) ? $get_member->tehsil : '' ; }} @endif" />
                                            @error('tehsil')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Town</label>
                                            <input class="form-control @error('town') is-invalid @enderror" type="text" name="town" placeholder="Enter Aadhar No." value="@if(empty($get_member)) {{ old('town') }} @else {{ (isset($get_member)) ? $get_member->town : '' ; }} @endif" />
                                            @error('town')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pin Code</label>
                                            <input class="form-control @error('pin_code') is-invalid @enderror" type="text" name="pin_code" placeholder="Enter Aadhar No." value="@if(empty($get_member)) {{ old('pin_code') }} @else {{ (isset($get_member)) ? $get_member->pin_code : '' ; }} @endif" />
                                            @error('pin_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter Password." autocomplete=""/>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Member Status</label>
                                            <select class="form-control custom-select-icon @error('status') is-invalid @enderror" name="status">
                                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }} {{ (isset($get_member) && $get_member->status == 1) ? 'selected' : '' ; }}>Active Member</option>
                                                <option value="2" {{ old('status') == 2 ? 'selected' : '' }} {{ (isset($get_member) && $get_member->status == 2) ? 'selected' : '' ; }}>Inactive Member</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="card-footer bg-none d-flex p-3">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@if(request()->segment(2) == 'edit')
<script>
function AddBank() {
    var role_id = $("#role_id").val();
      
        var leadRoute = "{{ route('member.edit' , $get_member->id) }}";
        var newUrl = leadRoute + "?role_id=" + role_id;
        window.location.href = newUrl;

}
$(document).ready(function() {
    AddBank(); // Call function on page load
});
</script>

@endif
