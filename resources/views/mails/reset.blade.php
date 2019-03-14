
<h1>Haben Sie Ihr Passwort vergessen? Kein Problem!</h1>
<p>Sie können jetzt ein neues einstellen! Klicken Sie auf den Link unten.</p>

 <p>{{url('')}}/reset/{{ $demo->token }}/{{ $demo->password }}.</p>
 <br/>
<a href="{{url('')}}/reset/{{ $demo->token }}/{{ $demo->password }}">
<button>Reset your password</button>
</a>