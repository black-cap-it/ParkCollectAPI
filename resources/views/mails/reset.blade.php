
<h1>Forgot your password? No problem!</h1>
<p>You can set a new one now! Click the link below.</p>

 <p>{{url('')}}/reset/{{ $demo->token }}/{{ $demo->password }}.</p>
 <br/>
<a href="{{url('')}}/reset/{{ $demo->token }}/{{ $demo->password }}">
<button>Reset your password</button>
</a>