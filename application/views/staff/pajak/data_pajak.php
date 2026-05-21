<div class="container mt-5">
  <h2 class="mb-4"><?= $title ?></h2>

  <?php if ($this->session->flashdata('popup_message')): 
    $msg = $this->session->flashdata('popup_message'); ?>
    <div class="alert alert-<?= $msg['tipe'] ?>"><?= $msg['pesan'] ?></div>
  <?php endif; ?>

  <!-- 🔽 Form Input Pajak -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="card-title">Form Input Pajak TER PPh 21</h5>
      <form method="POST" action="<?= base_url('Staff/DataPajakController/tambah') ?>">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="jenis_TER">Jenis TER</label>
            <select name="jenis_TER" id="jenis_TER" class="form-control" required>
              <option value="">-- Pilih Jenis TER --</option>
              <option value="TER A">TER A</option>
              <option value="TER B">TER B</option>
              <option value="TER C">TER C</option>
            </select>
          </div>
          <div class="form-group col-md-8">
            <label for="deskripsi_TER">Deskripsi TER</label>
            <select name="deskripsi_TER" id="deskripsi_TER" class="form-control" required>
              <option value="">-- Pilih Deskripsi TER --</option>
            </select>
          </div>
        </div>

        <div class="form-group" id="group_keterangan" style="display: none;">
          <label for="keterangan" style="font-size: 0.85rem;">Keterangan</label>
          <textarea name="keterangan" id="keterangan" class="form-control form-control-sm" rows="2" readonly style="font-size: 0.85rem;"></textarea>
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="range_awal">Range Penghasilan Awal</label>
            <input type="number" name="range_awal" id="range_awal" class="form-control" placeholder="Contoh: 0" required>
          </div>
          <div class="form-group col-md-4">
            <label for="range_akhir">Range Penghasilan Akhir</label>
            <input type="number" name="range_akhir" id="range_akhir" class="form-control" placeholder="Contoh: 5000000" required>
          </div>
          <div class="form-group col-md-4">
            <label for="tarif_TER">Tarif TER (%)</label>
            <input type="number" step="0.01" name="tarif_TER" id="tarif_TER" class="form-control" placeholder="Contoh: 5.00" required>
          </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">
          <i class="fas fa-save"></i> Simpan Data Pajak
        </button>
      </form>
    </div>
  </div>

  <!-- 🔍 Filter Pajak -->
  <div class="row mb-3">
    <div class="col-md-3">
      <select id="filterJenisTER" class="form-control">
        <option value="">-- Semua Jenis TER --</option>
        <option value="TER A">TER A</option>
        <option value="TER B">TER B</option>
        <option value="TER C">TER C</option>
      </select>
    </div>
    <div class="col-md-3">
      <select id="filterDeskripsiTER" class="form-control">
        <option value="">-- Semua Deskripsi --</option>
      </select>
    </div>
  </div>

  <!-- 🧾 Tabel Pajak -->
  <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
    <table class="table table-bordered table-hover">
      <thead class="thead-light text-center">
        <tr>
          <th>Jenis TER</th>
          <th>Deskripsi</th>
          <th>Keterangan</th>
          <th>Range Awal</th>
          <th>Range Akhir</th>
          <th>Tarif (%)</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="pajakTableBody" class="align-middle">
        <?php foreach ($pajak as $row): ?>
          <tr data-jenis="<?= $row->jenis_TER ?>" data-deskripsi="<?= $row->deskripsi_TER ?>">
            <td class="text-center"><?= $row->jenis_TER ?></td>
            <td class="text-center"><?= $row->deskripsi_TER ?></td>
            <td><?= $row->keterangan ?></td>
            <td>Rp. <?= number_format($row->range_awal, 0, ',', '.') ?></td>
            <td>Rp. <?= number_format($row->range_akhir, 0, ',', '.') ?></td>
            <td class="text-center"><?= $row->tarif_TER ?>%</td>
            <td class="text-center">
              <div class="d-flex justify-content-center">
                <a class="btn btn-sm btn-info" href="<?= base_url('Staff/DataPajakController/edit/'.$row->id_pajak) ?>">
                  <i class="fas fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-danger btn-delete" data-url="<?= base_url('Staff/DataPajakController/hapus/'.$row->id_pajak) ?>">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div id="confirmBox" class="popup-overlay" style="display: none;">
  <div class="popup-content">
    <p>Yakin ingin menghapus data ini?</p>
    <div class="text-end">
      <button id="cancelBtn" class="btn btn-secondary btn-sm">Batal</button>
      <button id="confirmDeleteBtn" class="btn btn-danger btn-sm">Hapus</button>
    </div>
  </div>
</div>



<!-- ✅ SCRIPT -->
<script>
  const deskripsiMap = {
    "TER A": ["TK0", "TK1", "K0"],
    "TER B": ["TK2", "TK3", "K1", "K2"],
    "TER C": ["K3"]
  };

  function isiDeskripsiDanKeterangan(selectedJenis) {
    const deskripsiSelect = document.getElementById('deskripsi_TER');
    const keteranganField = document.getElementById('keterangan');
    const keteranganGroup = document.getElementById('group_keterangan');

    deskripsiSelect.innerHTML = '<option value="">-- Pilih Deskripsi TER --</option>';
    keteranganField.value = '';
    keteranganGroup.style.display = 'none';

    const deskripsiList = deskripsiMap[selectedJenis];
    if (deskripsiList) {
      const gabungan = deskripsiList.join(', ');
      const option = document.createElement('option');
      option.value = gabungan;
      option.textContent = gabungan;
      deskripsiSelect.appendChild(option);
      deskripsiSelect.value = gabungan;

      if (selectedJenis === "TER A") {
        keteranganField.value = "Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)";
      } else if (selectedJenis === "TER B") {
        keteranganField.value = "Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)";
      } else if (selectedJenis === "TER C") {
        keteranganField.value = "Kawin (3 tanggungan)";
      }

      keteranganGroup.style.display = 'block';
    }
  }

  // FORM INPUT
  document.getElementById('jenis_TER').addEventListener('change', function () {
    isiDeskripsiDanKeterangan(this.value);
  });

  document.getElementById('filterJenisTER').addEventListener('change', function () {
  const jenis = this.value;
  const deskripsiDropdown = document.getElementById('filterDeskripsiTER');

  // Reset dropdown
  deskripsiDropdown.innerHTML = '<option value="">-- Semua Deskripsi --</option>';

    if (deskripsiMap[jenis]) {
      // 🔽 Gabungkan jadi 1 opsi saja
      const gabungan = deskripsiMap[jenis].join(', ');
      const option = document.createElement('option');
      option.value = gabungan;
      option.textContent = gabungan;
      deskripsiDropdown.appendChild(option);
    }

    filterTabel();
  });


  document.getElementById('filterDeskripsiTER').addEventListener('change', filterTabel);

  function filterTabel() {
    const selectedJenis = document.getElementById('filterJenisTER').value;
    const selectedDeskripsi = document.getElementById('filterDeskripsiTER').value;
    const rows = document.querySelectorAll('#pajakTableBody tr');

    rows.forEach(row => {
      const rowJenis = row.getAttribute('data-jenis');
      const rowDeskripsi = row.getAttribute('data-deskripsi');

      const cocokJenis = !selectedJenis || rowJenis === selectedJenis;
      const cocokDeskripsi = !selectedDeskripsi || rowDeskripsi === selectedDeskripsi;

      row.style.display = (cocokJenis && cocokDeskripsi) ? '' : 'none';
    });
  }

  // Auto-initialize saat halaman dibuka
  document.addEventListener('DOMContentLoaded', function () {
    const jenisTER = document.getElementById('jenis_TER').value;
    if (jenisTER) isiDeskripsiDanKeterangan(jenisTER);
  });

  document.addEventListener('DOMContentLoaded', () => {
  const deleteButtons = document.querySelectorAll('.btn-delete');

  deleteButtons.forEach(button => {
    button.addEventListener('click', e => {
      e.preventDefault(); // cegah default behavior kalau pakai <button>
      const url = button.getAttribute('data-url');

      if (!url) {
        console.error('URL penghapusan tidak ditemukan.');
        return;
      }

      const konfirmasi = confirm('Yakin ingin menghapus data ini?');

      if (konfirmasi) {
        // Redirect ke URL penghapusan
        window.location.href = url;
      }
    });
  });
});

</script>
