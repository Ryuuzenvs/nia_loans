@extends('app')

@section('content')
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
<div class="card shadow-sm">
    <div class="card-body p-4">
        <h3 class="text-center mb-4">Input Peminjaman Baru (Admin)</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('pinjam.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Pilih Peminjam</label>
                <select name="user_id" class="form-control" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->username }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
    <label class="form-label">Pilih Alat</label>
    <select name="tool_id" id="tool_id" class="form-control" required onchange="updateMaxQty()">
        <option value="" data-stock="0">-- Pilih Alat --</option>
        @foreach($tools as $t)
            <option value="{{ $t->id }}" data-stock="{{ $t->stock }}">
                {{ $t->name_tools }} (Stok: {{ $t->stock }})
            </option>
        @endforeach
    </select>
</div>

            <div class="mb-3">
    <label class="form-label">Jumlah Pinjam (Qty)</label>
    <input type="number" name="qty" id="qty" class="form-control" 
           min="1" value="1" required 
           placeholder="Masukkan jumlah...">
    <small class="text-muted" id="stock-info">Pilih alat untuk melihat batas stok.</small>
</div>

            <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
            <a href="{{ route('admin.loans.index') }}" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</div>
<script>
function updateMaxQty() {
    const toolSelect = document.getElementById('tool_id');
    const qtyInput = document.getElementById('qty');
    const stockInfo = document.getElementById('stock-info');
    
    // Ambil data-stock dari option yang dipilih
    const selectedOption = toolSelect.options[toolSelect.selectedIndex];
    const stock = selectedOption.getAttribute('data-stock');
    
    if (stock) {
        qtyInput.max = stock; // Set batas max sesuai stok
        stockInfo.innerText = "Maksimal pinjam: " + stock;
        
        // Jika qty saat ini melebihi stok baru, turunkan ke angka stok
        if (parseInt(qtyInput.value) > parseInt(stock)) {
            qtyInput.value = stock;
        }
    }
}
</script>
@endsection
