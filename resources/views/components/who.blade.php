@if (Auth::guard('web')->check())
  <h4 class="text-success">
    You are logged in as a <strong>USER</strong>.
  </h4>
@else
<h4 class="text-danger">
  You are logged out as a <strong>USER</strong>.
</h4>
@endif

@if (Auth::guard('admin')->check())
  <h4 class="text-success">
    You are logged in as a <strong>ADMIN</strong>.
  </h4>
@else
<h4 class="text-danger">
  You are logged out as a <strong>ADMIN</strong>.
</h4>
@endif