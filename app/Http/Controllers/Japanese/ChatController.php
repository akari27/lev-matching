<?php


namespace App\Http\Controllers\Japanese;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Models\Chat;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return Inertia::render('Chat');
    }
}
