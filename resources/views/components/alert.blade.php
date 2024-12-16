@session('alert')
    <div class="alert alert-{{ session()->get('alert')['type'] }} alert-dismissible fade show" role="alert">
        {{ session()->get('alert')['message'] }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endsession
