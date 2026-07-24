<div class="dash-topbar">
  <h1 class="dash-greeting">{{ $pageTitle ?? 'Panel Admin' }}</h1>
  <div class="dash-topbar-right">
    <div class="profile-wrap">
      <div class="dash-profile" id="profileBtn">
        @include('partials.user-avatar')
        <div>
          <p class="dash-profile-name">{{ auth()->user()->display_name }}</p>
          <p class="dash-profile-email">{{ auth()->user()->email }}</p>
        </div>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#b0b7c3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left:4px;flex-shrink:0">
          <polyline points="6 9 12 15 18 9"/>
        </svg>
      </div>
      <div class="profile-dropdown" id="profileDropdown">
        <div class="profile-dropdown-menu">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="profile-menu-item danger" style="border:none;background:none;width:100%;text-align:left;cursor:pointer;font:inherit;">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
              </svg>
              Keluar
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const profileBtn = document.getElementById('profileBtn');
    const profileDropdown = document.getElementById('profileDropdown');
    const dashRight = document.querySelector('.dash-right');

    function positionDropdown(dropdown, anchor) {
      const pr = dashRight.getBoundingClientRect();
      const ar = anchor.getBoundingClientRect();
      dropdown.style.top   = (ar.bottom - pr.top + 8) + 'px';
      dropdown.style.right = (pr.right - ar.right) + 'px';
      dropdown.style.left  = 'auto';
    }

    profileBtn?.addEventListener('click', (e) => {
      e.stopPropagation();
      const opening = !profileDropdown.classList.contains('open');
      if (opening) {
        positionDropdown(profileDropdown, profileBtn);
        profileDropdown.classList.add('open');
      } else {
        profileDropdown.classList.remove('open');
      }
    });

    document.addEventListener('click', () => profileDropdown?.classList.remove('open'));
  });
</script>
