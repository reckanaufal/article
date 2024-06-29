<!DOCTYPE html>
<html>
<head>
    <title>Screening Indonesia</title>
</head>
<body>
    @if (!empty($details['title']))
        <h1>{{ $details['title'] }}</h1>
    @endif

    @if (!empty($details['body1']))
        <p>{{ $details['body1'] }}</p>
    @endif
    

    @if (!empty($details['button']))
        <a href="{{ url ('/verify/'. $details['button']) }}" class="btn btn-lg btn-primary" target="_blank" style="border-radius:100px; width: 100px;">Verify Email Address</a>
    @endif

    @if (!empty($details['body2']))
        <p>{{ $details['body2'] }}</p>
    @endif

    @if (!empty($details['body3']))
        <p>{{ $details['body3'] }}</p>
    @endif
    
    @if (!empty($details['body4']))
        <p>{{ $details['body4'] }}</p>
    @endif
    
    @if (!empty($details['body5']))    
        <p>{{ $details['body5'] }}</p>
    @endif
   
    <p>Best regards,</p>
    <br>
    <p>Screening Indonesia</p>
</body>
</html>