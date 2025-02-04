<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;

class ChatController extends Controller
{
    public function index()
    {

        // Fetch chats with related users
        $chats = Chat::with(['user', 'lastMessage'])->get();


        // Pass the chats to the view
        return view('conversas', ['chats' => $chats]);
    }

    public function getMessages($chatId)
    {
        $chat = Chat::with(['messages.user'])->findOrFail($chatId);

        return response()->json([
            'messages' => $chat->messages()->orderBy('created_at', 'asc')->get()
        ]);
    }
    public function sendMessage(Request $request, $chatId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);
        
        $chat = Chat::findOrFail($chatId);
        
        // Apenas lojas enviam mensagens no painel, então associamos o senderId ao ID da loja.
        $senderId = auth()->id(); // Pegamos o ID da loja logada
        
        // Define o tipo de remetente como 'store' (loja)
        $senderType = 'store';
        
        // Cria a mensagem e atribui corretamente o sender_id e sender_type
        $message = new Message();
        $message->chatId = $chat->id;
        $message->senderId = $senderId;
        $message->senderType = $senderType;
        $message->message = $request->message;
        $message->save();
        
        return response()->json(['success' => true]);
    }
    

}