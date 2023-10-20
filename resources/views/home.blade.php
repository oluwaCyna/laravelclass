@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h1 id="name"></h1>
                        <h1 id="email_address"></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ajax') }}</div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="id"
                                class="col-md-4 col-form-label text-md-end">{{ __('User ID') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text"
                                    class="form-control @error('id') is-invalid @enderror" name="id"
                                    value="{{ old('id') }}" required autocomplete="id" autofocus>

                                @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            <label for="new_name"
                                class="col-md-4 col-form-label text-md-end">{{ __('New Name') }}</label>

                            <div class="col-md-6">
                                <input id="new_name" type="text"
                                    class="form-control @error('new_name') is-invalid @enderror" name="new_name"
                                    value="{{ old('new_name') }}" required autocomplete="new_name" autofocus>

                                @error('new_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button id="button" type="submit" class="btn btn-primary">
                                    {{ __('submit') }}
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $("#button").click(function() {
            let id = $("#id").val();
            let name = $("#new_name").val();
            console.log(id, name);
            // $.ajax({
            //     url: "{{ route('get') }}",
            //     type: "GET",
            //     data: "id="+id,
            //     success: function(result) {
            //        console.log(result);
            //        $("#name").html(result.name);
            //        $("#email_address").html(result.email);
            //        $("#navbarDropdown").html(result.name);
            //     },
            //     error: function(error) {
            //         console.log(error);
            //     }
            // });

            $.ajax({
                url: "{{ route('post') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    name: name
                },
                success: function(result) {
                   console.log(result);
                   $("#name").html(result.name);
                   $("#email_address").html(result.email);
                   $("#navbarDropdown").html(result.name);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
@endpush
