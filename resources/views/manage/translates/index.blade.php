@extends ('manage.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Site translate manager</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">File list</h3>
        </div>

        <div class="card-body">
          <a href="{{ route('translates.create') }}" class="btn btn-primary mb-3">Add variable</a>

          @if (count($data))
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                        <th style="width: 30px;">#</th>
                        <th>Group</th>
                        <th>Key</th>
                        <th>Translate</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($data as $it)
                            <tr>
                                <td>{{ $it->id }}</td>
                                <td>{{ $it->group }}</td>
                                <td>{{ $it->key }}</td>
                                <td><pre style="max-width:70vw;">{{ json_encode($it->text) }}</pre></td>
                                <td>
                                    <a href="{{ route('translates.edit', ['translate' => $it->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('translates.destroy', ['translate' => $it->id]) }}" method="POST" class="float-left">
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
            <p>No language variables...</p>
          @endif
        </div>
        <!-- /.card-body -->

        <!-- .card-footer-->
        <div class="clearfix card-footer">
            {{ $data->links() }}
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection
