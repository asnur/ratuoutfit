@extends('master.app')
@section('master-page')
<div class="breadcrumb-main ">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-contain">
                    <div>
                        <h2>Riwayat Pemesanan</h2>
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li><i class="fa fa-angle-double-right"></i></li>
                            <li><a href="javascript:void(0)">Riwayat Pemesanan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- section start -->
<section class="compare-padding section-big-py-space b-g-light">
    <div class="custom-container">
        <div class="row">
            <div class="col-sm-12">
                <div class="compare-page">
                    <div class="table-wrapper table-responsive">
                        <div class="card">
                            <div class="card-header" style="background:#E05297;color:white;font-size:16px;font-weight:600">
                                Data Riwayat Pemesanan
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Data 1</th>
                                            <th>Data 2</th>
                                            <th>Data 3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Value 1</td>
                                            <td>Value 2</td>
                                            <td>Value 3</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->
@endsection