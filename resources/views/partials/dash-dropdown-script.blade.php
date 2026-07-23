<script>
(function () {
  const cartBtn         = document.getElementById('cartBtn');
  const cartDropdown    = document.getElementById('cartDropdown');
  const notifBtn        = document.getElementById('notifBtn');
  const notifDropdown   = document.getElementById('notifDropdown');
  const profileBtn      = document.getElementById('profileBtn');
  const profileDropdown = document.getElementById('profileDropdown');
  const dashRight       = document.querySelector('.dash-right');

  if (!dashRight) return;

  function positionDropdown(dropdown, anchor) {
    if (!dropdown || !anchor) return;
    const pr = dashRight.getBoundingClientRect();
    const ar = anchor.getBoundingClientRect();
    dropdown.style.top   = (ar.bottom - pr.top + 8) + 'px';
    dropdown.style.right = (pr.right - ar.right) + 'px';
    dropdown.style.left  = 'auto';
  }

  function closeAll() {
    cartDropdown?.classList.remove('open');
    notifDropdown?.classList.remove('open');
    profileDropdown?.classList.remove('open');
  }

  cartBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    if (!cartDropdown) return;
    const opening = !cartDropdown.classList.contains('open');
    notifDropdown?.classList.remove('open');
    profileDropdown?.classList.remove('open');
    if (opening) {
      positionDropdown(cartDropdown, cartBtn);
      cartDropdown.classList.add('open');
    } else {
      cartDropdown.classList.remove('open');
    }
  });

  notifBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    if (!notifDropdown) return;
    const opening = !notifDropdown.classList.contains('open');
    cartDropdown?.classList.remove('open');
    profileDropdown?.classList.remove('open');
    if (opening) {
      positionDropdown(notifDropdown, notifBtn);
      notifDropdown.classList.add('open');
    } else {
      notifDropdown.classList.remove('open');
    }
  });

  profileBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    if (!profileDropdown) return;
    const opening = !profileDropdown.classList.contains('open');
    cartDropdown?.classList.remove('open');
    notifDropdown?.classList.remove('open');
    if (opening) {
      positionDropdown(profileDropdown, profileBtn);
      profileDropdown.classList.add('open');
    } else {
      profileDropdown.classList.remove('open');
    }
  });

  [cartDropdown, notifDropdown, profileDropdown].forEach((el) => {
    el?.addEventListener('click', (e) => e.stopPropagation());
  });

  document.addEventListener('click', closeAll);
})();
</script>
