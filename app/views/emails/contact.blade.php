<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body dir="ltr">
<div>

    <h2>New message received in firstchoice.cc website</h2>

    <strong>Name: </strong> {{ $inputs['name'] }}<br/>
    <strong>Email: </strong> {{ $inputs['email'] }}<br/>
    <strong>Subject: </strong> {{ $inputs['subject'] }}<br/>
    <strong>Message: </strong> {{ $inputs['body'] }}<br/>

    <hr />

    <br/>

    <strong>Date: </strong><small>{{ date("F Y") }}</small>
</div>
</body>
</html>