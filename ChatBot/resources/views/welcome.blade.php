<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chatbot Sost</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        .container {
            max-width: 800px;
            margin: auto;
            margin-top: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            background-color: #fff;
        }

        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }

        .message.assistant {
            background-color: #e6f7d9;
        }

        .message.user {
            background-color: #d9e6f7;
        }

        .message .name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .message .content {
            margin-left: 10px;
        }

        form {
            margin-top: 20px;
        }

        .reset-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Chatbot</h1>
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <div class="messages">
                            @foreach($messages as $message)
                                <div class="message {{ $message['role'] === 'assistant' ? 'assistant' : 'user' }}">
                                    <div class="name">{{ $message['role'] === 'assistant' ? 'Chatbot' : 'You' }}</div>
                                    <div class="content">{!! \Illuminate\Mail\Markdown::parse($message['content']) !!}</div>
                                </div>
                            @endforeach
                        </div>
                        <form action="/" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="message">Sua mensagem:</label>
                                <input type="text" id="message" name="message" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                            <a href="{{ route('reset') }}" class="btn btn-danger ml-2">Resetar Conversa</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>