@extends('layouts/app')
@section('content')
    <style>
        strong {
            font-weight: bold;
        }

        .lead-status-badge {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 12px;
        }

        .info_div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .first_div {
            flex: 0 0 40%;
            text-align: left;
        }

        .second_div {
            flex: 0 0 55%;
            text-align: left;
        }

        .container-fluid {
            padding: 0 2rem;
        }

        .page-header {
            margin-bottom: 1rem;
        }

        .breadcrumb-item {
            font-size: 0.9rem;
        }

        .card {
            margin-bottom: 2rem;
        }

        .card-header {
            padding: 1rem 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        @media (max-width: 768px) {
            .info_div {
                flex-direction: column;
                text-align: left;
            }

            .second_div {
                text-align: left;
                margin-top: 0.5rem;
            }
        }
    </style>
    @if (isset($get_lead))
        @php $form_action = "lead.update"; @endphp
    @else
        @php $form_action = "lead.create"; @endphp
    @endif
    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
    <input type="hidden" id="lead_id" value="{{ isset($get_lead) ? @$get_lead->id : ' ' }}">
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
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Lead Information</h4>
                        </div>
                        @switch(@$get_lead->loan_status)
                            @case(1)
                                @php $loan_status = "Pending"; @endphp
                            @break

                            @case(2)
                                @php $loan_status = "View"; @endphp
                            @break

                            @case(3)
                                @php $loan_status = "Under Processing"; @endphp
                            @break

                            @case(4)
                                @php $loan_status = "Move to Lender"; @endphp
                            @break

                            @case(5)
                                @php $loan_status = "Sanction"; @endphp
                            @break

                            @case(6)
                                @php $loan_status = "Disbursed"; @endphp
                            @break

                            @case(7)
                                @php $loan_status = "Rejected"; @endphp
                            @break

                            @default
                                @php $loan_status = "Unknown"; @endphp
                        @endswitch
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <h4>Customer Information</h4>
                                                <td><strong>Full Name:</strong></td>
                                                <td>{{ ucwords(@$get_lead->full_name ?? 'N/A') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Father Name:</strong></td>
                                                <td>{{ @$get_lead->father_name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Date Of Birth:</strong></td>
                                                <td>{{ \Carbon\Carbon::parse(@$get_lead->date_of_birth)->format('d F Y h:i A') ?? 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Residence Address:</strong></td>
                                                <td>{{ @$get_lead->residence_address ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>State Name:</strong></td>
                                                <td>{{ @$get_lead->state_name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Destrict Name:</strong></td>
                                                <td>{{ @$get_lead->district_name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tehsil/Taluka:</strong></td>
                                                <td>{{ @$get_lead->tehsil_taluka ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Loan Amount:</strong></td>
                                                <td>{{ @$get_lead->loan_amount ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pincode:</strong></td>
                                                <td>{{ @$get_lead->pin_code ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Lead Status:</strong></td>
                                                <td id="fetch_loan_status">
                                                    {{ isset($loan_status) ? str_replace('_', ' ', $loan_status) : 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Service:</strong></td>
                                                <td id="fetch_loan_status">
                                                    {{ isset($get_lead->service) ? str_replace('_', ' ', @$get_lead->service) : 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>File No.:</strong></td>
                                                <td>{{ @$get_lead->id ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Created By:</strong></td>
                                                <td>{{ isset($get_lead->username) ? ucwords(@$get_lead->username) : 'N/A' }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <h4>Occupation Details</h4>
                                                <td><strong>Income:</strong></td>
                                                <td>{{ ucwords(@$get_lead->income ?? 'N/A') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Income Proof Name:</strong></td>
                                                <td>{{ @$get_lead->income_proof_name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Residence Location:</strong></td>
                                                <td>Lat : {{ @$get_lead->res_lat ?? 'N/A' }} <br> Long :
                                                    {{ @$get_lead->res_long ?? 'N/A' }} </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Business/Office Location:</strong></td>
                                                <td>Lat : {{ @$get_lead->business_lat ?? 'N/A' }} <br> Long :
                                                    {{ @$get_lead->business_long ?? 'N/A' }} </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Business Address:</strong></td>
                                                <td>{{ @$get_lead->business_address ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>State:</strong></td>
                                                <td>{{ @$get_lead->business_state ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>District :</strong></td>
                                                <td>{{ @$get_lead->business_district ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tehsil:</strong></td>
                                                <td>{{ @$get_lead->business_tehsil ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pin code:</strong></td>
                                                <td>{{ @$get_lead->business_pin_code ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Mobile:</strong></td>
                                                <td>{{ @$get_lead->business_mobile_no ?? 'N/A' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <h4>Attachments</h4>
                                                <td><strong>Aadhar Front Side:</strong></td>
                                                @if (@$get_lead->aadhar_front_docs)
                                                    <td><a href="{{ asset('storage') }}/{{ @$get_lead->aadhar_front_docs }}"
                                                            target="_blank">View Aadhar Front Side</a></td>
                                                @else
                                                    <td><a href="#">N/A</a></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td><strong>Aadhar Back Side:</strong></td>
                                                @if (@$get_lead->aadhar_back_docs)
                                                    <td><a href="{{ asset('storage') }}/{{ @$get_lead->aadhar_back_docs }}"
                                                            target="_blank">View Aadhar Back Side</a></td>
                                                @else
                                                    <td><a href="#">N/A</a></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td><strong>Pan Card:</strong></td>
                                                @if (@$get_lead->pan_card_docs)
                                                    <td><a href="{{ asset('storage') }}/{{ @$get_lead->pan_card_docs }}"
                                                            target="_blank">View Pan Card</a></td>
                                                @else
                                                    <td><a href="#">N/A</a></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td><strong>Voter ID Card:</strong></td>
                                                @if (@$get_lead->voter_card_docs)
                                                    <td><a href="{{ asset('storage') }}/{{ @$get_lead->voter_card_docs }}"
                                                            target="_blank">View Voter ID Card</a></td>
                                                @else
                                                    <td><a href="#">N/A</a></td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><strong>Cibil Score:</strong></td>
                                                <td>{{ @$get_lead->cibil_score ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <h4>Cibil Info</h4>
                                                <td><strong>Cibil Doc:</strong></td>
                                                @if (@$get_lead->cibil_doc_upload)
                                                    <td><a href="{{ asset('storage') }}/{{ @$get_lead->cibil_doc_upload }}"
                                                            target="_blank">View Cibil Doc</a></td>
                                                @else
                                                    <td><a href="#">N/A</a></td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h4 class="mb-0">Activity Log</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group" id="note_html">
                                <!-- Notes will be appended here dynamically -->
                            </ul>
                            @if(Auth::user()->role_id == 7 )

                                @if($get_lead->created_user_id != Auth::user()->id)

                                    @if (@$get_lead->loan_status == 2 && Auth::user()->role_id != 6)
                                        <button class="btn btn-outline-primary mt-5"
                                            onclick="startDisscussion({{ isset($get_lead->id) ? @$get_lead->id : ' ' }}, {{ Auth::user()->id }}, '');">Proceed</button>
                                    @endif

                                @endif

                            @endif

                            @if(Auth::user()->role_id == 1  || Auth::user()->role_id == 5  || Auth::user()->role_id == 6 )
                                @if (@$get_lead->loan_status == 2 && Auth::user()->role_id != 6)
                                    <button class="btn btn-outline-primary mt-5"
                                        onclick="startDisscussion({{ isset($get_lead->id) ? @$get_lead->id : ' ' }}, {{ Auth::user()->id }}, '');">Proceed</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                @if(Auth::user()->role_id == 7)
                @if($get_lead->created_user_id != Auth::user()->id)
                @if (
                    (Auth::user()->role_id == 1 || $get_assign_id->assign_user_id == Auth::user()->id) &&
                        @$get_lead->loan_status >= 3 &&
                        Auth::user()->role_id != 6)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4 class="mb-0">Notes </h4>
                            </div>
                            <div class="card-body">
                                <form action="#" method="POST">
                                    @csrf
                                    <!-- Textarea Field -->
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">Notes</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter your notes here"></textarea>
                                        <input type="hidden" id="hidden_id">
                                    </div>
                                    <!-- Select Field -->
                                    <div class="mb-3">
                                        <label for="option" class="form-label">Select Status</label>
                                        <select class="form-select" id="status" name="option" onchange="LeadApprove();">
                                            <option selected value="">Select an option</option>
                                            <option value="3" {{ @$get_lead->loan_status == 3 ? 'selected' : '' }}>
                                                Under Processing</option>
                                            <option value="4" {{ @$get_lead->loan_status == 4 ? 'selected' : '' }}>
                                                Move to Lender</option>
                                            <option value="5" {{ @$get_lead->loan_status == 5 ? 'selected' : '' }}>
                                                Sanction</option>
                                            <option value="6" {{ @$get_lead->loan_status == 6 ? 'selected' : '' }}>
                                                Disbursed</option>
                                            <option value="7" {{ @$get_lead->loan_status == 7 ? 'selected' : '' }}>
                                                Rejected</option>
                                        </select>
                                    </div>
                                    <!-- File Upload Field -->
                                    <div class="mb-3 remove_class d-none">
                                        <label for="file_upload" class="form-label">File Upload</label>
                                        <input class="form-control @error('file_upload') is-invalid @enderror"
                                            type="file" name="file_upload" id="file_upload">
                                        @error('file_upload')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Loan Amount Input Field -->
                                    <div class="mb-3 remove_class d-none">
                                        <label for="loan_amount" class="form-label">Loan Amount</label>
                                        <input type="number"
                                            class="form-control @error('loan_amount') is-invalid @enderror"
                                            id="loan_amount" name="loan_amount"
                                            value="{{ old('loan_amount', @$get_lead->loan_amount) }}"
                                            placeholder="Enter loan amount">
                                        @error('loan_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="mb-3"
                                            @if (Auth::user()->role_id == 7) style="pointer-events: none;" @endif>
                                            <label class="form-label">Provider </label>
                                            <select
                                                class="form-control custom-select-icon @error('provider_id') is-invalid @enderror"
                                                name="provider_id" id="provider_id">
                                                <option value="">Select Provider</option>
                                                @if ($get_providers)
                                                    @foreach ($get_providers as $provider)
                                                        <option value="{{ $provider->id }}"
                                                            @if (Auth::user()->provider_id == $provider->id) selected @endif>
                                                            {{ ucwords($provider->title) }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <!-- Submit Button -->
                                        <span type="submit" class="btn btn-primary"
                                            onclick="return SaveNotes();">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                @endif
                @endif

                @if(Auth::user()->role_id == 1  || Auth::user()->role_id == 5  || Auth::user()->role_id == 6 )

                @if (
                    (Auth::user()->role_id == 1 || $get_assign_id->assign_user_id == Auth::user()->id) &&
                        @$get_lead->loan_status >= 3 &&
                        Auth::user()->role_id != 6)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4 class="mb-0">Notes </h4>
                            </div>
                            <div class="card-body">
                                <form action="#" method="POST">
                                    @csrf
                                    <!-- Textarea Field -->
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">Notes</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter your notes here"></textarea>
                                        <input type="hidden" id="hidden_id">
                                    </div>
                                    <!-- Select Field -->
                                    <div class="mb-3">
                                        <label for="option" class="form-label">Select Status</label>
                                        <select class="form-select" id="status" name="option" onchange="LeadApprove();">
                                            <option selected value="">Select an option</option>
                                            <option value="3" {{ @$get_lead->loan_status == 3 ? 'selected' : '' }}>
                                                Under Processing</option>
                                            <option value="4" {{ @$get_lead->loan_status == 4 ? 'selected' : '' }}>
                                                Move to Lender</option>
                                            <option value="5" {{ @$get_lead->loan_status == 5 ? 'selected' : '' }}>
                                                Sanction</option>
                                            <option value="6" {{ @$get_lead->loan_status == 6 ? 'selected' : '' }}>
                                                Disbursed</option>
                                            <option value="7" {{ @$get_lead->loan_status == 7 ? 'selected' : '' }}>
                                                Rejected</option>
                                        </select>
                                    </div>
                                    <!-- File Upload Field -->
                                    <div class="mb-3 remove_class d-none">
                                        <label for="file_upload" class="form-label">File Upload</label>
                                        <input class="form-control @error('file_upload') is-invalid @enderror"
                                            type="file" name="file_upload" id="file_upload">
                                        @error('file_upload')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Loan Amount Input Field -->
                                    <div class="mb-3 remove_class d-none">
                                        <label for="loan_amount" class="form-label">Loan Amount</label>
                                        <input type="number"
                                            class="form-control @error('loan_amount') is-invalid @enderror"
                                            id="loan_amount" name="loan_amount"
                                            value="{{ old('loan_amount', @$get_lead->loan_amount) }}"
                                            placeholder="Enter loan amount">
                                        @error('loan_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="mb-3"
                                            @if (Auth::user()->role_id == 7) style="pointer-events: none;" @endif>
                                            <label class="form-label">Provider </label>
                                            <select
                                                class="form-control custom-select-icon @error('provider_id') is-invalid @enderror"
                                                name="provider_id" id="provider_id">
                                                <option value="">Select Provider</option>
                                                @if ($get_providers)
                                                    @foreach ($get_providers as $provider)
                                                        <option value="{{ $provider->id }}"
                                                            @if (Auth::user()->provider_id == $provider->id) selected @endif>
                                                            {{ ucwords($provider->title) }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <!-- Submit Button -->
                                        <span type="submit" class="btn btn-primary"
                                            onclick="return SaveNotes();">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                @endif
            </div>
        </div>
    </div>
@endsection
