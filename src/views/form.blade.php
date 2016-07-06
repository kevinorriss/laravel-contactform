<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            @if (Session::has('success'))
                <div class="alert alert-success">
                    <span>{{ Session::get('success') }}</span>
                </div>
            @endif

			<div class="panel panel-primary">
                <div class="panel-heading">{{ $heading ?? 'Contact Form' }}</div>
                <div class="panel-body">
                	{!! Collective\Html\FormFacade::open(['url' => route('contactform.post'), 'method' => 'POST', 'role' => 'form']) !!}

						<!-- Email -->
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Collective\Html\FormFacade::label('email', 'Email', ['class' => 'control-label text-primary']) !!}
                            {!! Collective\Html\FormFacade::text('email', !is_null(old('email')) ? old('email') : (Auth::check() ? Auth::user()->email : ''), ['class' => 'form-control']) !!}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <!-- Message -->
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            {!! Collective\Html\FormFacade::label('message', 'Message', ['class' => 'control-label text-primary']) !!}
                            {!! Collective\Html\FormFacade::textarea('message', old('message'), ['class' => 'form-control']) !!}
                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>

                        <!-- reCAPTCHA -->
                        <div class="form-group{{ $errors->has('recaptcha') ? ' has-error' : '' }}">
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                            @if ($errors->has('recaptcha'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('recaptcha') }}</strong>
                                </span>
                            @endif
                        </div>

                        <!-- Submit button -->
                        <div class="form-group">
                        	<button type="submit" class="btn btn-primary btn-right-space">Send Message</button>
                        	<a class="btn btn-default" href="{{ route('contactform.get') }}">Reset</a>
                        </div>

                	{!! Collective\Html\FormFacade::close() !!}
                </div>
            </div>
            
        </div>
	</div>
</div>
