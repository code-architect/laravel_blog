@extends('backend.layout.main')

@section('title')
    Admin Blog | {{ ucfirst($status) }} index
@endsection


@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Blog
                <small>Display All {{$status}} blog posts</small>
            </h1>

            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Dashboard </a>
                </li>
                <li>
                    <a href="{{ route('article.index') }}"><i class="fa fa-list"></i> Blog </a>
                </li>
                <li class="active">
                    All Posts
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a id="add-button" title="Add New" class="btn btn-success" href="{{ route('article.create') }}"><i class="fa fa-plus-circle"></i> Add New</a>
                            </div>
                            <div class="pull-right">
                                <form accept-charset="utf-8" method="post" class="form-inline" id="form-filter" action="#">
                                    <div class="input-group">
                                        <input type="hidden" name="search">
                                        <input type="text" name="keywords" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search..." value="">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-default search-btn" type="button"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">

                            {{--session message--}}
                            @include('backend._partials.message')

                            @if(empty($posts))
                                <div class="alert alert-warning">
                                    <strong>No record found.</strong>
                                </div>
                            @else
                                @if($onlyTrashed)
                                    @include('backend.blog.include.table-trash')
                                @else
                                    @include('backend.blog.include.table')
                                @endif
                        </div>
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-left">
                                {{ $posts->appends( Request::query() )->render() }}
                            </ul>
                        </div>
                        @endif
                        <div class="pull-right">

                        </div>
                    </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>

@endsection
