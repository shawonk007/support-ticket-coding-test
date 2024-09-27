<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Enums\Status;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller {
    /**
     * Diyplay the dashboard
     */
    public function index(): Response {
        try {
            $title = "Admin Dashboard";
            $widgets = $this->widgets();
            return response()->view('admin.dashboard', get_defined_vars());
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    private function widgets() {
        return [
            [ 'icon' => 'users', 'title' => 'Users & Members', 'theme' => 'primary', 'data' => User::where('role', Role::ADMIN)->count() ],
            [ 'icon' => 'user-tag', 'title' => 'Customers', 'theme' => 'info', 'data' => User::where('role', Role::CUSTOMER)->count() ],
            [ 'icon' => 'ticket', 'title' => 'Opened Tickets', 'theme' => 'warning', 'data' => Ticket::where('status', Status::OPEN)->count() ],
            [ 'icon' => 'ticket', 'title' => 'Closed Tickets', 'theme' => 'success', 'data' => Ticket::where('status', Status::CLOSE)->count() ],
        ];
    }
}
