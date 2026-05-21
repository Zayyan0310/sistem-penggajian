<?php
$type = $this->session->flashdata('popup_type'); // success / error / info
$message = $this->session->flashdata('popup_message'); // pesan teks

if (!$type) $type = 'info';
if (!$message) $message = 'Operasi berhasil!';
?>

<div class="alertify-backdrop">
  <div class="alertify alertify-<?php echo $type; ?>">
    <div class="alertify-inner">
      <p style="font-size: 18px; margin-bottom: 20px;"><?php echo $message; ?></p>
      <button class="alertify-button alertify-button-ok" id="popupOkBtn">OK</button>
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
  opacity: 1;
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
  margin-top: 15px;
  cursor: pointer;
  border: 1px solid;
}

.alertify-success .alertify-button {
  background-color: #5CB811;
  border-color: #3B7808;
}
.alertify-success .alertify-button:hover {
  background-color: #4da50f;
}

.alertify-error .alertify-button {
  background-color: #FE1A00;
  border-color: #D83526;
}
.alertify-error .alertify-button:hover {
  background-color: #d91a00;
}

.alertify-info .alertify-button {
  background-color: #17a2b8;
  border-color: #117a8b;
}
.alertify-info .alertify-button:hover {
  background-color: #117a8b;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const popupBackdrop = document.querySelector('.alertify-backdrop');
    const okBtn = document.getElementById('popupOkBtn');

    okBtn.addEventListener('click', function() {
        popupBackdrop.style.opacity = '0';
        setTimeout(() => popupBackdrop.remove(), 400);
    });

    // Optional: auto-close after 3 seconds
    setTimeout(() => {
        if (popupBackdrop) {
            popupBackdrop.style.opacity = '0';
            setTimeout(() => popupBackdrop.remove(), 400);
        }
    }, 3000);
});
</script>
