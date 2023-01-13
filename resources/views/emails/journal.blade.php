<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
        integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />
    <!--IZI TOAST-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
</head>

<body>
    <div class="container">
        <div class="border rounded p-2">
            @php
                $journals = \App\Models\UsersJournal::where('user_id', '=', session()->get('user_id'))->get();
                $i=1;
            @endphp
            @foreach ($journals as $journal)
                <h5>Entry#{{ $i }}</h5>
                <p class="text-left">{{ $journal->description }}</p><br>
                @php
                    \App\Models\UsersJournal::where('id', '=', $journal->id)->update([
                        'sent_to_mail' => 'Yes',
                        'mail' => session()->get('user_mail'),
                    ]);
                    $i++;
                @endphp
            @endforeach
        </div>
    </div>
</body>

</html>
