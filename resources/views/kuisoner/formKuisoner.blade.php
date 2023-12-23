<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        PELAYARAN NASIONAL INDONESIA
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->

    <link href="../assets/demo/demo.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.css"> --}}
    <style>
        /* input {
            padding: 10px;
            width: 100%;
            font-size: 17px;
            font-family: Raleway;
            border: 1px solid #aaaaaa;
        } */

        /* Mark input boxes that gets an error on validation: */
        input.invalid,
        select.invalid {
            background-color: #ffdddd;
        }

        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        button {
            background-color: #04AA6D;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            font-family: Raleway;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.8;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #04AA6D;
        }
    </style>
</head>

<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-5">
                    @if ($errors->any())
                        <div class="alert alert-danger  d-flex justify-content-start" style="color:#fff;">
                            <!-- Icon Close Bootstrap -->
                            <div class="row">
                                <button type="button" class="btn-close col-4 mx-2" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <ul class="col-12 mx-5 mt-n4">
                                    @foreach ($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Kuisoner</h4>
                        </div>
                        <div class="card-body my-3 p-3 px-5 bg-body rounded">
                            <form id="regForm" action="" method="POST" enctype="multipart/form-data"
                                class="contact-form">
                                @csrf

                                <div class="tab">
                                    <div class="mb-3 row">
                                        <label for="nim" class="col-md-2 col-form-label text-dark">Nomor
                                            Identitas</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='nomor_identitas' required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nim" class="col-md-2 col-form-label text-dark">Nama
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='nama' required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nama" class="col-sm-2 col-form-label text-dark">Jenis
                                            Kelamin
                                            Kriteria</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="jenis_kelamin" required>
                                                <option value="" disabled selected>Pilih Jenis Kelamin
                                                </option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nama" class="col-sm-2 col-form-label text-dark">Nama
                                            Kapal
                                            </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="maskapai" required>
                                                <option value="" disabled selected>Pilih Kapal</option>
                                                @foreach ($data_maskapai as $maskapai)
                                                    <option value="{{ $maskapai->id_maskapai }}">
                                                        {{ $maskapai->nama_maskapai }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="jurusan" class="col-sm-2 col-form-label text-dark">Foto
                                            Tiket</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name='foto'>
                                            <span id="fileSizeError" class="text-danger">*Foto tidak boleh lebih dari
                                                2mb</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab">
                                    @foreach ($kriteria as $item)
                                        <div class="row mb-3">
                                            <p>{{ $loop->iteration }}. {{ $item->nama_kriteria }}</p>
                                            @foreach ($item->sub_kriteria as $sub_kriteria)
                                                <div class="ml-3">
                                                    <input type="radio" id="{{ $sub_kriteria->id_subkriteria }}"
                                                        name="kriteria[{{ $item->id_kriteria }}]"
                                                        value="{{ $item->id_kriteria . '-' . $sub_kriteria->id_subkriteria }}"
                                                        required>
                                                    <label for="{{ $sub_kriteria->id_subkriteria }}"
                                                        class="text-dark">{{ $sub_kriteria->nama_subkriteria }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-navigation">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)"
                                        class="previous btn btn-primary float-left">Previous</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)"
                                        class="next btn btn-primary float-right">Next</button>
                                    {{-- <button type="submit" class="next btn btn-success float-right">Submit</button> --}}
                                </div>
                                <div style="text-align:center;margin-top:40px;">
                                    <span class="step" hidden></span>
                                    <span class="step" hidden></span>
                                    <span class="step" hidden></span>
                                    <span class="step" hidden></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--   Core JS Files   -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script> --}}
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].querySelectorAll("input, select");
            var radioGroups = {};
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].type === "radio") {
                    var groupName = y[i].name;
                    if (!radioGroups[groupName]) {
                        radioGroups[groupName] = true; // Setel grup radio button ini sudah diperiksa
                        var checkedRadio = x[currentTab].querySelector("input[name='" + groupName + "']:checked");
                        if (!checkedRadio) {
                            valid = false; // Tidak ada radio button yang terpilih dalam grup ini
                            break; // Hentikan loop karena validasi gagal
                        }
                    }
                } else if (y[i].value == "" && y[i].type !== "file") {
                    y[i].className += " invalid";
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
    </script>

    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
</body>

</html>
