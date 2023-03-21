<div id="pagination" class="mt-4 pb-1 justify-content-center d-flex">
    {{ $users->withQueryString()->links('pagination::bootstrap-4') }}
</div>