@extends('layouts.master')

@section('title')
    Session Timed Out | Pricon Microelectronics, Inc.
@endsection

@section('content')

    @include('includes.header')

    <div class="clearfix">
    </div>

    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        @include('includes.sidebar')

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                
                <!-- BEGIN PAGE CONTENT-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box grey-gallery">
                            <div class="portlet-title">
                                <div class="caption">
                                    SESSION TIMED OUT
                                </div>
                            </div>
                            <div class="portlet-body blue" style="font-size: 12px">
                                <p style="color:#fff;">
                                    Your Session has timed out. Please Login again.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT -->

    </div>
    <!-- END CONTAINER -->
@endsection