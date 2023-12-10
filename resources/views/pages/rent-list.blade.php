@extends('layouts.app')
@php
    use App\Http\Controllers\MoviesController;
    $movieController = new MoviesController;
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header"><h5>Orders List</h5></div>

                <div class="card-body">
                    <table id="myDataTable" class="display">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Payment</th>
                                <th>Change</th>
                                <th>Purchase Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rents as $item)
                                <tr> 
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($item->title) }}</td>
                                    <td>{{ $movieController->movieGenre()[$item->type - 1] }}</td>
                                    <td>₱ {{ number_format($item->rental_price, 2, '.', ',')  }}</td>
                                    <td>{{ $item->quantity }} days</td>
                                    <td>₱ {{ number_format($item->total_price, 2, '.', ',')  }}</td>
                                    <td>₱ {{ number_format($item->payment, 2, '.', ',')  }}</td>
                                    <td>₱ {{ number_format($item->change, 2, '.', ',')  }}</td>
                                    <td>{{ date('F d, Y', strtotime($item->created_at)) }}</td>
                                    <td class="text-center">
                                        <a href="#" id="delete-purchase" data-id="{{ $item->id }}">
                                            <svg class="text-danger text-center" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable();
    });

    $(document).on('click', '#delete-purchase', function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    type: "GET",
                    url: "{{ route('deleteRent') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
                    }, data: {
                        'id' : $(this).data('id')
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            swal(`${response.message}`, {
                                    icon: "success",
                                }).then(function () {
                                    // Reload the page when the OK button is clicked
                                    location.reload();
                            });
                        }
                        
                    },
                    error: function (xhr, status, error) {
                        swal(`${error}`, {
                                icon: "error",
                            });
                        // Handle any errors that occur during the request
                        toastr.error('Cannot fetch attendance (Error: 500)');
                    }
                });

            }
        });
    });
</script>
@endsection
