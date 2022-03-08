<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Hai ricevuto una mail da un nuovo cliente</h2>

    <h3> Name: {{$new_lead->name}}</h3>
    <h4>Email: {{$new_lead->email}} </h4>
    <p> Message: {{$new_lead->message}}</p>
</body>
</html>