<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
    <h2>Your Booking is Confirmed</h2>
    <h3>Details Are:</h3> 
    <p>User Name : {{Auth::user()->name}}</p>
    <p>Adults : {{ $details['adults'].", Childrens : ".$details['childrens'] }} </p>
    <p>Hotel Name : {{ $details['hotelname']}}</p>
    <p>Room : {{ $details['room'].", Type : ".$details['type']}}
    <p>Check In : {{ $details['check_in'] }}</p> 
    <p>Check Out : {{ $details['check_out'] }}</p> 
    <p>Amount : {{ $details['amount']}} {{ ($details['currency']=="EUR")? "€":"$"; }}</p>
    <p>Thank you</p>
</body>
</html>