<div id="deleteConfirmBackdrop" class="alertify-backdrop" style="display: none;">
  <div class="alertify alertify-error">
    <div class="alertify-inner">
      <p style="font-size: 18px; margin-bottom: 20px;">Yakin ingin menghapus data ini?</p>
      <button class="alertify-button alertify-button-ok" id="deleteYesBtn">Hapus</button>
      <button class="alertify-button alertify-button-cancel" id="deleteNoBtn">Batal</button>
    </div>
  </div>
</div>

<style>
.alertify-backdrop {
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

.alertify {
  background: #fff;
  border: 5px solid rgba(0,0,0,.7);
  border-radius: 8px;
  box-shadow: 0 3px 10px rgba(0,0,0,.3);
  width: 350px;
  max-width: 90%;
  transition: all 0.4s ease;
}

.alertify-inner {
  padding: 25px;
  text-align: center;
}

.alertify-button {
  border-radius: 4px;
  color: #fff;
  font-weight: bold;
  padding: 10px 20px;
  text-decoration: none;
  margin: 5px;
  cursor: pointer;
  border: 1px solid;
}

.alertify-button-ok {
  background-color: #FE1A00;
  border-color: #D83526;
}
.alertify-button-ok:hover {
  background-color: #d91a00;
}

.alertify-button-cancel {
  background-color: #6c757d;
  border-color: #565e64;
}
.alertify-button-cancel:hover {
  background-color: #565e64;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteBackdrop = document.getElementById('deleteConfirmBackdrop');
    const deleteYesBtn = document.getElementById('deleteYesBtn');
    const deleteNoBtn = document.getElementById('deleteNoBtn');
    let deleteUrl = '';

    document.querySelectorAll('.btn-delete').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            deleteUrl = this.getAttribute('data-url');
            deleteBackdrop.style.display = 'flex';
        });
    });

    deleteYesBtn.addEventListener('click', function() {
        window.location.href = deleteUrl;
    });

    deleteNoBtn.addEventListener('click', function() {
        deleteBackdrop.style.display = 'none';
    });
});
</script>
