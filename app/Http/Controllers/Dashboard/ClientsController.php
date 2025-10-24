<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Client\ClientRepository;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public $clientRepo;

    public function __construct(ClientRepository $repo)
    {
        $this->clientRepo = $repo;
    }

    public function index()
    {
        $clients = $this->clientRepo->getMainClient();
        return view('dashboard.clients.index', compact('clients'));
    }

    public function edit(string $id)
    {
        $client = \App\Models\User::findOrFail($id);
        return view('dashboard.clients.edit', compact('client'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validated();
        $wasChanged = $this->clientRepo->update($data, $id);

        if ($wasChanged) {
            return redirect()->back()->with('success','تم التحديث');
        }
        return redirect()->back()->with('dark', 'تم التحديث');
    }

    public function toggleActivation($id)
    {
        $client = $this->clientRepo->toggleActivation($id);

        $status = $client->is_active ? 'تم تفعيل الحساب بنجاح ✅' : 'تم إلغاء التفعيل 🚫';
        return redirect()->back()->with('success', $status);
    }
}
