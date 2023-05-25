@extends ('manage.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create new language record</h1>
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
                <form role="form" method="post" action="{{ route('languages.store') }}">
                    @csrf
                    <div class="card-body">
                        <!-- name -->
                        <div class="form-group">
                            <label for="header">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" />
                        </div>

                        <!-- Abbreviation -->
                        <div class="form-group">
                            <label for="description">Abbreviation</label>
                            <input id="abr" name="abr" class="form-control @error('abr') is-invalid @enderror" value="{{ old('abr') }}" placeholder="Abbreviation" /input>
                        </div>

                        <!-- Locale -->
                        <div class="form-group">
                            <label for="description">Locale name</label>
                            <input id="locale" name="locale" class="form-control @error('locale') is-invalid @enderror" value="{{ old('locale') }}" placeholder="Locale" /input>
                        </div>

                        <!-- Available -->
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="available" name="available" @checked(old('available'))>
                                <label class="custom-control-label" for="available">Language is present on the site</label>
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

