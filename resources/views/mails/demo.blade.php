
<h1>Verify your e-mail to finish signing up for Parking</h1>
<p>Thank you for choosing Parking</p>

 <p>Please confirm that {{ $demo->receiver }} is your e-mail address by clicking on the button below or use this link.</p>
 <p>{{url('')}}/confirm-email/{{ $demo->token }}.</p>
 <br/>
<a href="{{url('')}}/confirm-email/{{ $demo->token }}">
<button>VERIFY</button>
</a>