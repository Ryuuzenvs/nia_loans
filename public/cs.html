<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheatsheet Peminjaman Alat - Ryuu Docs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; color: #333; }
        .sidebar { position: fixed; top: 0; left: 0; height: 100vh; width: 260px; background: #212529; padding-top: 20px; color: white; overflow-y: auto; }
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 10px 20px; display: block; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { color: #fff; background: #343a40; border-left: 4px solid #0d6efd; }
        .main-content { margin-left: 260px; padding: 40px; }
        .code-block { background: #2d2d2d; color: #f8f8f2; padding: 20px; border-radius: 8px; font-family: 'Fira Code', monospace; font-size: 0.9rem; overflow-x: auto; position: relative; margin-bottom: 20px; border-left: 5px solid #0d6efd; }
        .file-name { background: #444; color: #eee; padding: 4px 12px; font-size: 0.75rem; border-radius: 4px 4px 0 0; display: inline-block; margin-bottom: -1px; }
        .badge-logic { background-color: #e7f1ff; color: #0d6efd; border: 1px solid #0d6efd; font-weight: 600; }
        h2 { border-bottom: 2px solid #dee2e6; padding-bottom: 10px; margin-top: 40px; color: #0d6efd; }
        .card-explanation { border-left: 4px solid #198754; background: #f0fff4; }
        footer { margin-top: 50px; padding: 20px; text-align: center; color: #6c757d; font-size: 0.8rem; }
    </style>
</head>
<body>

<div class="sidebar d-none d-md-block">
    <div class="px-4 mb-4">
        <h4 class="text-white fw-bold">Project <span class="text-primary">Docs</span></h4>
        <small class="text-muted">v1.0 - Laravel Dev</small>
    </div>
    <a href="#mvc" class="active">1. Konsep MVC</a>
    <a href="#migration">2. Migration & Database</a>
    <a href="#seeder">3. Seeder (Isi Data)</a>
    <a href="#model">4. Model & Eloquent</a>
    <a href="#routes">5. Routing (Jalur)</a>
    <a href="#controller">6. Controller (Logika)</a>
    <a href="#view">7. Blade View</a>
    <a href="#logic-deep-dive">8. Deep Dive Logic</a>
<a href="#function-details">9. Bedah Fungsi (Logic)</a>
</div>

<div class="main-content">
    <div class="container-fluid">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Cheatsheet Peminjaman Alat</h1>
            <p class="lead text-muted">Panduan fundamental Laravel untuk Backend Junior.</p>
        </div>

        <section id="mvc">
            <h2>1. Konsep Dasar MVC</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold">Model</h5>
                            <p class="small text-muted">Urusan data dan tabel. Jembatan antara PHP dan Database.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold">View</h5>
                            <p class="small text-muted">Tampilan user. Apa yang dilihat orang (HTML/Blade).</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold">Controller</h5>
                            <p class="small text-muted">Otak aplikasi. Ngatur data dari Model buat dikirim ke View.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="migration">
            <h2>2. Migration & Logic DB</h2>
            <p>Migration adalah "Blueprint" atau cetakan tabel. Daripada bikin manual di phpMyAdmin, mending pakai kode biar rapi dan bisa dipindah-pindah.</p>
            
            <div class="file-name">database/migrations/xxxx_create_loans_table.php</div>
            <div class="code-block shadow">
<pre>
public function up(): void {
    Schema::create('loans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('borrower_id')->constrained('users'); // Siapa yang pinjam
        $table->foreignId('tool_id')->constrained('tools');     // Alat apa
        $table->enum('status',['pending', 'borrow', 'return'])->default('pending');
        $table->date('due_date'); // Tenggat waktu
        $table->timestamps();
    });
}
</pre>
            </div>

            <div class="card card-explanation mb-4">
                <div class="card-body">
                    <h6 class="fw-bold"><i class="bi bi-info-circle"></i> Penjelasan Simpel Migration:</h6>
                    <p class="mb-0 small">Bikin migration itu kayak bikin <strong>formulir kosong</strong>. Kita tentuin kolom apa aja (ID, Nama Alat, Tgl Pinjam). Kelebihannya, kalau teman satu tim mau pakai, mereka tinggal jalankan <code>php artisan migrate</code> tanpa perlu ekspor-impor SQL.</p>
                </div>
            </div>

            <h5>Logika Denda (MySQL Function)</h5>
            <div class="code-block shadow">
<pre>
-- Rumus: 1% dari harga alat per hari telat
SET v_denda_per_hari = 0.01 * v_harga_alat;
SET v_total_denda = (v_denda_per_hari * v_selisih_hari) * p_qty;
</pre>
            </div>
            <div class="card card-explanation border-primary mb-4" style="border-left-color: #0d6efd !important;">
                <div class="card-body small">
                    <strong>Kenapa pakai Function DB?</strong> Supaya perhitungan denda konsisten dan cepat karena dihitung langsung di level database, bukan ditarik dulu ke PHP baru dihitung.
                </div>
            </div>
        </section>

        <section id="seeder">
            <h2>3. Seeder</h2>
            <p>Seeder gunanya buat ngisi "data palsu" atau data awal biar aplikasi nggak kosong melompong pas pertama kali dideploy.</p>
            <div class="file-name">database/seeders/DatabaseSeeder.php</div>
            <div class="code-block shadow">
<pre>
category::insert([
    ['nama_kategori' => 'Buku Novel', ...],
    ['nama_kategori' => 'Buku Pelajaran', ...],
]);
</pre>
            </div>
            <div class="alert alert-info py-2 small">
                <strong>Simpelnya:</strong> Seeder itu <strong>tukang isi barang</strong>. Migration bikin raknya, Seeder yang naruh bukunya biar kita bisa langsung tes fitur pinjam.
            </div>
        </section>

        <section id="model">
            <h2>4. Model & Relasi</h2>
            <p>Model mewakili satu tabel. Di sini kita atur <code>$fillable</code> (kolom yang boleh diisi) dan relasi antar tabel.</p>
            <div class="file-name">app/Models/Loan.php</div>
            <div class="code-block">
<pre>
protected $fillable = ['borrower_id', 'tool_id', 'status', 'qty', 'due_date'];

public function tool() {
    return $this->belongsTo(Tool::class, 'tool_id');
}
</pre>
            </div>
            <div class="card card-explanation mb-4">
                <div class="card-body small">
                    <strong>Simpelnya:</strong> Model itu <strong>satpam tabel</strong>. Dia tahu siapa aja (kolom) yang boleh masuk (mass assignment) dan dia tahu hubungan (relasi) tabel ini dengan tabel lain (Misal: 1 Peminjaman pasti punya 1 Alat).
                </div>
            </div>
        </section>

        <section id="routes">
            <h2>5. Routing (Peta Jalan)</h2>
            <p>Route adalah alamat URL yang bisa diakses user.</p>
            <div class="file-name">routes/web.php</div>
            <div class="code-block">
<pre>
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('tools', ToolController::class);
    Route::get('/admin/loans', [LoanController::class, 'adminIndex'])->name('admin.loans.index');
});
</pre>
            </div>
            <div class="alert alert-warning py-2 small">
                <strong>Simpelnya:</strong> Route itu <strong>Resepsionis</strong>. Dia ngecek tamu (user) boleh masuk ke ruangan (halaman) mana berdasarkan ID Card (Middleware/Role) mereka.
            </div>
        </section>

        <section id="controller">
            <h2>6. Controller (Logika Utama)</h2>
            <p>Tempat semua proses terjadi. Contoh fungsi <code>adminIndex</code>:</p>
            <div class="file-name">app/Http/Controllers/LoanController.php</div>
            <div class="code-block">
<pre>
public function adminIndex() {
    $loans = loan::with(['borrower', 'tool', 'approver'])->latest()->paginate(5);
    return view('admin.loans.index', compact('loans'));
}
</pre>
            </div>
            <div class="card card-explanation mb-4">
                <div class="card-body small">
                    <strong>Simpelnya:</strong> <code>with()</code> dipakai biar nggak boros query (Eager Loading). <code>compact()</code> itu kayak kita <strong>bungkus paket</strong> isinya data <code>$loans</code> buat dikirim ke kurir (View) biar sampai ke alamat <code>admin.loans.index</code>.
                </div>
            </div>
        </section>

        <section id="view">
            <h2>7. Blade View (Display)</h2>
            <p> data yang dikirim tadi kita tampilkan pakai perulangan.</p>
            <div class="file-name">resources/views/admin/loans/index.blade.php</div>
            <div class="code-block">
<pre>
@foreach ($loans as $l)
    &lt;div&gt;{{ $l->borrower->username }} pinjam {{ $l->tool->name_tools }}&lt;/div&gt;
@endforeach
</pre>
            </div>
            <div class="alert alert-success py-2 small">
                <strong>Simpelnya:</strong> Blade itu HTML yang pinter. Dia bisa baca variabel PHP dan nampilin secara otomatis pakai <code>{{ }}</code>.
            </div>
        </section>

        <hr>
<section id="logic-deep-dive">
    <h2 class="mt-5"><i class="bi bi-gear-fill"></i> Logic Deep Dive: LoanController</h2>
    <p class="text-muted">Memahami bagaimana data diproses, divalidasi, hingga denda dihitung otomatis oleh Database.</p>

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-primary text-white fw-bold">
            Fungsi: store() - Proses Pengajuan Pinjam
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="file-name">Logic Flow</div>
                    <div class="code-block" style="background: #1e1e1e;">
<pre style="color: #9cdcfe;">
1. Validasi: "Ada ID alat gak?"
2. DB::beginTransaction(): "Mulai transaksi (biar aman)"
3. Cari Alat: Fail if not found.
4. Cek Stok: <span style="color: #ce9178;">if ($tool->stock < $qty) return Error</span>
5. Tentukan Peminjam: Admin yang inputin atau User login sendiri.
6. Buat Data Pinjam: Status diset 'pending' (butuh acc).
7. DB::commit(): "Simpan permanen ke Database."
</pre>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="p-3 bg-light rounded border h-100">
                        <h6 class="fw-bold text-primary">Kenapa pakai Transaction?</h6>
                        <p class="small text-muted">Bayangkan pas data pinjam dibuat, tiba-tiba server mati sebelum stok berkurang. <code>DB::beginTransaction</code> memastikan: <strong>"Berhasil semua atau Gagal semua"</strong>. Data nggak bakal menggantung.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-danger text-white fw-bold">
            Fungsi: returnTool() & MySQL Function (Denda)
        </div>
        <div class="card-body">
            <h5 class="fw-bold mb-3">Bagaimana Denda Dihitung?</h5>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="badge-logic p-3 rounded mb-3">
                        <strong>Langkah 1: MySQL Function <code>hitung_denda</code></strong>
                        <p class="small mb-0 mt-2">Database menghitung selisih hari antara <code>due_date</code> (tenggat) dan <code>return_date</code> (hari ini).</p>
                    </div>
                    <div class="code-block">
<pre style="font-size: 0.8rem;">
-- Rumus di MySQL --
SET v_selisih_hari = DATEDIFF(tgl_return, tgl_due);
IF v_selisih_hari > 0 THEN
   v_total_denda = (0.01 * harga) * selisih * qty;
END IF;
</pre>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="badge-logic p-3 rounded mb-3" style="background-color: #fff4f4; border-color: #dc3545; color: #dc3545;">
                        <strong>Langkah 2: Pemanggilan di Controller</strong>
                        <p class="small mb-0 mt-2">Laravel memanggil function tersebut menggunakan <code>DB::select</code>.</p>
                    </div>
                    <div class="code-block">
<pre style="font-size: 0.8rem;">
$result = DB::select("SELECT hitung_denda(?, ?, ?, ?)", [
    $loan->tool_id, $loan->qty, $loan->due_date, $returndate
]);
$denda = $result[0]->total_denda;
</pre>
                    </div>
                </div>
            </div>

            <div class="alert card-explanation mt-3 small">
                <strong>Penjelasan Alur Pengembalian:</strong>
                <ol>
                    <li>Sistem ambil data pinjaman berdasarkan ID.</li>
                    <li>Sistem nanya ke Database: <i>"Database, tolong hitungin denda buat alat ini dengan qty sekian, telat berapa hari?"</i></li>
                    <li>Hasil hitungan disimpan ke kolom <code>penalty</code> di tabel <code>loans</code>.</li>
                    <li>Status berubah jadi <code>return</code>.</li>
                    <li>Sistem menjalankan <code>Stored Procedure (sp_log_activity)</code> untuk mencatat riwayat ke tabel log.</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-dark text-white fw-bold">
            Filtering & Authorization (Hak Akses)
        </div>
        <div class="card-body">
            <table class="table table-sm table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Role</th>
                        <th>Method</th>
                        <th>Logic Simpel</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge bg-primary">Admin</span></td>
                        <td><code>adminIndex()</code></td>
                        <td>Lihat <strong>SEMUA</strong> data dengan <code>paginate(5)</code> (biar gak kepanjangan).</td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-success">Officer</span></td>
                        <td><code>petugasIndex()</code></td>
                        <td>Lihat data terbaru, tapi biasanya fokus ke <code>approve</code> dan <code>return</code>.</td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-info text-dark">Borrower</span></td>
                        <td><code>peminjamIndex()</code></td>
                        <td>Hanya ambil data di mana <code>borrower_id == Auth::id()</code>. <strong>Privasi Aman!</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="function-details">
    <h2 class="mt-5"><i class="bi bi-code-slash"></i> Bedah Fungsi LoanController</h2>
    <p class="text-muted">Penjelasan alur kerja (logic flow) beserta contoh kodenya.</p>

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 fw-bold"><i class="bi bi-save"></i> 1. function store()</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <p class="small text-muted"><strong>Tujuan:</strong> Input data pinjaman baru.</p>
                    <ul class="small">
                        <li><strong>Validation:</strong> Cek inputan wajib ada.</li>
                        <li><strong>Logic Check:</strong> Cek stok vs qty input.</li>
                        <li><strong>Auth::id():</strong> Ambil ID user yang login.</li>
                        <li><strong>Carbon:</strong> Set tenggat otomatis.</li>
                    </ul>
                </div>
                <div class="col-md-7">
                    <div class="code-block m-0" style="font-size: 0.75rem;">
<pre>
$request->validate(['tool_id' => 'required']);
$tool = tool::findOrFail($request->tool_id);
if ($tool->stock < $request->qty) return back();

loan::create([
    'borrower_id' => Auth::id(),
    'tool_id' => $tool->id,
    'due_date' => Carbon::now()->addDays(1),
    'status' => 'pending'
]);
</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0 fw-bold"><i class="bi bi-check-circle"></i> 2. function approve()</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <p class="small text-muted"><strong>Tujuan:</strong> Verifikasi barang keluar.</p>
                    <ul class="small">
                        <li><strong>Update Status:</strong> Ubah 'pending' ke 'borrow'.</li>
                        <li><strong>Traceability:</strong> Catat ID petugas yang ACC di kolom <code>approved_by</code>.</li>
                    </ul>
                </div>
                <div class="col-md-7">
                    <div class="code-block m-0" style="font-size: 0.75rem; border-left-color: #198754;">
<pre>
$loan = loan::findOrFail($id);
$loan->update([
    'status' => 'borrow',
    'approved_by' => Auth::user()->id,
]);
</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0 fw-bold"><i class="bi bi-arrow-return-left"></i> 3. function returnTool()</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <p class="small text-muted"><strong>Tujuan:</strong> Hitung denda & kembalikan stok.</p>
                    <ul class="small">
                        <li><strong>MySQL Function:</strong> Panggil <code>hitung_denda()</code> dari DB.</li>
                        <li><strong>Stored Procedure:</strong> Jalankan log aktivitas otomatis lewat DB.</li>
                    </ul>
                </div>
                <div class="col-md-7">
                    <div class="code-block m-0" style="font-size: 0.75rem; border-left-color: #dc3545;">
<pre>
$result = DB::select("SELECT hitung_denda(?, ?, ?, ?) as total", [
    $loan->tool_id, $loan->qty, $loan->due_date, Carbon::now()
]);
$loan->update([
    'return_date' => Carbon::now(),
    'penalty' => $result[0]->total,
    'status' => 'return'
]);
DB::statement("CALL sp_log_activity(?)", ["Alat returned"]);
</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0 fw-bold"><i class="bi bi-file-earmark-bar-graph"></i> 4. function report()</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <p class="small text-muted"><strong>Tujuan:</strong> Rekapitulasi data.</p>
                    <ul class="small">
                        <li><strong>When():</strong> Filter hanya jika request tanggal ada.</li>
                        <li><strong>Latest():</strong> Urutkan terbaru.</li>
                    </ul>
                </div>
                <div class="col-md-7">
                    <div class="code-block m-0" style="font-size: 0.75rem; border-left-color: #ffc107;">
<pre>
$query = loan::with(['borrower', 'tool']);
$query->when($request->start_date, function ($q) use ($request) {
    return $q->whereBetween('loan_date', 
        [$request->start_date, $request->end_date]);
});
$reports = $query->latest()->get();
</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        <footer>
            <p>© 2026 Ryuu Project</p>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
