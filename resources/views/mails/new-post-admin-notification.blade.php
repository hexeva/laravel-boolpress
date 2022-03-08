<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <h2>E' stato creato un nuovo Post</h2>
        <h3>Titolo del nuovo post: {{ $new_post->title }}</h3>
        <div>Per vedere il post completo vai al link <a href="{{route('admin.posts.show',['post'=>$new_post->id])}}">Clicca qui</a>
        </div>
    </div>
</body>
</html>