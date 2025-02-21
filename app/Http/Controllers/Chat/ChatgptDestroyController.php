<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\RedirectResponse;

class ChatgptDestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Chat $chat): RedirectResponse
    {
        $chat->delete();

        return to_route('chat.show');
    }
}
