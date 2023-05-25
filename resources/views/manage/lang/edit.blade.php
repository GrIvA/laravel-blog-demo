@extends ('manage.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit language parameters</h1>
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
                    <h3 class="card-title">{{ $language->locale }}</h3>
                </div>

                <form role="form" method="post" action="{{ route('languages.update', ['language' => $language->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <!-- name -->
                        <div class="form-group">
                            <label for="header">Name</label>
                            <input type="text" name="name" value="{{ $language->name }}" class="form-control @error('name') is-invalid @enderror" id="name" />
                        </div>

                        <!-- Abbreviation -->
                        <div class="form-group">
                            <label for="description">Abbreviation</label>
                            <input id="abr" name="abr" class="form-control @error('abr') is-invalid @enderror" value="{{ $language->abr }}" /input>
                        </div>

                        <!-- Locale -->
                        <div class="form-group">
                            <label for="description">Locale name</label>
                            <input id="locale" name="locale" class="form-control @error('locale') is-invalid @enderror" value="{{ $language->locale }}" /input>
                        </div>

                        <!-- Available -->
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="available" name="available" if($language->available) checked @endif>
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

