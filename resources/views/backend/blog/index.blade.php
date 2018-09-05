@extends('backend.layout.main')

@section('title', 'Admin Blog | Blog index')


@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Blog
                <small>Display All blog posts</small>
            </h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-list"></i> Blog </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a id="add-button" title="Add New" class="btn btn-success" href="form.html"><i class="fa fa-plus-circle"></i> Add New</a>
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
                            <table class="table table-bordered table-condesed">
                                <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($posts as $post)
                                    <tr>
                                        <td width="70">
                                            <a title="Edit" class="btn btn-xs btn-default edit-row" href="{{ route('blog.edit',  $post->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a title="Delete" class="btn btn-xs btn-danger delete-row" href="{{ route('blog.destroy', $post->id) }}">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->author->name }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        {{--<td><abbr title="2016/12/04 6:32:00 PM">2016/12/04</abbr> | <span class="label label-info">Schedule</span></td>--}}
                                        {{--<td><abbr title="2016/12/04 6:32:00 PM">2016/12/04</abbr> | <span class="label label-warning">Draft</span></td>--}}
                                        <td><abbr title="{{ $post->dateFormatted(true) }}">{{ $post->dateFormatted() }}</abbr> |
                                            <span class="label label-success">Published</span></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-left">
                                <li><a href="#">«</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">»</a></li>
                            </ul>
                        </div>
                        <div class="pull-right">
                            <small>4 items</small>
                        </div>
                    </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>

@endsection
