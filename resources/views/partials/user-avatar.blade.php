@php
  $avatarUser = $user ?? auth()->user();
  $avatarClass = trim(($class ?? 'dash-avatar') . (! $avatarUser->hasAvatar() ? ' dash-avatar-empty' : ''));
@endphp
@if ($avatarUser->hasAvatar())
  <img
    src="{{ $avatarUser->avatarAssetUrl() }}"
    alt="{{ $alt ?? $avatarUser->display_name }}"
    class="{{ $avatarClass }}"
    @if(! empty($id)) id="{{ $id }}" @endif
  />
@else
  <div
    class="{{ $avatarClass }}"
    role="img"
    aria-label="{{ $alt ?? $avatarUser->display_name }}"
    @if(! empty($id)) id="{{ $id }}" @endif
  >{{ $avatarUser->avatarInitial() }}</div>
@endif
