@extends('layouts.adminLayout.admin_desing')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Dashboard</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
    <!-- end row -->
</div>

@include('layouts.adminLayout.admin_messages')
<div class="row">
    @foreach($kategori as $item)
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header text-center">{{ $item->nama_kategori }}</div>
            <div class="card-body text-center">
                <h5 class="card-title">
                    {{ $item->wisata()->count() }} Lokasi
                </h5>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#admin-search').on('input', function() {
        let query = $(this).val();

        if (query.length > 1) {
            $.ajax({
                url: "{{ route('admin.wisata.search') }}",
                type: "GET",
                data: { search: query },
                success: function(response) {
                    console.log("Response dari server:", response); // Debugging

                    let resultsContainer = $('#admin-search-results');
                    resultsContainer.empty().show();

                    if (response.length > 0) {
                        response.forEach(function(item) {
                            let listItem = `<li class="list-group-item search-item" data-name="${item}" 
                            style="cursor: pointer;">${item}</li>`;
                            resultsContainer.append(listItem);
                        });
                    } else {
                        resultsContainer.append('<li class="list-group-item text-muted">Tidak ditemukan</li>');
                    }
                }
            });
        } else {
            $('#admin-search-results').empty().hide();
        }
    });

    // Event listener untuk klik hasil pencarian
    $(document).on('click', '.search-item', function() {
        let wisataNama = $(this).attr('data-name');
        if (wisataNama) {
            window.location.href = "/admin/wisatas/" + encodeURIComponent(wisataNama);
        }
    });

    // Hover efek untuk search item
    $(document).on("mouseenter", ".search-item", function() {
        $(this).css("background-color", "#f0f0f0");
    });
    $(document).on("mouseleave", ".search-item", function() {
        $(this).css("background-color", "");
    });
});
</script>

