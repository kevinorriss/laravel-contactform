<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            @if (Session::has('success'))
                <div class="alert alert-success">
                    <span>{{ Session::get('success') }}</span>
                </div>
            @endif

			<div class="panel panel-default">
                <div class="panel-heading">{{ $heading ?? 'Contact Form' }}</div>
                <div class="panel-body">
                    <form action="{{ route('contactform.post') }}" method="POST" role="form">
                        {{ csrf_field() }}

						<!-- Email -->
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Email</label>
                            @if (!is_null(old('email')))
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}"/>
                            @elseif(Auth::check())
                                <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}"/>
                            @else
                                <input type="text" name="email" class="form-control" value=""/>
                            @endif
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <!-- Message -->
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="control-label">Message</label>
                            <textarea name="message" class="form-control">{{ old('message') }}</textarea>
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

                	</form>
                </div>
            </div>
            
        </div>
	</div>
</div>
