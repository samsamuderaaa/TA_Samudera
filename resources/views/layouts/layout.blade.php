<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="/asset/logo1.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <script defer src="https://use.fontawesome.com/releases/v5.15.3/js/all.js"></script>
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .custom-close-button {
            background-color: transparent;
            border: none;
            font-size: 20px;
            line-height: 1;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
            color: #721c24;;
            /* Warna ikon close */
            padding: 0;
            outline: none;
            transition: color 0.3s ease;
        }

        .custom-close-button:hover {
            color: #ff0000;
            /* Warna ikon close saat hover */
        }
    </style>
</head>

<body>
    @yield('content')
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeButton = document.querySelector('.custom-close-button');
        const alertElement = document.querySelector('.alert');

        closeButton.addEventListener('click', function() {
            // Sembunyikan atau hapus elemen alert
            alertElement.style.display = 'none'; // Untuk menyembunyikan
            //alertElement.remove(); // Untuk menghapus
        });
    });
</script>

</html>
