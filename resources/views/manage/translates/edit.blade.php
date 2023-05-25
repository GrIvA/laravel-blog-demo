@extends ('manage.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit translatiion for "{{ $translate->key }}"</h1>
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
                            <!--<h3 class="card-title">Group "{{ $translate->group }}"</h3>-->
                        </div>

                        <form role="form" method="post" action="{{ route('translates.update', ['translate' => $translate->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <!-- Group -->
                                <div class="form-group">
                                    <label for="group">Group</label>
                                    <input type="text" name="group" value="{{ $translate->group }}" class="form-control @error('group') is-invalid @enderror" id="group" placeholder="Put the group name" />
                                </div>

                                <!-- Key -->
                                <div class="form-group">
                                    <label for="key">Key</label>
                                    <input type="text" name="key" value="{{ $translate->key }}" class="form-control @error('key') is-invalid @enderror" id="key" placeholder="Put the key name" />
                                </div>

                                <!-- Loop for all languages -->
                                @foreach($languages as $abr => $active)
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" @if($active) checked @endif />
                                            <label class="custom-control-label" for="text[{{$abr}}]">{{ $abr }}</label>
                                        </div>
                                        <textarea id="text[{{ $abr }}]" name="text[{{ $abr }}]" class="form-control @error('text[{{ $abr }}]') is-invalid @enderror" rows="3" placeholder="Put translate here">{{ $translate->text[$abr] ?? '' }}</textarea>
                                    </div>
                                @endforeach

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


