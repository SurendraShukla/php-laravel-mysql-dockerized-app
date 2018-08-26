@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        Fetch Commits from Github and twitts from Twitter
                        @if(Auth::guest())
                            <a href="/login" class="btn btn-info"> To see the list, you need to login !</a>
                        @endif
                    </div>

                    @if(Auth::check())
                        <form method="POST" action="{{ route('home') }}" aria-label="{{ __('home') }}">
                            @csrf

                            <div class="form-group row">&nbsp;</div>
                            <div class="form-group row">
                                <label for="usernames"
                                       class="col-md-4 col-form-label">{{ __('Type username comma separated') }}</label>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="usernames" name="usernames" type="text"
                                           class="form-control{{ $errors->has('usernames') ? ' is-invalid' : '' }}"
                                           required>

                                    @if ($errors->has('usernames'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('usernames') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <button type="button" id="submit-button" class="btn btn-primary">
                                        {{ __('Search') }}
                                    </button>
                                </div>
                            </div>

                            <script>
                                function getMessage(e) {
                                    if($('#usernames').val().trim() == ""){
                                        $('#usernames').css('border', 'solid 1px red');
                                        return;
                                    }

                                    $("#result").html("Loading...");
                                    $.ajax({
                                        type:'POST',headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        url:'/get-commits',
                                        data: {
                                            _token : $('meta[name="csrf-token"]').attr('content'),
                                            usernames: $("#usernames").val()
                                        },
                                        success:function(data){
                                            $("#result").html(data);
                                        }
                                    });
                                }

                                $(document).ready(function () {
                                    $("#submit-button").click(getMessage);
                                    $("#usernames").focus(function(){
                                        $(this).css('border', '');
                                    });
                                });
                            </script>

                        </form>

                        <div id="result"></div>
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection
