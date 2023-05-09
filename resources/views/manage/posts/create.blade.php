@extends ('manage.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create post</h1>
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
                    <h3 class="card-title">Create post</h3>
                </div>

                <form role="form" method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <!-- Header -->
                        <div class="form-group">
                            <label for="header">Header</label>
                            <input type="text" name="header" class="form-control @error('header') is-invalid @enderror" id="header" placeholder="Header" />
                        </div>

<!-- Description -->
<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="description" class="form-control" rows="5" placeholder="Enter description"></textarea>
</div>

<!-- Epilog -->
<div class="form-group">
    <label for="epilog">Epilog</label>
    <textarea id="epilog" name="epilog" class="form-control" rows="5" placeholder="Put post epilog"></textarea>
</div>

<!-- Content -->
<div class="form-group">
    <label for="content">Content</label>
    <textarea id="content" name="content" class="form-control" rows="15" placeholder="Past post content"></textarea>
</div>

<!-- Category -->
<div class="form-group">
    <label for="category_id">Category</label>
    <select id="category_id" name="category_id" class="form-control">
        <option>Select category</option>
        @foreach($categories as $id => $title)
            <option value="{{ $id }}">{{ $title }}</option>
        @endforeach
    </select>
</div>

<!-- Tags -->
<div class="form-group">
    <label for="tags">Tags</label>
    <select id="tags" name="tags[]" multiple="multiple" class="select2" data-placeholder="Select a Tag" style="width: 100%;">
        @foreach($tags as $id => $t)
            <option value="{{ $id }}">{{ $t }}</option>
        @endforeach
    </select>
</div>

<!-- Thumbnails -->
<div class="form-group">
    <label for="thumbnails">Thumbnails</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" id="thumbnails" name="thumbnails" class="custom-file-input" />
            <label class="custom-file-label" for="thumbnails">Choose file</label>
        </div>
        <!--
        <div class="input-group-append">
            <span class="input-group-text" id="">Upload</span>
        </div>
        -->
    </div>
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

