<div class="container mt-5">
  <h3 class="text-center mb-4"><?= $title ?></h3>

  <form action="<?= base_url('Staff/DataPajakController/update') ?>" method="POST">
    <input type="hidden" name="id_pajak" value="<?= $pajak->id_pajak ?>">

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

        <!-- Keterangan (otomatis) -->
        <div class="form-group" id="group_keterangan" style="display: none;">
          <label for="keterangan" style="font-size: 0.85rem;">Keterangan</label>
          <textarea name="keterangan" id="keterangan" class="form-control form-control-sm" rows="2" readonly
            style="font-size: 0.85rem;"></textarea>
        </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="range_awal">Range Penghasilan Awal</label>
        <input type="number" name="range_awal" class="form-control" value="<?= $pajak->range_awal ?>" required>
      </div>
      <div class="form-group col-md-6">
        <label for="range_akhir">Range Penghasilan Akhir</label>
        <input type="number" name="range_akhir" class="form-control" value="<?= $pajak->range_akhir ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label for="tarif_TER">Tarif TER (%)</label>
      <input type="number" step="0.01" name="tarif_TER" class="form-control" value="<?= $pajak->tarif_TER ?>" required>
    </div>

    <div class="form-group text-right">
      <a href="<?= base_url('Staff/DataPajakController') ?>" class="btn btn-secondary">Kembali</a>
      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
  </form>

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

      // Tambahkan keterangan sesuai jenis TER
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

  // Event: saat jenis_TER berubah
  document.getElementById('jenis_TER').addEventListener('change', function () {
    isiDeskripsiDanKeterangan(this.value);
  });

  // Saat halaman dimuat
  document.addEventListener('DOMContentLoaded', function () {
    const jenisTER = document.getElementById('jenis_TER').value;
    if (jenisTER) {
      isiDeskripsiDanKeterangan(jenisTER);
    }
  });
</script>
</div>
