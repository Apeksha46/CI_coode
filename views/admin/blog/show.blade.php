@extends('admin.layouts.layout')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blog Detail</h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('blogs.index') }}" class="btn ipfs-button"><i class="fa fa-arrow-left"></i>
                                Back</a>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card table-responsive">
                            <div class="card-body">
                                <div class="container ct-u-paddingTop40 ct-u-paddingBottom100">
                                    <div class="row">
                                        <div class="col-md-12 ct-content">
                                            <div class="dynamicDiv" id="dd.0.1.1">

                                                <div class="blog-wrapper">
                                                    <div class="row">
                                                        <h5>{{ ucfirst($blog->type) }}</h5>
                                                    </div>
                                                    <div class="row">Posted on  {{date('M d, Y', strtotime($blog->created_at))}}</div>
                                                    <h2>
                                                        {{ $blog->title }}
                                                    </h2>
                                                    <div class="row col-12">
                                                        <div class="col-6">
                                                            <div>
                                                                {{ $blog->description }}
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                           
                                                            <a href="{{ $blog->getImageAttribute() }}" target="_blank">
                                                                 <img alt="blog-2.jpg"
                                                                class="img-responsive pull-right blog-inner" width="100%"
                                                                height="auto"
                                                                src="{{ $blog->getImageAttribute() }}">
                                                                

                                                            </a>
                                                        </div>
                                                    </div>




                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>
    </div>



@stop
