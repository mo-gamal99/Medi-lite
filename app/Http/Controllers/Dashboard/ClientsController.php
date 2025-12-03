<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Client\ClientRepository;
use App\Services\Notifications\FireBase;
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
            $client->update([
                'is_active' => false,
                'activated_at' => null,
                'expires_at' => null,
            ]);
            $status = 'تم إلغاء التفعيل 🚫';
        } else {
            $client->update([
                'is_active' => true,
                'activated_at' => now(),
                'expires_at' => now()->addYear(),
            ]);
            // Send notification safely
            try {
                if ($client->fcm_token) {
                    FireBase::send(
                        'تم تفعيل حسابك ✔️',
                        'تم تفعيل حسابك الآن.',
                        [$client->fcm_token],
                        ['customKey' => 'customValue']
                    );
                }
            } catch (\Exception $e) {
                // لو الخطأ بسبب Token invalid → امسحه
                if (str_contains($e->getMessage(), 'not a valid FCM registration token')) {
                    $client->update(['fcm_token' => null]);
                }
                // متوقفش العملية
            }
            $status = 'تم تفعيل الحساب بنجاح ✅';
        }



        return redirect()->back()->with('success', $status);
    }

    public function destroy($id)
    {
        Gate::authorize('client.control');

        $client = User::findOrFail($id);

        $client->delete();

        return redirect()->back()->with('danger', 'تم حذف العميل بنجاح 🗑️');
    }
}
