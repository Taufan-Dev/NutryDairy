<div class="dropdown-menu dropdown-menu-end me-1">
	<a href="#" class="dropdown-item">Edit Profile</a>
	<div class="dropdown-divider"></div>
	<a href="javascript:;" onclick="$('#logout-form').submit()" class="dropdown-item">Log Out</a>
</div>
<form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
    @csrf
</form> 