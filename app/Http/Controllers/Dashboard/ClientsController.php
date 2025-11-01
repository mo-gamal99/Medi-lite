<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Client\ClientRepository;
use Illuminate\Support\Facades\Gate;
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
        Gate::authorize('client.view');
        $clients = $this->clientRepo->getMainClient();
        return view('dashboard.clients.index', compact('clients'));
    }

    public function edit(string $id)
    {
        Gate::authorize('client.edit');
        $client = \App\Models\User::findOrFail($id);
        return view('dashboard.clients.edit', compact('client'));
    }

    public function update(Request $request, string $id)
    {
        Gate::authorize('client.edit');
        $data = $request->validated();
        $wasChanged = $this->clientRepo->update($data, $id);

        if ($wasChanged) {
            return redirect()->back()->with('success', 'تم التحديث');
        }
        return redirect()->back()->with('dark', 'تم التحديث');
    }

    public function toggleActivation($id)
    {
        Gate::authorize('client.control');
        $client = User::findOrFail($id);

        if ($client->is_active) {
            // إلغاء التفعيل
            $client->update([
                'is_active' => false,
                'activated_at' => null,
                'expires_at' => null,
            ]);
            $status = 'تم إلغاء التفعيل 🚫';
        } else {
            // تفعيل جديد
            $client->update([
                'is_active' => true,
                'activated_at' => now(),
                'expires_at' => now()->addYear(),
            ]);
            $status = 'تم تفعيل الحساب بنجاح ✅';
        }

        return redirect()->back()->with('success', $status);
    }
}
