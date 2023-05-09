@extends ('manage.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category list</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Categories</h3>
        </div>

        <div class="card-body">
          <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add category</a>

          @if (count($categories))
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                        <th style="width: 30px;">#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST" class="float-left">
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
            <p>No categories...</p>
          @endif
        </div>
        <!-- /.card-body -->

        <div class="clearfix card-footer">
            {{ $categories->links() }}
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection
