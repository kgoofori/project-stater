<div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div>
        <flash-box message=" {{session('success') }}"></flash-box>
    </div>
</div>