@extends('admin.layouts.layout')
@section('content')
<style>
.categories-section {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
}


.category-block-header h6 {
    font: 600 18px/24px Open Sans;
    letter-spacing: 0;
    color: #212a3b;
}

.category-block {
    align-self: baseline;
    width: calc((100% - 25px)/2);
    background: #fff 0 0 no-repeat padding-box;
    border: 1px solid #e4e7ec;
    border-radius: 3px;
    opacity: 1;
    margin-top: 25px;
    padding: 24px 32px;
    /* padding: var(--secton-content-indents); */
}

.table th#category-name {
    text-align: right;
    width: 45%;
}

.table th#category-percentage {
    width: 5%;
}

.table th {
    font: 400 14px/24px Open Sans;
    color: #929baa;
}

.table-borderless .table-borderless thead th {
    border: 0;
}

.table th {
    font: 400 14px/24px Open Sans;
    color: #929baa;
}

.table td.category-name {
    font: 400 16px/24px Open Sans;
    color: #212a3b;
    text-align: right;
    padding-left: 0;
}

.table td {
    padding-top: 15px;
    padding-bottom: 0;
}

.table-borderless thead th {
    border: 0;
}



.major-client-item {
    display: flex;
    align-items: baseline;
    background: #f2f6f9;
    border-radius: 24px;
    padding: 8px 25px 8px 12px;
    margin-right: 15px;
    margin-top: 15px;
}

.major-client-icon {
    flex-shrink: 0;
    width: 12px;
    height: 12px;
    background: #a0d52a;
    border-radius: 24px;
    margin-right: 12px;
}

.major-client-text {
    font: 600 16px/24px Open Sans;
    color: #212a3b;
}

div#collapsible-major-clients {
    display: inline-block;
}



.small-box {
    height: 100px !important;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Company Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('case_studies.index') }}" class="btn ipfs-button"><i
                                class="fa fa-arrow-left"></i>
                            Back</a>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center profile-user-div">
                                <a href="{{ $caseStudiesDetail->company->company_logo }}" target="_blank">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ $caseStudiesDetail->company->company_logo }}" alt="company logo">
                                    <input type="hidden" name="user_id" id="id_data"
                                        value="{{ $caseStudiesDetail->id }}">
                                </a>
                            </div>

                            <h3 class="profile-username text-center">
                                {{ !$caseStudiesDetail->company->company_name ? 'Company' :$caseStudiesDetail->company->company_name }}
                            </h3>
                            <p class="text-muted text-center">{{ $caseStudiesDetail->company->company_email }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Project name</b> <a
                                        class="float-right text-dark">{{$caseStudiesDetail->project_name}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Project Link</b> <a href="{{$caseStudiesDetail->project_link}}"
                                        class="float-right text-dark" target="_blank">Click</a>
                                </li>

                                <li class="list-group-item">
                                    <b>Team</b> <a class="float-right text-dark">{{$caseStudiesDetail->team}}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>Cost</b> <a class="float-right text-dark">{{$caseStudiesDetail->cost}}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>Timeline</b> <a
                                        class="float-right text-dark">{{$caseStudiesDetail->timeline}}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>Added Date</b> <a
                                        class="float-right text-dark">{{ date('Y-m-d', strtotime($caseStudiesDetail->created_at)) }}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right text-dark">
                                        @if($caseStudiesDetail->project_status == 'ongoing')
                                        <span class="btn btn-sm ipfs-warning">Ongoing</span>
                                        @else
                                        <span class="btn btn-sm ipfs-success">Completed</span>
                                        @endif
                                    </a>
                                </li>


                            </ul>

                        </div>

                    </div>



                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#companyDetails"
                                        data-toggle="tab">Project Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">Images</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#serviceLine" data-toggle="tab">Service
                                        line</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#domains" data-toggle="tab">Domains</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#framework"
                                        data-toggle="tab">Framework</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#programmingLanguage"
                                        data-toggle="tab">Programming Language</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#cmsSolution" data-toggle="tab">CMS
                                        Solution</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="companyDetails">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Challenge</label>
                                                <textarea class="form-control" rows="5" id="description"
                                                    name="description"
                                                    disabled>{{$caseStudiesDetail->challenge}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Solution</label>
                                                <textarea class="form-control" rows="5" id="description"
                                                    name="description"
                                                    disabled>{{$caseStudiesDetail->solution}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Results</label>
                                                <textarea class="form-control" rows="5" id="description"
                                                    name="description"
                                                    disabled>{{$caseStudiesDetail->results}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="images">
                                    <div class="row">
                                        <div>
                                            <!-- <h2 class="section-header__title">Major clients</h2> -->
                                            @if($caseStudiesDetail->caseStudyImage->count() > 0)
                                            @foreach ($caseStudiesDetail->caseStudyImage as $caseImage)
                                            <div class="major-clients-body collapse show" id="collapsible-major-clients"
                                                style="">
                                                <div class="major-client-item">
                                                    <!-- <div class="major-client-icon"></div> -->
                                                    <div class="major-client-text text-break">
                                                        
                                                        <a href="{{ $caseImage->image }}" target="_blank">
                                                            <img src="{{ $caseImage->image }}" width="150" height="150">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row">
                                                <div class="col-12" align="center">
                                                    <p style="font-size: larger;margin-bottom: 2px;">No Major clients
                                                        Added </p>
                                                </div>
                                            </div>
                                            @endif

                                        </div>

                                    </div>

                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="serviceLine">

                                    <div class="row">
                                        <div>
                                            <!-- <h2 class="section-header__title">Major clients</h2> -->
                                            @if($caseStudiesDetail->caseStudyCategory->count() > 0)
                                            @foreach ($caseStudiesDetail->caseStudyCategory as $caseServiceline)
                                            <div class="major-clients-body collapse show" id="collapsible-major-clients"
                                                style="">
                                                <div class="major-client-item">
                                                    <div class="major-client-icon"></div>
                                                    <div class="major-client-text text-break">
                                                        {{ (!empty($caseServiceline->category->name))?$caseServiceline->category->name:'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row">
                                                <div class="col-12" align="center">
                                                    <p style="font-size: larger;margin-bottom: 2px;">No Major clients
                                                        Added </p>
                                                </div>
                                            </div>
                                            @endif

                                        </div>



                                    </div>

                                </div>

                                <div class="tab-pane" id="domains">

                                    <div class="row">
                                        <div>
                                            <!-- <h2 class="section-header__title">Major clients</h2> -->
                                            @if($caseStudiesDetail->caseStudyDomai->count() > 0)
                                            @foreach ($caseStudiesDetail->caseStudyDomai as $caseDomain)
                                            <div class="major-clients-body collapse show" id="collapsible-major-clients"
                                                style="">
                                                <div class="major-client-item">
                                                    <div class="major-client-icon"></div>
                                                    <div class="major-client-text text-break">
                                                        {{ (!empty($caseDomain->domain->name))?$caseDomain->domain->name:'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row">
                                                <div class="col-12" align="center">
                                                    <p style="font-size: larger;margin-bottom: 2px;">No Major clients
                                                        Added </p>
                                                </div>
                                            </div>
                                            @endif

                                        </div>


                                    </div>

                                </div>

                                <div class="tab-pane" id="framework">

                                    <div class="row">
                                        <div>
                                            <!-- <h2 class="section-header__title">Major clients</h2> -->
                                            @if($caseStudiesDetail->caseStudyFramework->count() > 0)
                                            @foreach ($caseStudiesDetail->caseStudyFramework as $caseframework)
                                            <div class="major-clients-body collapse show" id="collapsible-major-clients"
                                                style="">
                                                <div class="major-client-item">
                                                    <div class="major-client-icon"></div>
                                                    <div class="major-client-text text-break">
                                                        {{ (!empty($caseframework->framework->name))?$caseframework->framework->name:'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row">
                                                <div class="col-12" align="center">
                                                    <p style="font-size: larger;margin-bottom: 2px;">No Framework
                                                        Added </p>
                                                </div>
                                            </div>
                                            @endif

                                        </div>



                                    </div>

                                </div>


                                <div class="tab-pane" id="programmingLanguage">

                                    <div class="row">
                                        <div>
                                            <!-- <h2 class="section-header__title">Major clients</h2> -->
                                            @if($caseStudiesDetail->caseStudyLanguage->count() > 0)
                                            @foreach ($caseStudiesDetail->caseStudyLanguage as $caseLanguage)
                                            <div class="major-clients-body collapse show" id="collapsible-major-clients"
                                                style="">
                                                <div class="major-client-item">
                                                    <div class="major-client-icon"></div>
                                                    <div class="major-client-text text-break">
                                                        {{ (!empty($caseLanguage->language->name))?$caseLanguage->language->name:'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row">
                                                <div class="col-12" align="center">
                                                    <p style="font-size: larger;margin-bottom: 2px;">No Programming
                                                        Language
                                                        Added </p>
                                                </div>
                                            </div>
                                            @endif

                                        </div>



                                    </div>

                                </div>

                                <div class="tab-pane" id="cmsSolution">

                                    <div class="row">
                                        <div>
                                            <!-- <h2 class="section-header__title">Major clients</h2> -->
                                            @if($caseStudiesDetail->caseStudyCMSSolution->count() > 0)
                                            @foreach ($caseStudiesDetail->caseStudyCMSSolution as $caseCmsSolution)
                                            <div class="major-clients-body collapse show" id="collapsible-major-clients"
                                                style="">
                                                <div class="major-client-item">
                                                    <div class="major-client-icon"></div>
                                                    <div class="major-client-text text-break">
                                                        {{ (!empty($caseCmsSolution->cMSSolutions->name))?$caseCmsSolution->cMSSolutions->name:'N/A' }}
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row">
                                                <div class="col-12" align="center">
                                                    <p style="font-size: larger;margin-bottom: 2px;">No CMS Solution
                                                        Added </p>
                                                </div>
                                            </div>
                                            @endif

                                        </div>



                                    </div>

                                </div>

                            </div>



                        </div>

                        <!-- /.card -->
                    </div>

                    <!-- /.col -->
                </div>
                <!-- /.row -->
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