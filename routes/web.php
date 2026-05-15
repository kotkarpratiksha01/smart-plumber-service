<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SplashController;

// Splash screen as the app entry point


// Simple login page (GET) — used by the splash "Get Started" button
Route::view('/', 'auth.login')->name('login');

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

// Admin plumber CRUD
Route::get('/dashboard/plumbers/create', function () {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id); if (!$user || $user->role !== 'admin') abort(403);
	return view('admin.plumbers.create');
})->name('dashboard.plumbers.create');

Route::post('/dashboard/plumbers', function (\Illuminate\Http\Request $r) {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id); if (!$user || $user->role !== 'admin') abort(403);
	$data = $r->validate([
		'name' => 'required|string|max:255',
		'phone' => 'nullable|string|max:50',
		'location' => 'nullable|string|max:255',
		'services' => 'nullable|string',
		'rating' => 'nullable|numeric|min:0|max:5',
		'experience_years' => 'nullable|integer|min:0',
		'available' => 'nullable|boolean',
	]);
	$data['services'] = $data['services'] ?? null;
	$data['available'] = isset($data['available']) ? (bool)$data['available'] : true;
	App\Models\Plumber::create($data);
	return redirect()->route('dashboard.plumbers')->with('status','Plumber created');
})->name('dashboard.plumbers.store');

Route::get('/dashboard/plumbers/{plumber}/edit', function (App\Models\Plumber $plumber) {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id); if (!$user || $user->role !== 'admin') abort(403);
	return view('admin.plumbers.edit', compact('plumber'));
})->name('dashboard.plumbers.edit');

Route::put('/dashboard/plumbers/{plumber}', function (App\Models\Plumber $plumber, \Illuminate\Http\Request $r) {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id); if (!$user || $user->role !== 'admin') abort(403);
	$data = $r->validate([
		'name' => 'required|string|max:255',
		'phone' => 'nullable|string|max:50',
		'location' => 'nullable|string|max:255',
		'services' => 'nullable|string',
		'rating' => 'nullable|numeric|min:0|max:5',
		'experience_years' => 'nullable|integer|min:0',
		'available' => 'nullable|boolean',
	]);
	$plumber->update($data);
	return redirect()->route('dashboard.plumbers')->with('status','Plumber updated');
})->name('dashboard.plumbers.update');

Route::get('/dashboard/plumbers/{plumber}/delete', function (App\Models\Plumber $plumber) {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id); if (!$user || $user->role !== 'admin') abort(403);
	return view('admin.plumbers.delete', compact('plumber'));
})->name('dashboard.plumbers.delete');

Route::delete('/dashboard/plumbers/{plumber}', function (App\Models\Plumber $plumber) {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id); if (!$user || $user->role !== 'admin') abort(403);
	$plumber->delete();
	return redirect()->route('dashboard.plumbers')->with('status','Plumber deleted');
})->name('dashboard.plumbers.destroy');

// Admin booking requests view
Route::get('/dashboard/bookings', function () {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$user = App\Models\User::find($id); if (!$user || $user->role !== 'admin') abort(403);
	$bookings = App\Models\Booking::with('plumber')->orderBy('created_at','desc')->paginate(20);
	return view('admin.bookings.index', compact('user','bookings'));
})->name('dashboard.bookings');
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

// Admin user management: show, edit, update, delete
Route::get('/dashboard/users/{user}', function (App\Models\User $user) {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$current = App\Models\User::find($id); if (!$current || $current->role !== 'admin') abort(403);
	return view('admin.users.show', compact('user'));
})->name('dashboard.users.show');

Route::get('/dashboard/users/{user}/edit', function (App\Models\User $user) {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$current = App\Models\User::find($id); if (!$current || $current->role !== 'admin') abort(403);
	$plumbers = App\Models\Plumber::all();
	return view('admin.users.edit', compact('user','plumbers'));
})->name('dashboard.users.edit');

Route::put('/dashboard/users/{user}', function (App\Models\User $user, \Illuminate\Http\Request $r) {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$current = App\Models\User::find($id); if (!$current || $current->role !== 'admin') abort(403);
	$data = $r->validate([
		'name' => 'required|string',
		'email' => 'required|email|unique:users,email,'.$user->id,
		'role' => 'required|in:user,plumber,admin',
		'plumber_id' => 'nullable|exists:plumbers,id',
		'password' => 'nullable|string|confirmed|min:6'
	]);
	$user->name = $data['name'];
	$user->email = $data['email'];
	$user->role = $data['role'];
	$user->plumber_id = $data['plumber_id'] ?? null;
	if (!empty($data['password'])) {
		$user->password = \Illuminate\Support\Facades\Hash::make($data['password']);
	}
	$user->save();
	return redirect()->route('admin.dashboard')->with('status','User updated');
})->name('dashboard.users.update');

Route::get('/dashboard/users/{user}/delete', function (App\Models\User $user) {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$current = App\Models\User::find($id); if (!$current || $current->role !== 'admin') abort(403);
	return view('admin.users.delete', compact('user'));
})->name('dashboard.users.delete');

Route::delete('/dashboard/users/{user}', function (App\Models\User $user) {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$current = App\Models\User::find($id); if (!$current || $current->role !== 'admin') abort(403);
	if ($current->id === $user->id) return redirect()->route('admin.dashboard')->with('status','Cannot delete yourself');
	$user->delete();
	return redirect()->route('admin.dashboard')->with('status','User deleted');
})->name('dashboard.users.destroy');

// Admin: create user (form)
Route::get('/dashboard/users/create', function () {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$current = App\Models\User::find($id); if (!$current || $current->role !== 'admin') abort(403);
	$plumbers = App\Models\Plumber::all();
	return view('admin.users.create', compact('plumbers'));
})->name('dashboard.users.create');

// Admin: store new user
Route::post('/dashboard/users', function (\Illuminate\Http\Request $r) {
	$id = session('user_id'); if (!$id) return redirect()->route('login');
	$current = App\Models\User::find($id); if (!$current || $current->role !== 'admin') abort(403);
	$data = $r->validate([
		'name' => 'required|string',
		'email' => 'required|email|unique:users,email',
		'role' => 'required|in:user,plumber,admin',
		'plumber_id' => 'nullable|exists:plumbers,id',
		'password' => 'required|string|confirmed|min:6'
	]);
	$user = App\Models\User::create([
		'name' => $data['name'],
		'email' => $data['email'],
		'role' => $data['role'],
		'plumber_id' => $data['plumber_id'] ?? null,
		'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
	]);
	return redirect()->route('admin.dashboard')->with('status','User created');
})->name('dashboard.users.store');

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
