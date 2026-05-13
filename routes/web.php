<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SplashController;

// Splash screen as the app entry point
Route::get('/', [SplashController::class, 'index']);

// Simple login page (GET) — used by the splash "Get Started" button
Route::view('/login', 'auth.login')->name('login');

// Plumber listing and booking
use App\Http\Controllers\PlumberController;
use App\Http\Controllers\BookingController;

Route::get('/plumbers', [PlumberController::class, 'index'])->name('plumbers.index');
Route::get('/plumbers/{plumber}', [PlumberController::class, 'show'])->name('plumbers.show');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

use App\Http\Controllers\AuthController;

// Authentication
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
// Registration
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

// Simple dashboards
Route::get('/dashboard/user', function () {
	$id = session('user_id');
	if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id);
if (!$user) return redirect()->route('login');
return view('dashboards.user', compact('user'));
})->name('user.dashboard');
Route::get('/dashboard/plumber', function () {
$id = session('user_id');
if (!$id) return redirect()->route('login');
$user = App\Models\User::find($id);
if (!$user || $user->role !== 'plumber') abort(403);
return view('dashboards.plumber', compact('user'));
})->name('plumber.dashboard');
// Admin-facing plumbers list inside dashboard
Route::get('/dashboard/plumbers', function () {
	$id = session('user_id');
	if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id);
	if (!$user || $user->role !== 'admin') abort(403);
	$plumbers = App\Models\Plumber::orderBy('rating','desc')->paginate(12);
	return view('dashboards.plumbers', compact('user','plumbers'));
})->name('dashboard.plumbers');
Route::get('/dashboard/admin', function () {
$id = session('user_id');
if (!$id) return redirect()->route('login');
$user = App\Models\User::find($id);
if (!$user || $user->role !== 'admin') abort(403);
// log visit
try {
\App\Models\Visit::create([
'user_id' => $user->id,
'path' => request()->path(),
'ip' => request()->ip(),
'user_agent' => substr(request()->userAgent() ?? '', 0, 1000),
]);
	} catch (\Throwable $e) {
		// ignore logging errors
	}

$users = App\Models\User::orderBy('created_at','desc')->get();
$visits = App\Models\Visit::latest()->limit(50)->get();
return view('dashboards.admin', compact('user','users','visits'));
})->name('admin.dashboard');

// Requests
Route::get('/requests', function () {
	$id = session('user_id');
	if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id);
	if (!$user) return redirect()->route('login');
	// Show user requests page
	$requests = App\Models\ServiceRequest::where('user_id', $user->id)->get();
	return view('requests.index', compact('user','requests'));
})->name('requests.index');

// Show create form
Route::get('/requests/create', function () {
	$id = session('user_id');
	if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id);
	if (!$user) return redirect()->route('login');
	return view('requests.create', compact('user'));
})->name('requests.create');

// Store request
Route::post('/requests', function (\Illuminate\Http\Request $r) {
	$id = session('user_id');
	if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id);
	$data = $r->validate([
		'title' => 'required|string',
		'service' => 'nullable|string',
		'details' => 'nullable|string',
	]);
	$req = App\Models\ServiceRequest::create([
		'user_id' => $user->id,
		'title' => $data['title'],
		'service' => $data['service'] ?? null,
		'details' => $data['details'] ?? null,
		'status' => 'open',
	]);
	return redirect()->route('requests.index');
})->name('requests.store');

// Admin list / manage requests
Route::get('/dashboard/requests', function () {
	$id = session('user_id');
	if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id);
	if (!$user || $user->role !== 'admin') abort(403);
	$requests = App\Models\ServiceRequest::latest()->get();
	return view('requests.admin_index', compact('user','requests'));
})->name('dashboard.requests');

// Assign plumber to request
Route::post('/requests/{request}/assign', function (App\Models\ServiceRequest $request, \Illuminate\Http\Request $r) {
	$id = session('user_id');
	if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id);
	if (!$user || $user->role !== 'admin') abort(403);
	$data = $r->validate(['plumber_id' => 'nullable|exists:plumbers,id']);
	$request->plumber_id = $data['plumber_id'] ?? null;
	$request->status = $data['plumber_id'] ? 'assigned' : $request->status;
	$request->save();
	return redirect()->route('dashboard.requests');
})->name('requests.assign');

// DEV: quick route to sign-in as seeded admin and redirect to admin dashboard
// Remove this in production. Useful for local testing when you want to open the admin page directly.
Route::get('/dev/admin', function () {
	$admin = App\Models\User::where('email', 'admin@example.com')->first();
	if (!$admin) abort(404, 'Seeded admin not found');
	session(['user_id' => $admin->id, 'user_name' => $admin->name]);
	return redirect()->route('admin.dashboard');
});
