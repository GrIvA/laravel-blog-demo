@extends ('manage.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Post's list</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Language list</h3>
        </div>

        <div class="card-body">
          <a href="{{ route('languages.create') }}" class="btn btn-primary mb-3">Add language</a>

          @if (count($langs))
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                        <th style="width: 30px;">#</th>
                        <th>name</th>
                        <th>abr</th>
                        <th>locale</th>
                        <th>available</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($langs as $lang)
                            <tr>
                                <td>{{ $lang->id }}</td>
                                <td>{{ $lang->name }}</td>
                                <td>{{ $lang->abr }}</td>
                                <td>{{ $lang->locale }}</td>
                                <td><input type="checkbox" disabled @if($lang->available) checked @endif ></td>
                                <td>{{ $lang->created_at }}</td>
                                <td>
                                    <a href="{{ route('languages.edit', ['language' => $lang->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('languages.destroy', ['language' => $lang->id]) }}" method="POST" class="float-left">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You sure?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          @else
            <p>No posts...</p>
          @endif
        </div>
        <!-- /.card-body -->

        <!-- .card-footer-->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection
