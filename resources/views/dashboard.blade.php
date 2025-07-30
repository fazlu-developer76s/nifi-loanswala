@extends('layouts/app')
@section('content')
@php
$service_count = \App\Helpers\Global_helper::ServiceCount();
$provider_count = \App\Helpers\Global_helper::ProviderCount();
$processing_lead = \App\Helpers\Global_helper::CountLeads(3);
$saction_lead = \App\Helpers\Global_helper::CountLeads(5);
$qualified_lead = \App\Helpers\Global_helper::CountLeads(6);
$rejected_lead = \App\Helpers\Global_helper::CountLeads(7);
$total_lead = \App\Helpers\Global_helper::CountLeads();
@endphp
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile"
        class="stretched-link"></a></div>
<div id="content" class="app-content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ol class="breadcrumb float-xl-end">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item active">Welcome To Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
    <!--1-pending, 2-viewed, 3-Under Process, 4-Move to Lender, 5-Sanction, 6-Disbursed, 7-rejected	-->
    <div class="row">
        <div class="col-lg-3">
            <a href="#">
                <div class="card">
                    <div class="card-body no-padding" style="height:208px">
                        <div class="alert alert-callout alert-info no-margin">
                            <strong class="text-xl" style="font-size: 50px;">{{ $total_lead }}
                                <?php //$reqdata['COUNT(id)'];
                                ?></strong><br>
                            <span class="opacity-90">Total Leads</span>
                            <!-- <h1 class="pull-right text-info" style="margin-top: -20px;"><img src="assets/img/icon.png" width="100px"></h1> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-4">
                    <a href="#">
                        <div class="card">
                            <div class="card-body no-padding">
                                <div class="alert alert-callout alert-danger no-margin">
                                    <!-- <h1 class="pull-right text-danger"><img src="assets/img/icon.png" width="50px;"></h1> -->
                                    <strong class="text-xl">{{ $saction_lead }}</strong><br />
                                    <span class="opacity-50">Sanction Leads</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="#">
                        <div class="card">
                            <div class="card-body no-padding">
                                <div class="alert alert-callout alert-warning no-margin">
                                    <!-- <h1 class="pull-right text-warning"><img src="assets/img/icon.png" width="50px;"></h1> -->
                                    <strong class="text-xl">{{ $qualified_lead }}</strong><br />
                                    <span class="opacity-50">Disbursed Leads</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @if(Auth::user()->role_id == 1)
                <div class="col-lg-4">
                    <a href="#">
                        <div class="card">
                            <div class="card-body no-padding">
                                <div class="alert alert-callout alert-success no-margin">
                                    <!-- <h1 class="pull-right text-success"><img src="assets/img/icon.png" width="50px;"></h1> -->
                                    <strong class="text-xl">{{ $service_count }}</strong><br />
                                    <span class="opacity-50">Total Services</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                <div class="col-lg-4">
                    <a href="#">
                        <div class="card">
                            <div class="card-body no-padding">
                                <div class="alert alert-callout alert-danger no-margin">
                                    <!-- <h1 class="pull-right text-danger"><img src="assets/img/icon.png" width="50px;"></h1> -->
                                    <strong class="text-xl">{{ $processing_lead }}</strong><br />
                                    <span class="opacity-50">Processing Leads</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4">
                    <a href="#">
                        <div class="card">
                            <div class="card-body no-padding">
                                <div class="alert alert-callout alert-warning no-margin">
                                    <!-- <h1 class="pull-right text-warning"><img src="assets/img/icon.png" width="50px;"></h1> -->
                                    <strong class="text-xl">{{ $rejected_lead }}</strong><br />
                                    <span class="opacity-50">Rejected Leads</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @if(Auth::user()->role_id == 1)
                <div class="col-lg-4">
                    <a href="#">
                        <div class="card">
                            <div class="card-body no-padding">
                                <div class="alert alert-callout alert-success no-margin">
                                    <!-- <h1 class="pull-right text-success"><img src="assets/img/icon.png" width="50px;"></h1> -->
                                    <strong class="text-xl">{{ $provider_count }}</strong><br />
                                    <span class="opacity-50">Toal Providers</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top"
    data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
</div>
@endsection
