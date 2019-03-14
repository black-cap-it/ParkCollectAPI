
<h1>Bestätigen Sie Ihre E-Mail, um die Anmeldung  abzuschließen.</h1>
<p>Vielen Dank, dass Sie sich für Park & Collect entschieden haben.</p>

 <p>Bitte bestätigen Sie, dass {{ $demo->receiver }} Ihre E-Mail-Adresse ist, indem Sie auf die Schaltfläche  klicken oder diesen Link verwenden.</p>
 <p>{{url('')}}/confirm-email/{{ $demo->token }}.</p>
 <br/>
<a href="{{url('')}}/confirm-email/{{ $demo->token }}">
<button>überprüfen</button>
</a>