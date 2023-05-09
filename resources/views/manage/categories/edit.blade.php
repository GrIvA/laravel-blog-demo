@extends ('manage.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit category</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Catefory "{{ $category->title }}"</h3>
                </div>

                <form role="form" method="post" action="{{ route('categories.update', ['category' => $category->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input value="{{ $category->title }}" type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title" />
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    </section>
    <!-- /.content -->

@endsection

