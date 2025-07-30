@extends('layouts/app')
@section('content')
    @if (isset($get_lead))
        @php $form_action = "lead.update" @endphp
    @else
        @php $form_action = "lead.create" @endphp
    @endif
    <div class="container-fluid">
        <div id="content" class="app-content">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Lead</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create Lead</li>
                    </ol>
                    <h1 class="page-header mb-0">Lead</h1>
                </div>
            </div>
            <!-- Row for equal division -->
            <div class="row">
                <!-- Form Section -->
                <div class="col-md-12">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-user-shield fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                                Add Lead
                            </div>
                            <a href="{{ route('lead') }}">
                                <button class="btn btn-primary">List Lead</button>
                            </a>
                        </div>
                        <form action="{{ route($form_action) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ isset($get_lead) ? $get_lead->id : '' }}" name="hidden_id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Customer Info -->
                                        <div class="bordered mb-3">
                                            <h6 class="section-title text-primary">Customer Information</h6>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label class="custom-label">Full Name:</label>
                                                    <input type="text" class="form-control" name="full_name" value="{{ old('full_name', $get_lead->full_name ?? '') }}">
                                                    @error('full_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="custom-label">Father Name:</label>
                                                    <input type="text" class="form-control" name="father_name" value="{{ old('father_name', $get_lead->father_name ?? '') }}">
                                                    @error('father_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="custom-label">Date Of Birth:</label>
                                                    <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $get_lead->date_of_birth ?? '') }}">
                                                    @error('date_of_birth')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="custom-label">Residence Address:</label>
                                                    <input type="text" class="form-control" name="address" value="{{ old('address', $get_lead->address ?? '') }}">
                                                    @error('address')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                {{-- <div class="col-md-3">
                                                    <label class="custom-label">State Name:</label>
                                                    <input type="text" class="form-control" name="state" value="{{ old('state', $get_lead->state ?? '') }}">
                                                    @error('state')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div> --}}

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">State</label>
                                                        <select class="form-control @error('state') is-invalid @enderror" name="state">
                                                            <option value="">Select State</option>
                                                            @foreach($states as $state)
                                                                <option value="{{ $state }}"
                                                                    @if(old('state') == $state || (isset($get_lead) && $get_lead->state == $state))
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

                                                <div class="col-md-3">
                                                    <label class="custom-label">District Name:</label>
                                                    <input type="text" class="form-control" name="district_name" value="{{ old('district_name', $get_lead->district_name ?? '') }}">
                                                    @error('district_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="custom-label">Tehsil/Taluka Name:</label>
                                                    <input type="text" class="form-control" name="tehsil_taluka" value="{{ old('tehsil_taluka', $get_lead->tehsil_taluka ?? '') }}">
                                                    @error('tehsil_taluka')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="custom-label">Pin Code:</label>
                                                    <input type="text" class="form-control" name="pin_code" value="{{ old('pin_code', $get_lead->pin_code ?? '') }}">
                                                    @error('pin_code')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-6">
                                                    <label class="custom-label">Loan Amount:</label>
                                                    <input type="text" class="form-control" name="loan_amount" value="{{ old('loan_amount', $get_lead->loan_amount ?? '') }}">
                                                    @error('loan_amount')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Occupation Details -->
                                            <div class="bordered mb-3">
                                                <h6 class="section-title text-warning">Occupation Details</h6>
                                                <div class="row mb-2">
                                                    <div class="col-md-3">
                                                        <label class="custom-label">Income:</label>
                                                        <input type="text" class="form-control" name="income" value="{{ old('income', $get_lead->income ?? '') }}">
                                                        @error('income')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="custom-label">Income Proof Name:</label>
                                                        <input type="text" class="form-control" name="income_proof_name" value="{{ old('income_proof_name', $get_lead->income_proof_name ?? '') }}">
                                                        @error('income_proof_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="custom-label">Residence Lat:</label>
                                                        <input type="text" class="form-control" name="res_lat" value="{{ old('res_lat', $get_lead->res_lat ?? '') }}">
                                                        @error('res_lat')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="custom-label">Residence Long:</label>
                                                        <input type="text" class="form-control" name="res_long" value="{{ old('res_long', $get_lead->res_long ?? '') }}">
                                                        @error('res_long')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Service </label>
                                                        <select class="form-control custom-select-icon @error('service_id') is-invalid @enderror" name="service_id">
                                                            <option value="">Select Service</option>
                                                            @if($get_service)
                                                                @foreach ($get_service as $service)
                                                                    <option value="{{ $service->id }}" @if(empty($get_lead)) {{ old('service_id') == $service->id ? 'selected' : '' }} @else {{ (isset($get_lead) && $get_lead->service_id == $service->id) ? 'selected' : '' ; }} @endif >{{ ucwords($service->title) }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('service_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <p>Business/Office Location:</p>
                                                    <div class="col-md-3">
                                                        <label class="custom-label">Lat:</label>
                                                        <input type="text" class="form-control" name="business_lat" value="{{ old('business_lat', $get_lead->business_lat ?? '') }}">
                                                        @error('business_lat')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="custom-label">Long:</label>
                                                        <input type="text" class="form-control" name="business_long" value="{{ old('business_long', $get_lead->business_long ?? '') }}">
                                                        @error('business_long')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                  <div class="col-md-3">
                                                    <label class="custom-label">Business Address:</label>
                                                    <input type="text" class="form-control" name="business_address" value="{{ old('business_address', $get_lead->business_address ?? '') }}">
                                                    @error('business_address')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">State</label>
                                                        <select class="form-control @error('business_state') is-invalid @enderror" name="business_state">
                                                            <option value="">Select State</option>
                                                            @foreach($states as $state)
                                                                <option value="{{ $state }}"
                                                                    @if(old('state') == $state || (isset($get_lead) && $get_lead->business_state == $state))
                                                                        selected
                                                                    @endif>
                                                                    {{ $state }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('business_state')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label class="custom-label">District:</label>
                                                    <input type="text" class="form-control" name="business_district" value="{{ old('business_district', $get_lead->business_district ?? '') }}">
                                                    @error('business_district')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="custom-label">Tehsil:</label>
                                                    <input type="text" class="form-control" name="business_tehsil" value="{{ old('business_tehsil', $get_lead->business_tehsil ?? '') }}">
                                                    @error('business_tehsil')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="custom-label">Pin Code:</label>
                                                    <input type="text" class="form-control" name="business_pin_code" value="{{ old('business_pin_code', $get_lead->business_pin_code ?? '') }}">
                                                    @error('business_pin_code')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="custom-label">Mobile No:</label>
                                                    <input type="text" class="form-control" name="business_mobile_no" value="{{ old('business_mobile_no', $get_lead->business_mobile_no ?? '') }}">
                                                    @error('business_mobile_no')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Attachments -->
                                            <div class="bordered mb-3">
                                                <h6 class="section-title text-secondary">Attachments</h6>
                                                <div class="row mb-2">
                                                    <div class="col-md-3">
                                                        <label class="custom-label">Aadhar Card Front:</label><br>
                                                        @if (isset($get_lead->aadhar_front_doc))
                                                            <a href="{{ asset($get_lead->aadhar_front_doc) }}">View Aadhar Card</a>
                                                        @endif
                                                        <input type="file" name="aadhar_front_doc" class="form-control mt-2" accept="image/*,application/pdf">
                                                        @error('aadhar_front_doc')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="custom-label">Aadhar Card Back:</label><br>
                                                        @if (isset($get_lead->aadhar_back_doc))
                                                            <a href="{{ asset($get_lead->aadhar_back_doc) }}">View Aadhar Card</a>
                                                        @endif
                                                        <input type="file" name="aadhar_back_doc" class="form-control mt-2" accept="image/*,application/pdf">
                                                        @error('aadhar_back_doc')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="custom-label">Pan Card:</label><br>
                                                        @if (isset($get_lead->pan_card_doc))
                                                            <a href="{{ asset($get_lead->pan_card_doc) }}">View Pan Card</a>
                                                        @endif
                                                        <input type="file" name="pan_card_doc" class="form-control mt-2" accept="image/*,application/pdf">
                                                        @error('pan_card_doc')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="custom-label">Voter ID Card:</label><br>
                                                        @if (isset($get_lead->voter_id_doc))
                                                            <a href="{{ asset($get_lead->voter_id_doc) }}">View Voter ID</a>
                                                        @endif
                                                        <input type="file" name="voter_id_doc" class="form-control mt-2" accept="image/*,application/pdf">
                                                        @error('voter_id_doc')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label class="custom-label">Cibil Score:</label>
                                                        <input type="text" class="form-control mt-2" name="cibil_score" value="{{ old('cibil_score', $get_lead->cibil_score ?? '') }}">
                                                        @error('cibil_score')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="custom-label">Cibil Doc Upload:</label><br>
                                                        @if (isset($get_lead->cibil_doc_upload))
                                                            <a href="{{ asset($get_lead->cibil_doc_upload) }}">View Voter ID</a>
                                                        @endif
                                                        <input type="file" name="cibil_doc_upload" class="form-control mt-2" accept="image/*,application/pdf">
                                                        @error('cibil_doc_upload')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Remark -->
                                            <div class="bordered mb-3">
                                                <h6 class="section-title text-danger">Remark</h6>
                                                <div class="row mb-2">
                                                    <div class="col-md-12">
                                                        <textarea name="remark" id="remark" rows="4" class="form-control" placeholder="Enter your remark here">{{ old('remark', $get_lead->remark ?? '') }}</textarea>
                                                        @error('remark')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
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
            </div>
        @endsection
