<div class="col-lg-4">
    <aside class="user-info-wrapper">
        <div class="user-info">
            <div class="user-avatar">

                @if (Auth::user()->photo != "null")
                <img id="avater_photo_view"
                    src="{{ \App\Helpers\FileUploadHelper::url(Auth::user()->photo) }}" />
                @else
                <img id="avater_photo_view"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png"
                    alt="User">
                @endif


            </div>

            <div class="user-data">
                <h4 class="h5">{{ Auth::user()->name }} </h4><span>Joined {{ date('M d, Y',strtotime(Auth::user()->created_at)) }}</span>
            </div>
        </div>
        <nav class="list-group">
            <a class="list-group-item {{ Request::routeIs('user.dashboard') ? 'active':''}} " href="{{ route('user.dashboard') }}"><i
                    class="icon-command"></i>Dashboard</a>
            <a class="list-group-item {{ Request::routeIs('user.profile') ? 'active':''}}" href="{{ route('user.dashboard.profile') }}"><i
                    class="icon-user"></i>Profile</a>
            <a class="list-group-item with-badge {{ Request::routeIs('user.order') ? 'active':''}}"
                href="{{ route('user.order') }}"><i
                    class="icon-shopping-bag"></i>Orders<span
                    class="badge badge-default badge-pill">{{ count(Auth::user()->orders) }}</span></a>
            <a class="list-group-item " href="{{ route('user.dashboard.address') }}"><i
                    class="icon-map-pin"></i>Address</a>
            <a class="list-group-item  with-badge {{ Request::routeIs('user.wishlist') ? 'active':''}}"
                href="{{ route('user.wishlist') }}"><i
                    class="icon-heart"></i>Wishlist<span class="badge badge-default badge-pill">{{ count(Auth::user()->wishlists) }}</span></a>
            <a class="list-group-item with-badge" href="#" data-bs-toggle="modal" data-bs-target="#confirm-logout"><i
                    class="icon-log-out"></i>Logout</a>
            <a class="list-group-item" href="#" data-bs-toggle="modal" data-bs-target="#confirm-remove-account"><i
                    class="icon-x"></i>Remove Account</a>
        </nav>
    </aside>

</div>

<div class="modal fade" id="confirm-logout" tabindex="-1" aria-labelledby="confirmLogoutLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmLogoutLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to log out of your account?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn primary_btn" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('user.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn primary_btn">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-remove-account" tabindex="-1" aria-labelledby="confirmRemoveAccountLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmRemoveAccountLabel">Remove Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to permanently delete your account?</p>
                <p class="mb-0">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn primary_btn" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('user.account.delete') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn primary_btn">Remove Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
