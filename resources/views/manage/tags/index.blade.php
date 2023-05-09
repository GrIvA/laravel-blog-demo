@extends ('manage.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tag's list</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tags</h3>
        </div>

        <div class="card-body">
          <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Add tag</a>

          @if (count($tags))
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                        <th style="width: 30px;">#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->title }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td>
                                    <a href="{{ route('tags.edit', ['tag' => $tag->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('tags.destroy', ['tag' => $tag->id]) }}" method="POST" class="float-left">
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
            <p>No tags...</p>
          @endif
        </div>
        <!-- /.card-body -->

        <div class="clearfix card-footer">
            {{ $tags->links() }}
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection
