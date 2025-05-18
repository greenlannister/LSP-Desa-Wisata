<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0 text-center"><i class="fas fa-calendar-check me-2"></i>Form Reservasi Paket Wisata</h4>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('reservasi.store') }}" enctype="multipart/form-data" id="reservasiForm">
                        @csrf
                        
                        <!-- Data Paket Wisata (Hidden) -->
                        <input type="hidden" name="id_paket_wisata" value="{{ $paket_wisata->id }}">
                        <div class="mb-4 text-center bg-light p-3 rounded">
                            <h5 class="text-primary">{{ $paket_wisata->nama_paket }}</h5>
                            <div class="d-flex justify-content-center gap-4">
                                <p class="mb-0"><i class="fas fa-user me-2 text-secondary"></i>Rp {{ number_format($paket_wisata->harga_per_pack, 0, ',', '.') }} /orang</p>
                                <p class="mb-0"><i class="fas fa-users me-2 text-secondary"></i>Maks. {{ $paket_wisata->max_kapasitas }} orang</p>
                            </div>
                        </div>
                        
                        <!-- Data Pelanggan (Auto) -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label fw-bold">Nama Pelanggan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" value="{{ $pelanggan->nama_pelanggan }}" readonly>
                                </div>
                                <input type="hidden" name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}">
                                <input type="hidden" name="id_pelanggan" value="{{ $pelanggan->id }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                                </div>
                                <input type="hidden" name="email" value="{{ $user->email }}">
                            </div>
                        </div>
                        
                        <!-- Tanggal Reservasi -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="tgl_mulai_reservasi" class="form-label fw-bold">Tanggal Mulai</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-calendar-day"></i></span>
                                    <input type="datetime-local" class="form-control @error('tgl_mulai_reservasi') is-invalid @enderror" 
                                           id="tgl_mulai_reservasi" name="tgl_mulai_reservasi" required min="{{ date('Y-m-d\TH:i') }}">
                                </div>
                                @error('tgl_mulai_reservasi')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tgl_selesai_reservasi" class="form-label fw-bold">Tanggal Selesai</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-calendar-check"></i></span>
                                    <input type="datetime-local" class="form-control @error('tgl_selesai_reservasi') is-invalid @enderror" 
                                           id="tgl_selesai_reservasi" name="tgl_selesai_reservasi" required>
                                </div>
                                @error('tgl_selesai_reservasi')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Tambahkan ini di bawah section tanggal untuk menampilkan error kapasitas -->
                        @if($errors->has('jumlah_peserta'))
                            <div class="alert alert-danger mt-3">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ $errors->first('jumlah_peserta') }}
                            </div>
                        @endif
                        
                        <!-- Jumlah Peserta -->
                        <div class="mb-4">
                            <label for="jumlah_peserta" class="form-label fw-bold">Jumlah Peserta</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-users"></i></span>
                                <input type="number" class="form-control" id="jumlah_peserta" 
                                       name="jumlah_peserta" min="1" value="1" required
                                       max="{{ $paket_wisata->max_kapasitas }}">
                                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('jumlah_peserta').stepUp()">+</button>
                                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('jumlah_peserta').stepDown()">-</button>
                            </div>
                            <small class="text-muted">Maksimal {{ $paket_wisata->max_kapasitas }} orang</small>
                        </div>
                        
                        <!-- Pilihan Diskon -->
                        <div class="mb-4">
                            <label for="id_diskon" class="form-label fw-bold">Diskon (Jika ada)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                                <select class="form-select" id="id_diskon" name="id_diskon">
                                    <option value="">Tidak ada diskon</option>
                                    @foreach($diskons as $diskon)
                                    <option value="{{ $diskon->id }}" data-persentase="{{ $diskon->persentase_diskon }}">
                                        {{ $diskon->nama_diskon }} - {{ $diskon->persentase_diskon }}% 
                                        (Berlaku sampai {{ $diskon->tanggal_berakhir }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <!-- Jenis Pembayaran -->
                        <div class="mb-4">
                            <label for="id_jenis_pembayaran" class="form-label fw-bold">Jenis Pembayaran</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-credit-card"></i></span>
                                <select class="form-select" id="id_jenis_pembayaran" name="id_jenis_pembayaran" required>
                                    <option value="">Pilih Jenis Pembayaran</option>
                                    @foreach($jenis_pembayarans as $jenis)
                                    <option value="{{ $jenis->id }}" data-nomor="{{ $jenis->nomor_tf }}">
                                        {{ $jenis->jenis_pembayaran }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <!-- Info Nomor Rekening -->
                        <div class="alert alert-info mb-4 d-none" id="nomorRekeningInfo">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2 fs-4"></i>
                                <div>
                                    <strong>Nomor Rekening:</strong> 
                                    <span id="nomorRekeningText" class="fw-bold"></span>
                                    <p class="mb-0 mt-1">Silahkan transfer sesuai total bayar ke nomor rekening di atas.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Di bagian rincian pembayaran -->
                        <div class="card mb-4 border-primary">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0 text-primary"><i class="fas fa-receipt me-2"></i>Rincian Pembayaran</h5>
                            </div>
                            <div class="card-body p-0">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="border-0">Harga per orang per hari</td>
                                            <td class="border-0 text-end">Rp <span id="harga-display">0</span></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Peserta</td>
                                            <td class="text-end"><span id="jumlah-peserta-display">1</span> orang</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Hari</td>
                                            <td class="text-end"><span id="jumlah-hari-display">1</span> hari</td>
                                        </tr>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="text-end">Rp <span id="subtotal-display">0</span></td>
                                        </tr>
                                        <tr>
                                            <td>Diskon (<span id="persentase-diskon-display">0</span>%)</td>
                                            <td class="text-end">- Rp <span id="diskon-display">0</span></td>
                                        </tr>
                                        <tr class="table-primary">
                                            <th class="border-0">Total Bayar</th>
                                            <th class="border-0 text-end">Rp <span id="total-bayar-display">0</span></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Bukti Transfer -->
                        <div class="mb-4">
                            <label for="bukti_tf" class="form-label fw-bold">Upload Bukti Transfer</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="bukti_tf" name="bukti_tf" required>
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </button>
                            </div>
                            <small class="text-muted">Format: JPEG, PNG (Maksimal 2MB)</small>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg py-3">
                                <i class="fas fa-paper-plane me-2"></i>Proses Reservasi
                            </button>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn btn-outline-danger btn-lg py-3" onclick="window.history.back()">
                                <i class="fas fa-times-circle me-2"></i> Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pastikan variabel ini terdefinisi
    const paketHarga = {{ $paket_wisata->harga_per_pack ?? 0 }};
    
    // Elemen yang diperlukan
    const jumlahPeserta = document.getElementById('jumlah_peserta');
    const diskonSelect = document.getElementById('id_diskon');
    const tglMulaiInput = document.getElementById('tgl_mulai_reservasi');
    const tglSelesaiInput = document.getElementById('tgl_selesai_reservasi');
    
    // Fungsi format rupiah
    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
    // Fungsi hitung jumlah hari
    function hitungJumlahHari() {
        if (tglMulaiInput.value && tglSelesaiInput.value) {
            const tglMulai = new Date(tglMulaiInput.value);
            const tglSelesai = new Date(tglSelesaiInput.value);
            const diffTime = Math.abs(tglSelesai - tglMulai);
            return Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        }
        return 1;
    }
    
    // Fungsi utama hitung harga
    function hitungHarga() {
        const peserta = parseInt(jumlahPeserta.value) || 1;
        const hari = hitungJumlahHari();
        const persentaseDiskon = diskonSelect.selectedOptions[0]?.dataset.persentase || 0;
        
        const subtotal = paketHarga * peserta * hari;
        const diskon = subtotal * (persentaseDiskon / 100);
        const totalBayar = subtotal - diskon;
        
        // Update tampilan
        document.getElementById('harga-display').textContent = formatRupiah(paketHarga);
        document.getElementById('jumlah-peserta-display').textContent = peserta;
        document.getElementById('jumlah-hari-display').textContent = hari;
        document.getElementById('subtotal-display').textContent = formatRupiah(subtotal);
        document.getElementById('persentase-diskon-display').textContent = persentaseDiskon;
        document.getElementById('diskon-display').textContent = formatRupiah(diskon);
        document.getElementById('total-bayar-display').textContent = formatRupiah(totalBayar);
    }
    
    // Pasang event listeners
    jumlahPeserta.addEventListener('input', hitungHarga);
    diskonSelect.addEventListener('change', hitungHarga);
    tglMulaiInput.addEventListener('change', function() {
        if (this.value) {
            const minDate = new Date(this.value);
            minDate.setDate(minDate.getDate() + 1);
            tglSelesaiInput.min = this.value;
            
            if (!tglSelesaiInput.value || new Date(tglSelesaiInput.value) < minDate) {
                tglSelesaiInput.value = minDate.toISOString().slice(0, 16);
            }
        }
        hitungHarga();
    });
    tglSelesaiInput.addEventListener('change', hitungHarga);
    
    // Hitung harga awal
    hitungHarga();
});
</script>