/* ── ANIMASI ── */

function animateCounter(el, target, duration) {
  const start = performance.now();

  function step(now) {
    const elapsed  = now - start;
    const progress = Math.min(elapsed / duration, 1);
    const eased    = 1 - Math.pow(1 - progress, 3);

    el.textContent = Math.floor(eased * target).toLocaleString('id-ID');

    if (progress < 1) requestAnimationFrame(step);
  }

  requestAnimationFrame(step);
}

const statNumbers = document.querySelectorAll('.stat-number');

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el     = entry.target;
      const target = parseInt(el.getAttribute('data-target'));
      animateCounter(el, target, 1800);
      observer.unobserve(el);
    }
  });
}, { threshold: 0.3 });

statNumbers.forEach(el => observer.observe(el));
document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("authModal");
  const closeModalBtn = document.getElementById("closeModalBtn");
  if (!modal || !closeModalBtn) return;
  
  // Ambil semua tombol hero dan donasi di halaman
  const triggerButtons = document.querySelectorAll(".btn-hero, .btn-donasi");

  // Fungsi untuk buka pop-up
  triggerButtons.forEach(button => {
    button.addEventListener("click", function (e) {
      e.preventDefault(); // Mencegah reload atau navigasi dadakan
      modal.classList.add("show");
    });
  });

  // Fungsi untuk tutup pop-up lewat tombol 'X'
  closeModalBtn.addEventListener("click", function () {
    modal.classList.remove("show");
  });

  // Fungsi untuk tutup pop-up jika user klik area luar kotak putih
  modal.addEventListener("click", function (e) {
    if (e.target === modal) {
      modal.classList.remove("show");
    }
  });
});
/* ── SLIDER ── */
function initSlider(sliderId, prevId, nextId, dotsId) {
  const slider  = document.getElementById(sliderId);
  const wrap    = slider?.parentElement;
  const outer   = wrap?.parentElement;
  const btnPrev = document.getElementById(prevId);
  const btnNext = document.getElementById(nextId);
  const dotsBox = dotsId ? document.getElementById(dotsId) : null;

  if (!slider || !wrap || !outer || !btnPrev || !btnNext) return;

  const gap = 24;
  let offset    = 0;   /* posisi geseran sekarang, dalam pixel */
  let maxScroll = 0;
  let pageStep  = 0;   /* lebar satu "halaman" = sejumlah kartu yang muat */

  function getCardStep() {
    const card = slider.children[0];
    return card ? card.offsetWidth + gap : 0;
  }

  function getMaxScroll() {
    /* lebar area tampil = clientWidth dikurangi padding kiri-kanan wrap */
    const cs       = getComputedStyle(wrap);
    const padX     = (parseFloat(cs.paddingLeft) || 0) + (parseFloat(cs.paddingRight) || 0);
    const viewport = wrap.clientWidth - padX;
    const overflow = slider.scrollWidth - viewport;

    return Math.max(0, overflow);
  }

  /* berapa kartu yang muat dalam satu layar → menentukan jumlah titik */
  function getPageStep() {
    const step = getCardStep();
    if (!step) return 0;
    const perView = Math.max(1, Math.floor((wrap.clientWidth + gap) / step));
    return perView * step;
  }

  function getPageCount() {
    if (maxScroll <= 0 || pageStep <= 0) return 1;
    return Math.ceil(maxScroll / pageStep) + 1;
  }

  function getActivePage() {
    const count = getPageCount();
    if (pageStep <= 0 || count <= 1) return 0;

    /* kalau sudah mentok kanan → titik terakhir */
    if (offset >= maxScroll - 1) return count - 1;

    /* selain mentok, jangan klaim titik terakhir dulu */
    return Math.min(Math.round(offset / pageStep), count - 2);
  }

  function clamp(px) {
    return Math.max(0, Math.min(px, maxScroll));
  }

  /* snap ke kelipatan lebar kartu terdekat → langkah selalu rata */
  function snap(px) {
    const step = getCardStep();
    if (!step) return clamp(px);
    return clamp(Math.round(px / step) * step);
  }

  /* bikin ulang titik sesuai jumlah halaman (dipanggil saat init & resize) */
  function buildDots() {
    if (!dotsBox) return;
    const count = getPageCount();
    dotsBox.innerHTML = '';
    if (count <= 1) return; /* ga perlu titik kalau muat semua */

    for (let i = 0; i < count; i++) {
      const dot = document.createElement('button');
      dot.className = 'slider-dot';
      dot.type = 'button';
      dot.setAttribute('aria-label', `Ke halaman ${i + 1}`);
      dot.addEventListener('click', () => setOffset(i * pageStep, true));
      dotsBox.appendChild(dot);
    }
  }

  function updateDots() {
    if (!dotsBox) return;
    const active = getActivePage();
    [...dotsBox.children].forEach((dot, i) =>
      dot.classList.toggle('active', i === active)
    );
  }

  function render() {
    slider.style.transform = `translateX(-${offset}px)`;

    const atStart = offset <= 0.5;
    const atEnd   = maxScroll === 0 || offset >= maxScroll - 0.5;

    outer.classList.toggle('fade-left', !atStart);
    outer.classList.toggle('fade-right', !atEnd);

    btnPrev.style.opacity       = atStart ? '0.3' : '1';
    btnPrev.style.pointerEvents = atStart ? 'none' : 'auto';
    btnNext.style.opacity       = atEnd   ? '0.3' : '1';
    btnNext.style.pointerEvents = atEnd   ? 'none' : 'auto';

    updateDots();
  }

  /* pindah ke posisi tertentu; animate=true pakai transisi CSS, false = langsung */
  function setOffset(px, animate) {
    maxScroll = getMaxScroll();
    pageStep  = getPageStep();
    offset = clamp(px);
    slider.style.transition = animate ? '' : 'none';
    render();
  }

  /* ── tombol panah: geser satu kartu ── */
  btnNext.addEventListener('click', () => setOffset(snap(offset + getCardStep()), true));
  btnPrev.addEventListener('click', () => setOffset(snap(offset - getCardStep()), true));

  /* ── drag (mouse) + swipe (touch) lewat Pointer Events ── */
  let dragging = false;
  let startX = 0;
  let startOffset = 0;
  let moved = 0;

  wrap.addEventListener('pointerdown', (e) => {
    if (e.button && e.button !== 0) return;
    dragging    = true;
    startX      = e.clientX;
    startOffset = offset;
    moved       = 0;
    maxScroll   = getMaxScroll();
    slider.style.transition = 'none';
    wrap.setPointerCapture?.(e.pointerId);
    wrap.classList.add('dragging');
  });

  wrap.addEventListener('pointermove', (e) => {
    if (!dragging) return;
    const dx = e.clientX - startX;
    moved = Math.abs(dx);
    offset = clamp(startOffset - dx);
    slider.style.transform = `translateX(-${offset}px)`;
  });

  function endDrag(e) {
    if (!dragging) return;
    dragging = false;
    wrap.classList.remove('dragging');
    wrap.releasePointerCapture?.(e.pointerId);
    setOffset(snap(offset), true); /* lepas → snap ke kartu terdekat */
  }
  wrap.addEventListener('pointerup', endDrag);
  wrap.addEventListener('pointercancel', endDrag);

  /* kalau habis nge-drag, jangan sampai memicu klik di kartu */
  wrap.addEventListener('click', (e) => {
    if (moved > 6) { e.preventDefault(); e.stopPropagation(); }
  }, true);

  /* matikan ghost-drag bawaan gambar */
  slider.querySelectorAll('img').forEach(img => (img.draggable = false));

  window.addEventListener('resize', () => {
    maxScroll = getMaxScroll();
    pageStep  = getPageStep();
    buildDots();
    setOffset(snap(offset), false);
  });

  setOffset(0, false);
  buildDots();
  updateDots();
}

window.addEventListener('DOMContentLoaded', () => {
  const counterEl = document.getElementById('counter-users');
  if (counterEl) {
    setTimeout(() => animateCounter(counterEl, 1500, 1800), 900);
  }

  initSlider('heroSlider', 'heroPrev', 'heroNext', 'heroDots');
  initSlider('testiSlider', 'testiPrev', 'testiNext', 'testiDots');
});

/* ── SCROLL REVEAL + PROGRESS BAR ── */
window.addEventListener('DOMContentLoaded', () => {
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* progress bar mulai dari 0, diisi saat kartunya terlihat */
  const fills = document.querySelectorAll('.progress-fill');
  fills.forEach(f => {
    f.dataset.target = f.style.width || '0%';
    if (!reduceMotion) f.style.width = '0';
  });

  const revealEls = [...document.querySelectorAll(
    '.section-header, .donation-card, .katalog-item, .stat-item, ' +
    '#para-hero .slider-outer, #testimoni .slider-outer'
  )];
  revealEls.forEach(el => el.classList.add('reveal'));

  /* beri jeda bertahap (stagger) untuk elemen dalam grid yang sama */
  const stagger = (selector, step, cap = 6) => {
    document.querySelectorAll(selector).forEach((el, i) => {
      el.style.setProperty('--reveal-delay', `${(i % cap) * step}s`);
    });
  };
  stagger('.donation-card', 0.1);
  stagger('.stat-item', 0.1);
  stagger('.katalog-item', 0.05, 8);

  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el = entry.target;
      el.classList.add('visible');

      /* kalau ini kartu donasi, isi progress bar-nya */
      const fill = el.querySelector && el.querySelector('.progress-fill');
      if (fill && fill.dataset.target) fill.style.width = fill.dataset.target;

      io.unobserve(el);
    });
  }, { threshold: 0.15 });

  revealEls.forEach(el => io.observe(el));
});

/* ── LIGHTBOX KATALOG PRODUK ── */
window.addEventListener('DOMContentLoaded', () => {
  const items = document.querySelectorAll('.katalog-item');
  if (!items.length) return;

  /* buat elemen lightbox sekali saja */
  const lb = document.createElement('div');
  lb.className = 'lightbox';
  lb.innerHTML =
    '<div class="lightbox-content">' +
      '<button class="lightbox-close" aria-label="Tutup">&times;</button>' +
      '<img class="lightbox-img" src="" alt="" />' +
      '<span class="lightbox-caption"></span>' +
    '</div>';
  document.body.appendChild(lb);

  const lbImg     = lb.querySelector('.lightbox-img');
  const lbCaption = lb.querySelector('.lightbox-caption');
  const lbClose   = lb.querySelector('.lightbox-close');

  function openLightbox(src, label, alt) {
    lbImg.src = src;
    lbImg.alt = alt || label || '';
    lbCaption.textContent = label || '';
    lb.classList.add('open');
    document.body.style.overflow = 'hidden'; /* kunci scroll di belakang */
  }

  function closeLightbox() {
    lb.classList.remove('open');
    document.body.style.overflow = '';
  }

  items.forEach(item => {
    item.addEventListener('click', () => {
      const img   = item.querySelector('img');
      const label = item.querySelector('.katalog-label');
      if (!img) return;
      openLightbox(img.src, label ? label.textContent.trim() : '', img.alt);
    });
  });

  lbClose.addEventListener('click', closeLightbox);
  lb.addEventListener('click', (e) => { if (e.target === lb) closeLightbox(); });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && lb.classList.contains('open')) closeLightbox();
  });
});
document.addEventListener("DOMContentLoaded", function () {
  const verifyBanner = document.getElementById("verifyBanner");
  const closeBannerBtn = document.getElementById("closeBannerBtn");

  if (closeBannerBtn && verifyBanner) {
    closeBannerBtn.addEventListener("click", function () {
      verifyBanner.style.transition = "all 0.3s ease";
      verifyBanner.style.opacity = "0";
      verifyBanner.style.transform = "translateY(-10px)";
      
      setTimeout(() => {
        verifyBanner.style.display = "none";
      }, 300);
    });
  }
});
document.addEventListener('DOMContentLoaded', () => {
  const tableBody = document.getElementById('historyTableBody');
  if (!tableBody) return;

  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const pageDisplay = document.getElementById('pageDisplay');
  if (!prevBtn || !nextBtn || !pageDisplay) return;

  const rows = Array.from(tableBody.querySelectorAll('tr'));

  let currentPage = 1;
  const rowsPerPage = 5;

  function updatePagination() {
    pageDisplay.textContent = currentPage;

    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    rows.forEach((row, index) => {
      row.style.display = (index >= start && index < end) ? '' : 'none';
    });

    prevBtn.disabled = (currentPage === 1);
    nextBtn.disabled = (end >= rows.length);
  }

  prevBtn.addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      updatePagination();
    }
  });

  nextBtn.addEventListener('click', () => {
    if ((currentPage * rowsPerPage) < rows.length) {
      currentPage++;
      updatePagination();
    }
  });

  updatePagination();
});
/* ── INISIASI: tombol CTA menuju halaman verifikasi ── */
window.addEventListener('DOMContentLoaded', () => {
  ['btnMulaiPengajuan', 'btnMulaiPengajuan2', 'btnAjukanUlang'].forEach(id => {
    document.getElementById(id)?.addEventListener('click', () => {
      window.location.href = '/verify';
    });
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const formElement = document.getElementById('verificationForm');
  if (!formElement) return;

  const config = window.verifyDraftConfig || {};
  let currentStep = config.errorStep || 1;
  const totalSteps = 4;
  const draftFiles = { ...(config.draftFiles || {}) };

  const btnNext = document.getElementById('btnFormNext');
  const btnBack = document.getElementById('btnFormBack');
  const progressBarFill = document.getElementById('progressBarFill');
  const draftIndicator = document.getElementById('draftSaveIndicator');
  const draftFieldNames = [
    'account_type',
    'address',
    'phone_number',
    'ktp_number',
    'bank_name',
    'bank_account_number',
    'bank_account_name',
  ];

  let draftSaveTimer = null;

  function setDraftIndicator(text, color = '#b0b7c3') {
    if (!draftIndicator) return;
    draftIndicator.textContent = text;
    draftIndicator.style.color = color;
    draftIndicator.style.display = text ? 'inline' : 'none';
  }

  function collectDraftPayload() {
    const data = {};
    draftFieldNames.forEach((name) => {
      const el = formElement.querySelector(`[name="${name}"]`);
      if (el) data[name] = el.value;
    });
    return data;
  }

  function saveDraft() {
    setDraftIndicator('Menyimpan draf...', '#21A3FF');

    fetch(config.draftUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': config.csrf,
      },
      body: JSON.stringify(collectDraftPayload()),
    })
      .then(async (res) => {
        if (!res.ok) {
          const body = await res.json().catch(() => ({}));
          throw new Error(body.message || 'Gagal menyimpan draf.');
        }
        setDraftIndicator('Draf tersimpan', '#22c55e');
        setTimeout(() => setDraftIndicator(''), 2500);
      })
      .catch((err) => {
        setDraftIndicator(err.message || 'Gagal menyimpan draf', '#ef4444');
      });
  }

  function scheduleDraftSave() {
    clearTimeout(draftSaveTimer);
    draftSaveTimer = setTimeout(saveDraft, 700);
  }

  draftFieldNames.forEach((name) => {
    const el = formElement.querySelector(`[name="${name}"]`);
    el?.addEventListener('input', scheduleDraftSave);
    el?.addEventListener('change', scheduleDraftSave);
  });

  function updateDraftFileHint(field, filename) {
    const upload = formElement.querySelector(`input[name="${field}"]`)?.closest('.custom-file-upload');
    if (!upload) return;

    let hint = upload.querySelector(`.draft-file-hint[data-field="${field}"]`);
    if (!hint) {
      hint = document.createElement('span');
      hint.className = 'draft-file-hint';
      hint.dataset.field = field;
      hint.style.cssText = 'display:block;margin-top:6px;font-size:.85rem;color:#22c55e;';
      upload.appendChild(hint);
    }

    hint.textContent = filename ? `Tersimpan: ${filename}` : '';
    hint.style.display = filename ? 'block' : 'none';
  }

  function restoreDraftFileUi() {
    Object.entries(draftFiles).forEach(([field, filename]) => {
      if (!filename) return;

      const input = formElement.querySelector(`input[name="${field}"]`);
      if (!input) return;

      input.removeAttribute('required');

      const textMain = input.parentElement?.querySelector('.upload-text-main');
      if (textMain) {
        if (!textMain.dataset.defaultText) {
          textMain.dataset.defaultText = textMain.textContent;
        }
        textMain.textContent = `Tersimpan: ${filename}`;
        textMain.style.color = '#22c55e';
      }

      updateDraftFileHint(field, filename);
    });
  }

  async function uploadDraftFile(field, file) {
    const fd = new FormData();
    fd.append('field', field);
    fd.append('file', file);
    fd.append('_token', config.csrf);

    const res = await fetch(config.draftFileUrl, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': config.csrf,
      },
      body: fd,
    });

    const body = await res.json().catch(() => ({}));
    if (!res.ok) {
      throw new Error(body.message || 'Gagal mengunggah file.');
    }

    return body;
  }

  // ── UPDATE PROGRESS FORM MULTI-STEP ──
  function updateFormProgress() {
    for (let i = 1; i <= totalSteps; i++) {
      const panel = document.getElementById(`stepPanel${i}`);
      const node = document.getElementById(`node${i}`);
      const label = document.getElementById(`labelText${i}`);

      if (i === currentStep) {
        if (panel) panel.classList.add('active');
        if (node) node.classList.add('active');
        if (label) label.classList.add('active');
      } else {
        if (panel) panel.classList.remove('active');
        if (node) {
          if (i < currentStep) {
            node.classList.add('completed');
            node.classList.remove('active');
          } else {
            node.classList.remove('completed', 'active');
          }
        }
        if (label && i > currentStep) label.classList.remove('active');
      }
    }

    if (progressBarFill) {
      const track = document.querySelector('.form-steps-track');
      const trackWidth = track.offsetWidth;
      const usableWidth = trackWidth - 40;
      const fraction = (currentStep - 1) / (totalSteps - 1);
      progressBarFill.style.width = `${usableWidth * fraction}px`;
    }

    if (btnBack) {
      btnBack.style.visibility = (currentStep === 1) ? 'hidden' : 'visible';
    }

    if (btnNext) {
      if (currentStep === totalSteps) {
        btnNext.textContent = 'Ajukan Verifikasi';
        btnNext.style.background = '#FFAA00';
      } else {
        btnNext.textContent = 'Lanjut';
        btnNext.style.background = '#21A3FF';
      }
    }
  }

  // ── FUNGSI VALIDASI PER STEP ──
  function validateCurrentStepInputs() {
    const currentPanel = document.getElementById(`stepPanel${currentStep}`);
    if (!currentPanel) return true;

    const requiredInputs = currentPanel.querySelectorAll('input[required], select[required]');
    let isValid = true;

    requiredInputs.forEach((input) => {
      if (input.type === 'file') {
        const fieldName = input.name;
        if (draftFiles[fieldName] || input.files?.length) {
          return;
        }
      }

      if (!input.value || input.value.trim() === '') {
        isValid = false;
        input.style.border = '1.5px solid #ef4444';

        input.addEventListener('input', () => {
          input.style.border = '1.5px solid rgba(33, 163, 255, 0.15)';
        }, { once: true });
        input.addEventListener('change', () => {
          input.style.border = '1.5px solid rgba(33, 163, 255, 0.15)';
        }, { once: true });
      }
    });

    const requiredFilesByStep = {
      2: ['ktp_photo', 'selfie_ktp_photo'],
      3: ['passbook_photo'],
      4: ['statement_letter'],
    };

    (requiredFilesByStep[currentStep] || []).forEach((field) => {
      const input = formElement.querySelector(`input[name="${field}"]`);
      if (!input) return;

      if (!draftFiles[field] && !input.files?.length) {
        isValid = false;
        input.closest('.custom-file-upload')?.style.setProperty('border', '1.5px solid #ef4444', 'important');
        input.addEventListener('change', () => {
          input.closest('.custom-file-upload')?.style.removeProperty('border');
        }, { once: true });
      }
    });

    if (!isValid) {
      alert('Mohon isi semua kolom wajib yang bertanda merah sebelum melanjutkan.');
      return isValid;
    }

    if (currentStep === 2) {
      const phone = document.getElementById('verifyPhoneInput');
      const nik = document.getElementById('verifyKtpInput');

      if (phone && !/^[0-9]{9,15}$/.test(phone.value)) {
        phone.style.border = '1.5px solid #ef4444';
        alert('Nomor HP hanya boleh berisi angka, 9–15 digit.');
        return false;
      }

      if (nik && !/^[0-9]{16}$/.test(nik.value)) {
        nik.style.border = '1.5px solid #ef4444';
        alert('Nomor NIK harus 16 digit angka.');
        return false;
      }
    }

    return isValid;
  }

  restoreDraftFileUi();
  updateFormProgress();

  if (!btnNext) return;

  btnNext.addEventListener('click', () => {
    if (!validateCurrentStepInputs()) return;

    if (currentStep < totalSteps) {
      currentStep++;
      updateFormProgress();
    } else {
      btnNext.textContent = 'Mengirim...';
      btnNext.disabled = true;
      formElement.submit();
    }
  });

  btnBack?.addEventListener('click', () => {
    if (currentStep > 1) {
      currentStep--;
      updateFormProgress();
    }
  });

  document.getElementById('verifyPhoneInput')?.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 15);
  });

  document.getElementById('verifyKtpInput')?.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 16);
  });

  const photoFields = new Set(['ktp_photo', 'selfie_ktp_photo', 'profile_photo', 'passbook_photo']);
  const pdfFields = new Set(['statement_letter', 'supporting_docs']);
  const photoExts = ['jpg', 'jpeg', 'png'];

  function getFileExt(name) {
    return name.split('.').pop()?.toLowerCase() ?? '';
  }

  function isValidPhotoFile(file) {
    return photoExts.includes(getFileExt(file.name));
  }

  function isValidPdfFile(file) {
    return getFileExt(file.name) === 'pdf';
  }

  const fileInputs = formElement.querySelectorAll('.custom-file-upload input[type="file"]');
  fileInputs.forEach((input) => {
    const textMain = input.parentElement.querySelector('.upload-text-main');
    if (textMain && !textMain.dataset.defaultText) {
      textMain.dataset.defaultText = textMain.textContent;
    }

    input.addEventListener('change', async (e) => {
      const file = e.target.files[0];
      if (!file) return;

      const fieldName = input.name;
      let valid = true;
      let message = '';

      if (photoFields.has(fieldName) && !isValidPhotoFile(file)) {
        valid = false;
        message = 'Format foto harus PNG, JPG, atau JPEG.';
      } else if (pdfFields.has(fieldName) && !isValidPdfFile(file)) {
        valid = false;
        message = 'Format dokumen harus PDF.';
      }

      if (!valid) {
        alert(message);
        input.value = '';
        if (textMain) {
          textMain.textContent = textMain.dataset.defaultText;
          textMain.style.color = '';
        }
        return;
      }

      if (textMain) {
        textMain.textContent = 'Mengunggah...';
        textMain.style.color = '#21A3FF';
      }

      try {
        const result = await uploadDraftFile(fieldName, file);
        draftFiles[fieldName] = result.filename;
        input.removeAttribute('required');

        if (textMain) {
          textMain.textContent = `Tersimpan: ${result.filename}`;
          textMain.style.color = '#22c55e';
        }

        updateDraftFileHint(fieldName, result.filename);
        input.closest('.custom-file-upload')?.style.removeProperty('border');
      } catch (err) {
        alert(err.message || 'Gagal mengunggah file.');
        input.value = '';
        if (textMain) {
          textMain.textContent = textMain.dataset.defaultText;
          textMain.style.color = '';
        }
      }
    });
  });

  const btnReqOtp = document.getElementById('btnReqOtp');
  if (btnReqOtp) {
    btnReqOtp.addEventListener('click', () => {
      btnReqOtp.textContent = 'Terkirim (60s)';
      btnReqOtp.disabled = true;
      btnReqOtp.style.opacity = '0.6';
      alert('Kode OTP simulasi telah dikirim ke nomor WhatsApp Anda!');
    });
  }
});
(function () {
  const settingsNavItems = document.querySelectorAll('.settings-nav-item');
  const settingsSections = document.querySelectorAll('.settings-content .dash-section');
  const settingsContent  = document.querySelector('.settings-content');

  settingsNavItems.forEach(item => {
    item.addEventListener('click', (e) => {
      e.preventDefault();

      const targetId = item.getAttribute('href').replace('#', '');

      settingsSections.forEach(s => s.style.display = 'none');

      const target = document.getElementById(targetId);
      if (target) {
        target.style.display = 'block';
        if (settingsContent) settingsContent.scrollTop = 0;
      }

      settingsNavItems.forEach(n => n.classList.remove('active'));
      item.classList.add('active');
    });
  });
})();
document.getElementById('btnBackDetail')?.addEventListener('click', (e) => {
  e.preventDefault();
  if (document.referrer && document.referrer.includes(location.hostname)) {
    history.back();
  } else {
    // fallback kalau user buka halaman ini langsung (misal dari bookmark/refresh)
    window.location.href = '/dashboard';
  }
});