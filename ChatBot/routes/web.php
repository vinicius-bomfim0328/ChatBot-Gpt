<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $messages = collect(session('messages', []))->reject(fn ($message) => $message['role'] === 'system');

    return view('welcome', [
        'messages' => $messages
    ]);
});


Route::post('/', function (Request $request) {
    $messages = $request->session()->get('messages', [
        ['role' => 'system', 'content' => 'You are LaravelGPT - A ChatGPT clone. Answer as concisely as possible.']
    ]);
    
    $messages[] = ['role' => 'user', 'content' => $request->input('message')];
    
    $response = OpenAI::chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => $messages
    ]);

    $messages[] = ['role' => 'assistant', 'content' => $response->choices[0]->message->content];

    $request->session()->put('messages', $messages);

    return redirect('/');   
});

Route::get('/reset', function () {
    // Limpa a variável global que armazena as mensagens.
    global $messages;
    $messages = [];

    session()->forget('messages');

    // Redireciona o usuário para a página inicial do chatbot.
    return redirect('/');
})->name('reset');

