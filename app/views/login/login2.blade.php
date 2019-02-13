
@extends('section.layout.layout')
@section('content')

<div class="modal show" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert">
                <form id="sign_in" action="{{ asset('login') }}" method="POST">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="{{ asset('print/image/ro7.png') }}" height="150" width="150" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>DOH RO7 PPMP</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <button class="btn btn-lg btn-success btn-block" type="submit">SIGN IN</button>
                            </fieldset>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 col-md-offset-3">
                                <p>
                                <a href="{{ asset('assets') }}">Master</a>
                                </p>
                                <p>
                                <a href="{{ asset('reset/password') }}">Forgot Password?</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    
@endsection